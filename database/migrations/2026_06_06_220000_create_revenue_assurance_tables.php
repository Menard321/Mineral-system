<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── MARKET INDICES (GLOBAL PRICING) ───────────────────────────
        Schema::create('market_indices', function (Blueprint $table) {
            $table->id();
            $table->string('mineral_type')->unique();
            $table->decimal('price_per_kg', 15, 4);
            $table->string('currency')->default('USD');
            $table->string('unit')->default('KG');
            $table->timestamp('last_updated_at')->useCurrent();
            $table->timestamps();
        });

        // ── REVENUE REPORTS (VALUATION & AUDIT) ───────────────────────
        Schema::create('revenue_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trade_request_id')->constrained('trade_requests')->cascadeOnDelete();
            $table->decimal('real_market_value', 18, 4);
            $table->decimal('declared_value', 18, 4);
            $table->decimal('valuation_gap', 18, 4);
            $table->decimal('royalty_amount', 18, 4);
            $table->decimal('processing_fee', 18, 4);
            $table->decimal('export_tax', 18, 4);
            $table->integer('risk_score'); // 0-100
            $table->string('risk_level'); // LOW, MEDIUM, HIGH, CRITICAL
            $table->json('analysis_metadata')->nullable(); // Stores logic details
            $table->timestamps();
        });

        // ── ADD RISK LEVEL TO TRADE REQUESTS ─────────────────────────
        Schema::table('trade_requests', function (Blueprint $table) {
            $table->integer('risk_score')->default(0)->after('status');
            $table->string('risk_level')->default('LOW')->after('risk_score');
        });
    }

    public function down(): void
    {
        Schema::table('trade_requests', function (Blueprint $table) {
            $table->dropColumn(['risk_score', 'risk_level']);
        });
        Schema::dropIfExists('revenue_reports');
        Schema::dropIfExists('market_indices');
    }
};
