<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // ── MINERAL SAMPLES ──────────────────────────────────────────
        Schema::create('mineral_samples', function (Blueprint $table) {
            $table->id();
            $table->string('sample_id')->unique(); // GMITE-SMP-XXXXX
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('mineral_type');         // Gold, Lithium, Copper…
            $table->string('grade')->nullable();
            $table->decimal('quantity_kg', 12, 4)->default(0);
            $table->string('collection_site');
            $table->string('gps_coordinates')->nullable();
            $table->string('priority')->default('normal'); // low|normal|high|critical
            $table->string('status')->default('received'); // received|registered|assigned|testing|reviewed|completed|certified|rejected
            $table->string('assigned_technician')->nullable();
            $table->text('notes')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('attachment_path')->nullable();
            $table->timestamp('collected_at')->nullable();
            $table->timestamps();
        });

        // ── CERTIFICATES ─────────────────────────────────────────────
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('cert_id')->unique(); // GMITE-CERT-XXXXX
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sample_id')->constrained('mineral_samples')->cascadeOnDelete();
            $table->string('mineral_type');
            $table->string('grade');
            $table->decimal('quantity_kg', 12, 4);
            $table->string('issued_by');
            $table->string('status')->default('issued'); // pending|issued|revoked|expired
            $table->date('expires_at')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('qr_verification_code')->nullable();
            $table->timestamps();
        });

        // ── TRADE REQUESTS ───────────────────────────────────────────
        Schema::create('trade_requests', function (Blueprint $table) {
            $table->id();
            $table->string('trade_id')->unique(); // GMITE-TRD-XXXXX
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('certificate_id')->nullable()->constrained('certificates')->nullOnDelete();
            $table->string('mineral_type');
            $table->decimal('quantity_kg', 12, 4);
            $table->string('trade_type')->default('export'); // export|domestic|auction|government
            $table->string('buyer_name');
            $table->string('buyer_country')->nullable();
            $table->decimal('value_usd', 15, 2)->default(0);
            $table->string('status')->default('pending'); // pending|lab_verified|compliance_approved|export_cleared|completed|rejected|suspended
            $table->string('destination_port')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        // ── COMPANIES ─────────────────────────────────────────────────
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('category');    // Large Scale Mining|Exploration|Trading…
            $table->string('reg_number')->unique();
            $table->string('tin')->nullable();
            $table->string('address');
            $table->string('region')->nullable();
            $table->string('country')->default('Tanzania');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('status')->default('under_review'); // under_review|verified|rejected|suspended
            $table->string('incorporation_doc')->nullable();
            $table->string('tax_cert_doc')->nullable();
            $table->string('business_license_doc')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // ── LICENSES ──────────────────────────────────────────────────
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_id')->unique(); // GMITE-LIC-XXXXX
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete();
            $table->string('type');        // Mining|Prospecting|Export Permit|Refinery…
            $table->string('operating_region')->nullable();
            $table->text('justification')->nullable();
            $table->string('status')->default('submitted'); // draft|submitted|under_review|info_required|approved|rejected|expired|renewed
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
        });

        // ── JOINT VENTURES ────────────────────────────────────────────
        Schema::create('joint_ventures', function (Blueprint $table) {
            $table->id();
            $table->string('jv_id')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('venture_name');
            $table->string('partner_name');
            $table->decimal('own_equity_pct', 5, 2);
            $table->decimal('partner_equity_pct', 5, 2);
            $table->text('objective');
            $table->string('status')->default('proposal_submitted'); // proposal_submitted|partner_review|gov_verification|legal_assessment|approved|registered
            $table->timestamps();
        });

        // ── SYSTEM ALERTS ─────────────────────────────────────────────
        Schema::create('system_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('alert_id')->unique();
            $table->string('severity')->default('info'); // critical|high|warning|info
            $table->string('source_module');   // lab|trade|compliance|system|user
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_resolved')->default(false);
            $table->string('related_entity_type')->nullable();
            $table->unsignedBigInteger('related_entity_id')->nullable();
            $table->timestamps();
        });

        // ── AUDIT LOGS (IMMUTABLE) ────────────────────────────────────
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('module');
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('logged_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('system_alerts');
        Schema::dropIfExists('joint_ventures');
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('trade_requests');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('mineral_samples');
    }
};
