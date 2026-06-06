<?php

namespace App\Http\Controllers;

use App\Models\TradeRequest;
use App\Models\Certificate;
use App\Services\RevenueAssurance\RevenueAssuranceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeRequestController extends Controller
{
    protected $revenueService;

    public function __construct(RevenueAssuranceService $revenueService)
    {
        $this->revenueService = $revenueService;
    }

    public function index()
    {
        $trades = TradeRequest::where('user_id', Auth::id())->latest()->get();
        return view('trades.index', compact('trades'));
    }

    public function create()
    {
        // Only allow trading certified samples
        $certificates = Certificate::where('user_id', Auth::id())
            ->where('status', 'ACTIVE') // Ensuring certificate is active
            ->get();
            
        return view('trades.create', compact('certificates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'quantity_kg' => 'required|numeric|min:0.01',
            'value_usd' => 'required|numeric|min:1',
            'buyer_name' => 'required|string',
            'buyer_country' => 'required|string',
            'destination_port' => 'required|string',
        ]);

        $cert = Certificate::findOrFail($request->certificate_id);

        $trade = TradeRequest::create([
            'trade_id' => TradeRequest::generateId(),
            'user_id' => Auth::id(),
            'certificate_id' => $cert->id,
            'mineral_type' => $cert->mineral_type,
            'quantity_kg' => $request->quantity_kg,
            'trade_type' => 'EXPORT',
            'buyer_name' => $request->buyer_name,
            'buyer_country' => $request->buyer_country,
            'value_usd' => $request->value_usd,
            'destination_port' => $request->destination_port,
            'status' => 'PENDING',
        ]);

        // 🧠 TRIGGER: Revenue Assurance Engine
        $report = $this->revenueService->analyzeExport($trade);

        // Update trade with risk results
        $trade->update([
            'risk_score' => $report->risk_score,
            'risk_level' => $report->risk_level,
        ]);

        return redirect()->route('user.trades.index')->with('success', 'Export Application Submitted. Awaiting Revenue Assurance Validation.');
    }
}
