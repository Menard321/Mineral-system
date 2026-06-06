<?php

namespace App\Services\RevenueAssurance;

use App\Models\MarketIndex;
use App\Models\TradeRequest;
use App\Models\RevenueReport;
use App\Models\MineralSample;
use Illuminate\Support\Facades\Log;

class RevenueAssuranceService
{
    /**
     * Main engine entry point.
     * Triggered when a trade request is submitted.
     */
    public function analyzeExport(TradeRequest $trade)
    {
        $sample = $trade->certificate->sample ?? null;
        if (!$sample) {
            Log::error("RevenueAssurance: No sample found for Trade ID: " . $trade->trade_id);
            return null;
        }

        // 1. Fetch Global Market Price
        $index = MarketIndex::where('mineral_type', $sample->mineral_type)->first();
        $marketPrice = $index ? $index->price_per_kg : 0;

        // 2. Valuation Engine: (Weight * Purity * MarketPrice)
        // For simplicity, we assume purity is derived from lab tests. 
        // If lab results are multiple (e.g., Li2O 6.2%), we use the primary purity metric.
        $purityPct = $this->extractPurity($sample);
        $realValue = $trade->quantity_kg * ($purityPct / 100) * $marketPrice;

        // 3. Royalty & Tax Calculation
        $royaltyRate = $this->getRoyaltyRate($sample->mineral_type);
        $royaltyAmount = $realValue * ($royaltyRate / 100);
        $processingFee = $realValue * 0.01; // Standard 1%
        $exportTax = $realValue * 0.02;     // Standard 2%

        // 4. Comparison Engine (Risk Scoring)
        $valuationGap = $realValue - $trade->value_usd;
        $riskScore = $this->calculateRiskScore($realValue, $trade->value_usd, $trade->user_id);
        $riskLevel = $this->determineRiskLevel($riskScore);

        // 5. Store Report
        return RevenueReport::create([
            'trade_request_id' => $trade->id,
            'real_market_value' => $realValue,
            'declared_value' => $trade->value_usd,
            'valuation_gap' => $valuationGap,
            'royalty_amount' => $royaltyAmount,
            'processing_fee' => $processingFee,
            'export_tax' => $exportTax,
            'risk_score' => $riskScore,
            'risk_level' => $riskLevel,
            'analysis_metadata' => [
                'market_price_used' => $marketPrice,
                'purity_applied' => $purityPct,
                'royalty_rate_applied' => $royaltyRate,
                'valuation_timestamp' => now()->toIso8601String()
            ]
        ]);
    }

    private function extractPurity(MineralSample $sample): float
    {
        // Try to get the first numeric result as a proxy for purity if not explicitly set
        $test = $sample->labTests()->first();
        if ($test && $test->results()->count() > 0) {
            return $test->results()->first()->value;
        }
        return 100.0; // Fallback to 100% if no data
    }

    private function getRoyaltyRate(string $mineral): float
    {
        $rates = [
            'Gold' => 6.0,
            'Lithium' => 5.0,
            'Diamond' => 10.0,
            'Copper' => 4.0,
            'Tanzanite' => 7.0
        ];
        return $rates[ucfirst($mineral)] ?? 5.0;
    }

    private function calculateRiskScore(float $real, float $declared, int $userId): int
    {
        $score = 0;
        
        // Gap Penality
        if ($real > 0) {
            $gapPct = (($real - $declared) / $real) * 100;
            if ($gapPct > 30) $score += 50;
            elseif ($gapPct > 10) $score += 20;
        }

        // Add history penality (Mock logic)
        // If user has previous rejected trades, add score
        
        return min(100, $score);
    }

    private function determineRiskLevel(int $score): string
    {
        if ($score >= 70) return 'CRITICAL';
        if ($score >= 40) return 'HIGH';
        if ($score >= 20) return 'MEDIUM';
        return 'LOW';
    }
}
