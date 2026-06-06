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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('investor_type'); // INDIVIDUAL / CORPORATE
            $table->string('capital_range');
            $table->string('investment_focus');
            $table->string('region_interest');
            $table->timestamps();
        });

        Schema::create('investment_opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('mineral_type');
            $table->string('location');
            $table->decimal('estimated_value', 15, 2);
            $table->string('status');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        Schema::create('investor_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('opportunity_id')->constrained('investment_opportunities')->cascadeOnDelete();
            $table->string('status')->default('PENDING'); // PENDING / APPROVED / REJECTED
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investors_system_tables');
    }
};
