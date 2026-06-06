<?php

namespace App\Http\Controllers;

use App\Models\RevenueReport;
use App\Models\TradeRequest;
use App\Models\MarketIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MOCCRevenueController extends Controller
{
    public function index()
    {
        // 💰 A. National Revenue Overview
        $stats = [
            'total_real_value' => RevenueReport::sum('real_market_value'),
            'total_declared_value' => RevenueReport::sum('declared_value'),
            'revenue_gap' => RevenueReport::sum('valuation_gap'),
            'expected_royalties' => RevenueReport::sum('royalty_amount'),
            'processing_fees' => RevenueReport::sum('processing_fee'),
        ];

        // 🚨 B. Risk Monitoring Panel
        $highRiskTrades = TradeRequest::with(['user', 'certificate'])
            ->whereIn('risk_level', ['HIGH', 'CRITICAL'])
            ->orderBy('risk_score', 'desc')
            ->take(10)
            ->get();

        // 📊 C. Revenue Analytics (By mineral type)
        $revenueByMineral = RevenueReport::join('trade_requests', 'revenue_reports.trade_request_id', '=', 'trade_requests.id')
            ->select('trade_requests.mineral_type', DB::raw('SUM(royalty_amount) as total_royalty'))
            ->groupBy('trade_requests.mineral_type')
            ->get();

        // Alerts (Undervalluation > 30%)
        $undervaluedAlerts = RevenueReport::where('risk_score', '>=', 50)
            ->with('tradeRequest.user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.revenue.index', compact('stats', 'highRiskTrades', 'revenueByMineral', 'undervaluedAlerts'));
    }
}
