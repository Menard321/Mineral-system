<?php

namespace Database\Seeders;

use App\Models\MarketIndex;
use App\Models\TradeRequest;
use App\Models\RevenueReport;
use App\Models\MineralSample;
use App\Models\Certificate;
use App\Models\User;
use App\Services\RevenueAssurance\RevenueAssuranceService;
use Illuminate\Database\Seeder;

class RevenueAssuranceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Initial Market Indices
        $indices = [
            ['mineral_type' => 'Gold', 'price_per_kg' => 62500, 'currency' => 'USD'],
            ['mineral_type' => 'Lithium', 'price_per_kg' => 14.50, 'currency' => 'USD'],
            ['mineral_type' => 'Copper', 'price_per_kg' => 9.20, 'currency' => 'USD'],
            ['mineral_type' => 'Tanzanite', 'price_per_kg' => 12000, 'currency' => 'USD'],
            ['mineral_type' => 'Coal', 'price_per_kg' => 0.18, 'currency' => 'USD'],
        ];

        foreach ($indices as $idx) {
            MarketIndex::updateOrCreate(['mineral_type' => $idx['mineral_type']], $idx);
        }

        // 2. Mock some Trade Requests with analysis
        $user = User::where('email', 'mining@anglogold.com')->first();
        if (!$user) return;

        $cert = Certificate::where('user_id', $user->id)->first();
        if (!$cert) return;

        $service = new RevenueAssuranceService();

        // High Risk Trade (Undervalued)
        $trade1 = TradeRequest::create([
            'trade_id' => TradeRequest::generateId(),
            'user_id' => $user->id,
            'certificate_id' => $cert->id,
            'mineral_type' => $cert->mineral_type,
            'quantity_kg' => 100,
            'trade_type' => 'EXPORT',
            'buyer_name' => 'Swiss Metals AG',
            'buyer_country' => 'Switzerland',
            'value_usd' => 500000, // Deliberately low for Gold if Weight is 100kg (Real should be ~6M)
            'status' => 'PENDING',
        ]);
        $service->analyzeExport($trade1);

        // Low Risk Trade (Accurate)
        $trade2 = TradeRequest::create([
            'trade_id' => TradeRequest::generateId(),
            'user_id' => $user->id,
            'certificate_id' => $cert->id,
            'mineral_type' => 'Lithium',
            'quantity_kg' => 5000,
            'trade_type' => 'EXPORT',
            'buyer_name' => 'Tesla Battery Labs',
            'buyer_country' => 'USA',
            'value_usd' => 72500, // Accurate for Lithium
            'status' => 'COMPLETED',
        ]);
        $service->analyzeExport($trade2);
    }
}
