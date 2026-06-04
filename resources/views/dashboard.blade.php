@extends('layouts.admin')

@section('title', 'GMITE - Global Control Center')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
    <!-- System Health -->
    <div class="card-premium p-4 rounded-xl">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">System Health</span>
            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
        </div>
        <div class="text-headline-md font-bold text-on-background">99.9%</div>
        <div class="text-[10px] text-secondary mt-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">trending_up</span> ALL NODES OPERATIONAL
        </div>
    </div>

    <!-- Active Traders -->
    <div class="card-premium p-4 rounded-xl">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">Active Institutions</span>
            <span class="material-symbols-outlined text-primary text-sm">account_balance</span>
        </div>
        <div class="text-headline-md font-bold text-on-background">1,284</div>
        <div class="text-[10px] text-on-surface-variant mt-1">42 NEW REGISTRATIONS TODAY</div>
    </div>

    <!-- Global Trade Volume -->
    <div class="card-premium p-4 rounded-xl">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">24h Trade Volume</span>
            <span class="material-symbols-outlined text-primary text-sm">payments</span>
        </div>
        <div class="text-headline-md font-bold text-on-background">$4.2B</div>
        <div class="text-[10px] text-secondary mt-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">trending_up</span> +12.5% VS PREVIOUS 24H
        </div>
    </div>

    <!-- Critical Alerts -->
    <div class="card-premium p-4 rounded-xl border-l-4 border-l-error">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">Critical Anomalies</span>
            <span class="material-symbols-outlined text-error text-sm">warning</span>
        </div>
        <div class="text-headline-md font-bold text-error">12</div>
        <div class="text-[10px] text-error mt-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">security</span> FRAUD DETECTION ACTIVE
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Global Control Center Section -->
    <div class="lg:col-span-2 space-y-6">
        <div class="card-premium p-6 rounded-xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-headline-sm font-bold flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">hub</span>
                    Global Real-Time Trade Monitoring
                </h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-surface-container-high rounded text-[10px] font-bold border border-outline-variant hover:bg-surface-container-highest transition-colors">LIVE FEED</button>
                    <button class="px-3 py-1 bg-surface-container-high rounded text-[10px] font-bold border border-outline-variant hover:bg-surface-container-highest transition-colors">HISTORY</button>
                </div>
            </div>
            
            <div class="space-y-4">
                @php
                    $trades = [
                        ['mineral' => 'Lithium', 'origin' => 'Chile', 'val' => '$24.5M', 'status' => 'VERIFIED'],
                        ['mineral' => 'Copper', 'origin' => 'DRC', 'val' => '$12.2M', 'status' => 'PENDING_LAB'],
                        ['mineral' => 'Gold', 'origin' => 'Tanzania', 'val' => '$8.4M', 'status' => 'EN_ROUTE'],
                        ['mineral' => 'Cobalt', 'origin' => 'Australia', 'val' => '$15.1M', 'status' => 'VERIFIED'],
                    ];
                @endphp
                @foreach($trades as $trade)
                <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant rounded-lg hover:border-primary transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded bg-surface-container-highest flex items-center justify-center border border-outline-variant group-hover:bg-primary/10 transition-colors">
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">database</span>
                        </div>
                        <div>
                            <div class="font-bold text-on-background">{{ $trade['mineral'] }} Shipment #{{ rand(1000, 9999) }}</div>
                            <div class="text-[10px] text-on-surface-variant flex items-center gap-2">
                                <span class="material-symbols-outlined text-[12px]">public</span> {{ $trade['origin'] }} → GLOBAL PORT
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-data-tabular font-bold text-primary">{{ $trade['val'] }}</div>
                        <div class="text-[10px] {{ $trade['status'] == 'VERIFIED' ? 'text-secondary' : ($trade['status'] == 'PENDING_LAB' ? 'text-tertiary' : 'text-primary') }} font-bold">
                            {{ $trade['status'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Country Activity Summary -->
        <div class="card-premium p-6 rounded-xl">
             <h2 class="text-headline-sm font-bold mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">public</span>
                National Mining Activity Summary
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @php
                    $countries = [
                        ['name' => 'Tanzania', 'production' => '84,000t', 'revenue' => '$1.2B', 'trend' => '+4.1%'],
                        ['name' => 'Chile', 'production' => '210,000t', 'revenue' => '$3.4B', 'trend' => '+2.8%'],
                        ['name' => 'Australia', 'production' => '150,000t', 'revenue' => '$2.9B', 'trend' => '+1.5%'],
                        ['name' => 'DRC', 'production' => '45,000t', 'revenue' => '$1.8B', 'trend' => '-1.2%'],
                    ];
                @endphp
                @foreach($countries as $country)
                <div class="p-4 bg-surface-container-highest rounded border border-outline-variant relative overflow-hidden group">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-on-background">{{ $country['name'] }}</span>
                        <span class="text-[10px] {{ str_contains($country['trend'], '+') ? 'text-secondary' : 'text-error' }} font-bold">{{ $country['trend'] }}</span>
                    </div>
                    <div class="flex justify-between text-[11px] text-on-surface-variant">
                        <span>Production: {{ $country['production'] }}</span>
                        <span>Revenue: {{ $country['revenue'] }}</span>
                    </div>
                    <div class="absolute bottom-0 left-0 h-0.5 bg-primary w-0 group-hover:w-full transition-all duration-500"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar actions & Analytics -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-surface-container-high border border-outline-variant p-6 rounded-xl">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-4">EXECUTIVE ACTIONS</h3>
            <div class="grid grid-cols-1 gap-3">
                <a href="/reporting" class="btn-primary w-full flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    Global Intelligence Report
                </a>
                <a href="/intelligence-map" class="w-full py-2 bg-surface-container-highest text-on-surface font-bold text-sm rounded border border-outline-variant hover:border-primary transition-all flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm text-primary">map</span>
                    World Mining Map
                </a>
                <a href="/analytics" class="w-full py-2 bg-surface-container-highest text-on-surface font-bold text-sm rounded border border-outline-variant hover:border-primary transition-all flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm text-primary">query_stats</span>
                    System Analytics
                </a>
                <a href="/security" class="w-full py-2 bg-surface-container-highest text-on-surface font-bold text-sm rounded border border-outline-variant hover:border-primary transition-all flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm text-error">notification_important</span>
                    View Critical Alerts
                </a>
                <a href="/users" class="w-full py-2 bg-surface-container-highest text-on-surface font-bold text-sm rounded border border-outline-variant hover:border-primary transition-all flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm text-primary">group</span>
                    Manage Users
                </a>
                <a href="/configuration" class="w-full py-2 bg-surface-container-highest text-on-surface font-bold text-sm rounded border border-outline-variant hover:border-primary transition-all flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm text-primary">settings</span>
                    System Configuration
                </a>
                <a href="/reporting" class="w-full py-2 bg-surface-container-highest text-on-surface font-bold text-sm rounded border border-outline-variant hover:border-primary transition-all flex items-center gap-2 justify-center">
                    <span class="material-symbols-outlined text-sm text-primary">file_download</span>
                    Export Executive Report
                </a>
            </div>
        </div>

        <!-- Compliance Violations Section -->
        <div class="card-premium p-6 rounded-xl border border-error/20">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-label-caps font-bold text-error">Compliance Violations</h3>
                <span class="material-symbols-outlined text-error text-sm animate-pulse">report</span>
            </div>
            <div class="space-y-3">
                <div class="p-3 bg-error/5 border border-error/20 rounded">
                    <div class="text-[11px] font-bold text-error">ILLEGAL MINING DETECTED</div>
                    <div class="text-[10px] text-on-surface-variant">Zone 42 - Amazon Basin (Sector G)</div>
                </div>
                <div class="p-3 bg-surface-container-highest border border-outline-variant rounded opacity-70">
                    <div class="text-[11px] font-bold text-on-surface">EXPORT LICENSE EXPIRED</div>
                    <div class="text-[10px] text-on-surface-variant">Trader: Global Resources Ltd.</div>
                </div>
            </div>
            <button class="mt-4 w-full text-[10px] font-bold text-primary hover:underline">VIEW ALL COMPLIANCE CASES</button>
        </div>

        <!-- User/System Activity -->
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-xl">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-4">System Activity</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-secondary grow-0 shadow-[0_0_5px_#4edea3]"></div>
                    <div class="text-[11px] text-on-surface"><span class="font-bold">World Bank Auditor</span> logged in from Washington DC</div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-primary grow-0"></div>
                    <div class="text-[11px] text-on-surface"><span class="font-bold">National Authority</span> approved Mineral Shipment #4921</div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-tertiary grow-0"></div>
                    <div class="text-[11px] text-on-surface"><span class="font-bold">AI Forecaster</span> updated Copper projection for Q3</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection