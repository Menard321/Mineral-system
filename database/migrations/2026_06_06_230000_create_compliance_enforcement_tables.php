<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ⚖️ 1. COMPLIANCE CASES (LIFECYCLE ENGINE)
        Schema::create('compliance_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_id')->unique(); // GMITE-CASE-XXXXX
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('assigned_officer_id')->nullable()->constrained('admin_users');
            $table->string('status')->default('OPEN'); // OPEN, INVESTIGATION, REVIEW, DECISION, CLOSED
            $table->string('risk_level')->default('LOW'); // LOW, MEDIUM, HIGH, CRITICAL
            $table->decimal('risk_score', 5, 2)->default(0);
            $table->text('summary')->nullable();
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        // 📁 2. COMPLIANCE EVIDENCE (IMMUTABLE)
        Schema::create('compliance_evidence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compliance_case_id')->constrained('compliance_cases')->cascadeOnDelete();
            $table->string('document_type'); // LAB_REPORT, EXPORT_DOC, IMAGE, INSPECTOR_REPORT
            $table->string('file_path');
            $table->string('file_hash')->unique(); // Digital Signature / Integrity Check
            $table->foreignId('uploaded_by')->constrained('admin_users');
            $table->text('description')->nullable();
            $table->timestamps(); // Created_at is the proof of submission
        });

        // 🔗 3. LINKING VIOLATIONS TO CASES
        Schema::table('violations', function (Blueprint $table) {
            $table->foreignId('compliance_case_id')->nullable()->after('company_id')->constrained('compliance_cases')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->dropForeign(['compliance_case_id']);
            $table->dropColumn('compliance_case_id');
        });
        Schema::dropIfExists('compliance_evidence');
        Schema::dropIfExists('compliance_cases');
    }
};
