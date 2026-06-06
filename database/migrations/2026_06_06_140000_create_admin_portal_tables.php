<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 0. HANDLE OVERLAPS
        $overlaps = [
            'audit_logs' => 'user_activity_logs',
            'system_alerts' => 'user_notifications',
            'violations' => 'user_violations',
            'compliance_records' => 'user_compliance_history',
            'system_settings' => 'legacy_system_settings',
        ];

        foreach ($overlaps as $old => $new) {
            if (Schema::hasTable($old) && !Schema::hasTable($new)) {
                Schema::rename($old, $new);
            }
        }

        // 🏛️ 1. ADMIN USERS & SECURITY CORE
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique(); // SUPER_ADMIN, LICENSE_OFFICER, etc.
            $table->text('description')->nullable();
            $table->integer('permission_level')->default(1); // 1-10
            $table->timestamps();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('phone')->nullable();
            $table->foreignId('role_id')->constrained('admin_roles');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('status')->default('PENDING'); // ACTIVE / SUSPENDED / PENDING
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('permission_name')->unique();
            $table->string('module'); // LICENSE / LAB / TRADE / USERS / SYSTEM
            $table->timestamps();
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('admin_roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('admin_permissions')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('admin_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin_users')->cascadeOnDelete();
            $table->string('ip_address')->nullable();
            $table->text('device_info')->nullable();
            $table->timestamp('login_time')->useCurrent();
            $table->timestamp('logout_time')->nullable();
        });

        // 👥 2. USER GOVERNANCE
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('verified_by_admin_id')->nullable()->constrained('admin_users');
            $table->string('status')->default('PENDING'); // PENDING / APPROVED / REJECTED
            $table->text('notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('user_suspensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('reason');
            $table->foreignId('suspended_by')->constrained('admin_users');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->timestamps();
        });

        // 🏢 3. COMPANY GOVERNANCE
        Schema::create('company_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('reviewed_by_admin_id')->constrained('admin_users');
            $table->string('status')->default('PENDING');
            $table->text('remarks')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('company_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('action');
            $table->string('old_status')->nullable();
            $table->string('new_status')->nullable();
            $table->foreignId('admin_id')->constrained('admin_users');
            $table->timestamp('timestamp')->useCurrent();
        });

        // 📜 4. LICENSING AUTHORITY
        Schema::create('license_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('license_type');
            $table->string('status')->default('PENDING'); // PENDING / UNDER_REVIEW / APPROVED / REJECTED / EXPIRED
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });

        Schema::create('license_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_application_id')->constrained('license_applications')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admin_users');
            $table->string('decision'); // APPROVED / REJECTED / REQUEST_INFO
            $table->text('comments')->nullable();
            $table->timestamp('decision_date')->useCurrent();
        });

        Schema::create('issued_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->unique();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('license_type');
            $table->foreignId('issued_by_admin_id')->constrained('admin_users');
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->string('status')->default('ACTIVE'); // ACTIVE / SUSPENDED / REVOKED
            $table->timestamps();
        });

        // 🧪 5. LABORATORY CONTROL
        Schema::create('lab_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained('mineral_samples')->cascadeOnDelete();
            $table->unsignedBigInteger('lab_id'); // Assuming a labs table or system
            $table->foreignId('assigned_by_admin_id')->constrained('admin_users');
            $table->string('status')->default('ASSIGNED'); // ASSIGNED / IN_PROGRESS / COMPLETED
            $table->timestamps();
        });

        Schema::create('lab_results_approval', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_test_id')->constrained('lab_tests')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admin_users');
            $table->string('status')->default('PENDING'); // APPROVED / REJECTED / REVISION_REQUIRED
            $table->text('comments')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        // 💱 6. TRADE OVERSIGHT
        Schema::create('trade_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trade_id')->constrained('trade_requests')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admin_users');
            $table->string('status')->default('PENDING');
            $table->string('risk_level')->default('LOW'); // LOW / MEDIUM / HIGH
            $table->text('comments')->nullable();
            $table->timestamps();
        });

        Schema::create('export_clearances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trade_id')->constrained('trade_requests')->cascadeOnDelete();
            $table->string('clearance_number')->unique();
            $table->foreignId('issued_by_admin_id')->constrained('admin_users');
            $table->string('status')->default('GRANTED'); // GRANTED / DENIED
            $table->string('port_of_exit')->nullable();
            $table->date('issue_date');
            $table->timestamps();
        });

        // ⚖️ 7. COMPLIANCE & ENFORCEMENT
        Schema::create('compliance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admin_users');
            $table->decimal('compliance_score', 5, 2);
            $table->string('status'); // COMPLIANT / NON_COMPLIANT / WARNING
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('violation_type');
            $table->string('severity')->default('LOW'); // LOW / MEDIUM / HIGH / CRITICAL
            $table->text('description');
            $table->string('penalty_action')->nullable();
            $table->boolean('resolved')->default(false);
            $table->foreignId('admin_id')->constrained('admin_users');
            $table->timestamps();
        });

        // 🚨 8. ALERTS & FRAUD DETECTION
        Schema::create('system_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('alert_type'); // FRAUD / SYSTEM / TRADE / LAB / LICENSE
            $table->string('severity')->default('INFO'); // INFO / WARNING / CRITICAL
            $table->text('message');
            $table->string('related_entity_type')->nullable();
            $table->unsignedBigInteger('related_entity_id')->nullable();
            $table->string('status')->default('OPEN'); // OPEN / IN_PROGRESS / RESOLVED
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('fraud_detections', function (Blueprint $table) {
            $table->id();
            $table->string('detected_by')->default('SYSTEM'); // SYSTEM / ADMIN
            $table->string('entity_type'); // USER / SAMPLE / TRADE
            $table->unsignedBigInteger('entity_id');
            $table->decimal('fraud_score', 5, 2);
            $table->text('description')->nullable();
            $table->string('action_taken')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admin_users');
            $table->timestamps();
        });

        // 📊 9. NATIONAL ANALYTICS
        Schema::create('analytics_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('metric_name');
            $table->decimal('metric_value', 15, 2);
            $table->string('region')->nullable();
            $table->string('period'); // daily / monthly / yearly
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('mineral_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('mineral_type');
            $table->decimal('production_volume', 15, 2)->default(0);
            $table->decimal('export_volume', 15, 2)->default(0);
            $table->decimal('revenue_estimate', 15, 2)->default(0);
            $table->string('region')->nullable();
            $table->date('date');
            $table->timestamps();
        });

        // 🗺️ 10. MINERAL INTELLIGENCE ATLAS
        Schema::create('mining_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('mineral_type');
            $table->string('site_name');
            $table->timestamps();
        });

        Schema::create('export_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trade_id')->constrained('trade_requests')->cascadeOnDelete();
            $table->string('origin_location');
            $table->string('destination_country');
            $table->string('transport_mode'); // ROAD / AIR / SEA
            $table->string('status')->default('PLANNED');
            $table->timestamps();
        });

        // ⚙️ 11. SYSTEM CONFIGURATION
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_key')->unique();
            $table->text('setting_value');
            $table->foreignId('updated_by_admin_id')->nullable()->constrained('admin_users');
            $table->timestamps();
        });

        Schema::create('api_integrations', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->string('api_key_encrypted')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->timestamp('last_sync_at')->nullable();
            $table->timestamps();
        });

        // 📁 12. AUDIT LOG (MOST IMPORTANT)
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('admin_users')->nullOnDelete();
            $table->string('action_type');
            $table->string('module');
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('api_integrations');
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('export_routes');
        Schema::dropIfExists('mining_locations');
        Schema::dropIfExists('mineral_statistics');
        Schema::dropIfExists('analytics_snapshots');
        Schema::dropIfExists('fraud_detections');
        Schema::dropIfExists('system_alerts');
        Schema::dropIfExists('violations');
        Schema::dropIfExists('compliance_reviews');
        Schema::dropIfExists('export_clearances');
        Schema::dropIfExists('trade_approvals');
        Schema::dropIfExists('lab_results_approval');
        Schema::dropIfExists('lab_assignments');
        Schema::dropIfExists('issued_licenses');
        Schema::dropIfExists('license_approvals');
        Schema::dropIfExists('license_applications');
        Schema::dropIfExists('company_audit_logs');
        Schema::dropIfExists('company_approvals');
        Schema::dropIfExists('user_suspensions');
        Schema::dropIfExists('user_verifications');
        Schema::dropIfExists('admin_sessions');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_roles');
        
        // Reverse renames if necessary
        if (Schema::hasTable('user_activity_logs')) {
            Schema::rename('user_activity_logs', 'audit_logs');
        }
        if (Schema::hasTable('user_notifications')) {
            Schema::rename('user_notifications', 'system_alerts');
        }
    }
};
