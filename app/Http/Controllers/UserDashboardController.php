<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Company;
use App\Models\License;
use App\Models\JointVenture;
use App\Models\MineralSample;
use App\Models\TradeRequest;
use App\Models\Certificate;
use App\Models\SystemAlert;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user()->load(['mineralSamples', 'tradeRequests', 'certificates', 'notifications']);
        
        $stats = [
            'samples' => $user->mineralSamples->count(),
            'trades' => $user->tradeRequests->where('status', 'pending')->count(),
            'certs' => $user->certificates->count(),
            'compliance' => $user->companies->first() ? ($user->companies->first()->complianceRecord->compliance_score ?? 94.2) : 100.0,
            'alerts' => $user->notifications()->where('read_status', false)->count(),
        ];

        $activities = $user->notifications()
            ->latest()
            ->take(8)
            ->get()
            ->map(function($n) {
                return [
                    'type' => $n->type,
                    'msg' => $n->title . ': ' . $n->message,
                    'time' => $n->created_at->diffForHumans(),
                    'col' => $n->type == 'CRITICAL' ? 'error' : ($n->type == 'WARNING' ? 'warning' : 'secondary'),
                    'icon' => $n->type == 'CRITICAL' ? 'gpp_maybe' : 'notifications'
                ];
            });

        $alerts = $user->notifications()
            ->where('type', 'CRITICAL')
            ->latest()
            ->take(3)
            ->get();

        return view('generaldashboard', compact('stats', 'activities', 'alerts'));
    }

    public function business()
    {
        $user = auth()->user()->load(['companies.directors', 'licenses.company']);
        $companies = $user->companies;
        $licenses = $user->licenses;
        
        $stats = [
            'companies' => $companies->count(),
            'licenses' => $licenses->count(),
            'pending' => $licenses->whereIn('status', ['submitted', 'under_review'])->count(),
            'compliance' => $companies->first() ? ($companies->first()->complianceRecord->compliance_score ?? 9.5) : 10.0,
        ];

        return view('business_center', compact('companies', 'licenses', 'stats'));
    }

    public function investor()
    {
        $user = auth()->user()->load(['investorProfile.applications.opportunity', 'jointVentures']);
        $investor = $user->investorProfile;
        
        $opportunities = \App\Models\InvestmentOpportunity::where('status', 'OPEN')->latest()->take(5)->get();
        $applications = $investor ? $investor->applications : collect();

        $stats = [
            'investments' => $applications->count(),
            'total' => '$' . number_format($applications->sum(fn($a) => $a->opportunity->estimated_value / 10), 1) . 'M',
            'opps' => $opportunities->count(),
            'jvs' => $user->jointVentures->count(),
        ];

        return view('investor_center', compact('opportunities', 'applications', 'stats', 'investor'));
    }

    public function labDiagnostics()
    {
        $user = auth()->user()->load(['mineralSamples.labTests.results', 'mineralSamples.tracking']);
        $samples = $user->mineralSamples;
        return view('lab_diagnostics', compact('samples'));
    }

    public function alerts()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->get();
        $system_alerts = $user->alerts()->latest()->get();
        return view('alerts_center', compact('notifications', 'system_alerts'));
    }
}
