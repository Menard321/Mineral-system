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
        // 🟢 LAYER 1: DIGITAL REGISTRATION REFINEMENTS
        Schema::table('mineral_samples', function (Blueprint $table) {
            $table->string('mineral_category')->nullable()->after('mineral_type'); // Ore / Concentrate / Raw / Refined
            $table->string('mining_license_number')->nullable()->after('mineral_category');
            $table->string('sample_purpose')->nullable()->after('mining_license_number'); // Testing / Export / Research / Compliance
            $table->decimal('estimated_weight', 12, 4)->nullable()->after('quantity_kg');
            
            // 🟡 LAYER 2: PHYSICAL RECEIVING REFINEMENTS
            $table->timestamp('received_at')->nullable();
            $table->foreignId('verified_by_admin_id')->nullable()->constrained('admin_users');
            $table->string('physical_condition')->nullable(); // Sealed, Damaged, Contaminated, etc.
            $table->string('storage_location')->nullable(); // Vault / secure storage
        });

        // 🔬 LAYER 3: CERTIFICATION REFINEMENTS
        Schema::table('certificates', function (Blueprint $table) {
            $table->foreignId('lab_result_approval_id')->nullable()->constrained('lab_results_approval');
            $table->string('document_id')->nullable()->after('cert_id'); // Formal legal ID
        });

        // ⛓️ CHAIN OF CUSTODY (Sample Tracking Update)
        Schema::table('sample_tracking', function (Blueprint $table) {
            $table->unsignedBigInteger('updated_by')->nullable()->change();
            $table->foreignId('admin_id')->nullable()->constrained('admin_users')->after('updated_by');
            $table->string('handler_role')->nullable(); // Officer / Technician / Manager
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sample_tracking', function (Blueprint $table) {
            $table->dropColumn(['admin_id', 'handler_role']);
        });

        Schema::table('certificates', function (Blueprint $table) {
            $table->dropForeign(['lab_result_approval_id']);
            $table->dropColumn(['lab_result_approval_id', 'document_id']);
        });

        Schema::table('mineral_samples', function (Blueprint $table) {
            $table->dropForeign(['verified_by_admin_id']);
            $table->dropColumn([
                'mineral_category', 'mining_license_number', 'sample_purpose', 
                'estimated_weight', 'received_at', 'verified_by_admin_id', 
                'physical_condition', 'storage_location'
            ]);
        });
    }
};
