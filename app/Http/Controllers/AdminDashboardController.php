<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\License;
use App\Models\MineralSample;
use App\Models\TradeRequest;
use App\Models\SystemAlert;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'active_samples' => MineralSample::whereNotIn('status', ['completed', 'rejected'])->count(),
            'pending_trades' => TradeRequest::where('status', 'pending')->count(),
            'revenue_usd' => TradeRequest::where('status', 'completed')->sum('value_usd'),
            'alerts' => SystemAlert::where('status', '!=', 'RESOLVED')->count(),
        ];

        $recent_trades = TradeRequest::with('user')->latest()->take(5)->get();
        $recent_activities = AuditLog::with('admin')
            ->latest('timestamp')
            ->take(8)
            ->get();

        return view('dashboard', compact('stats', 'recent_trades', 'recent_activities'));
    }

    public function controlCenter()
    {
        $alerts = SystemAlert::latest()->take(10)->get();
        $samples = MineralSample::latest()->take(5)->get();
        $trades = TradeRequest::latest()->take(5)->get();
        
        return view('control_center', compact('alerts', 'samples', 'trades'));
    }

    public function tradeMarket()
    {
        $trades = TradeRequest::with('user')->latest()->get();
        $trade_stats = [
            'active' => TradeRequest::whereIn('status', ['pending', 'lab_verified', 'compliance_approved', 'export_cleared'])->count(),
            'value' => TradeRequest::sum('value_usd'),
            'total' => TradeRequest::count(),
        ];
        return view('trade_market', compact('trades', 'trade_stats'));
    }

    public function analytics()
    {
        // National trends logic
        return view('analytics');
    }

    public function compliance()
    {
        $companies = Company::with(['user', 'latestComplianceReview', 'violations'])->latest()->get();
        $licenses = License::with(['user', 'company'])->latest()->get();
        return view('compliance', compact('companies', 'licenses'));
    }

    public function users()
    {
        $users = User::with('role')->latest()->get();
        $roles = \App\Models\Role::all();
        return view('users_management', compact('users', 'roles'));
    }

    public function alertsCenter()
    {
        $system_alerts = SystemAlert::latest()->get();
        $notifications = \App\Models\Notification::with('user')->latest()->get();
        return view('alerts_center', compact('system_alerts', 'notifications'));
    }

    public function configuration()
    {
        return view('configuration');
    }
}
