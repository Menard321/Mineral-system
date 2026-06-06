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
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained('mineral_samples')->cascadeOnDelete();
            $table->string('test_type');
            $table->string('method'); // XRF / FIRE_ASSAY / CHEMICAL
            $table->text('result_summary')->nullable();
            $table->string('status');
            $table->foreignId('technician_id')->constrained('users');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('lab_tests')->cascadeOnDelete();
            $table->string('element_name');
            $table->decimal('value', 10, 4);
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_system_tables');
    }
};
