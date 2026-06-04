@extends('layouts.executive')

@section('title', 'GMITE - Trade Oversight')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center border border-primary/20">
            <span class="material-symbols-outlined text-primary">currency_exchange</span>
        </div>
        <div>
            <h1 class="text-display-lg font-bold text-on-background tracking-tight">Trade Oversight</h1>
            <p class="text-body-md text-on-surface-variant flex items-center gap-2">
                Monitoring global mineral transactions and lifecycle verification.
                 <span class="w-2 h-2 rounded-full bg-secondary animate-pulse ml-2"></span> LIVE TRADING ACTIVE
            </p>
        </div>
    </div>
    <div class="flex gap-3">
        <div class="bg-surface-container-high px-4 py-2 rounded-lg border border-outline-variant flex items-center gap-4">
             <div class="text-right">
                <div class="text-[9px] font-bold text-on-surface-variant">ESCROW SECURED</div>
                <div class="text-xs font-bold text-secondary">$142.8M</div>
             </div>
             <div class="w-px h-8 bg-outline-variant"></div>
             <div class="text-right">
                <div class="text-[9px] font-bold text-on-surface-variant">PENDING CLEARANCE</div>
                <div class="text-xs font-bold text-primary">$12.4M</div>
             </div>
        </div>
        <button class="btn-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">analytics</span>
            Trading Analytics
        </button>
    </div>
</div>

<!-- Trade Alert Panel -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
    @php
        $alerts = [
            ['title' => 'Suspicious Volume', 'loc' => 'Lithium Hub A', 'type' => 'WARNING', 'color' => 'tertiary'],
            ['title' => 'KYC Discrepancy', 'loc' => 'TR-9281 (Trader X)', 'type' => 'CRITICAL', 'color' => 'error'],
            ['title' => 'Shipment Delayed', 'loc' => 'Port of Singapore', 'type' => 'INFO', 'color' => 'primary'],
            ['title' => 'Trade Verified', 'loc' => 'TX-49210', 'type' => 'SUCCESS', 'color' => 'secondary'],
        ];
    @endphp
    @foreach($alerts as $alert)
    <div class="bg-surface-container-low border border-{{ $alert['color'] }}/30 p-4 rounded-xl relative overflow-hidden">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-[10px] font-bold text-{{ $alert['color'] }} uppercase mb-1">{{ $alert['type'] }}</div>
                <div class="font-bold text-on-background">{{ $alert['title'] }}</div>
                <div class="text-[10px] text-on-surface-variant mt-1">{{ $alert['loc'] }}</div>
            </div>
            <span class="material-symbols-outlined text-{{ $alert['color'] }} text-sm">
                {{ $alert['type'] == 'CRITICAL' ? 'security' : ($alert['type'] == 'WARNING' ? 'warning' : 'info') }}
            </span>
        </div>
        <div class="absolute bottom-0 left-0 h-1 bg-{{ $alert['color'] }}/30 w-full"></div>
    </div>
    @endforeach
</div>

<!-- Global Trade Monitor Table -->
<div class="card-premium rounded-xl overflow-hidden min-h-[500px]">
    <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-high flex justify-between items-center">
        <div class="flex gap-4">
            <h2 class="text-headline-sm font-bold">Transaction Monitor</h2>
            <div class="flex gap-1">
                <span class="px-3 py-1 bg-primary text-on-primary-container text-[10px] font-bold rounded cursor-pointer">ALL TRADES</span>
                <span class="px-3 py-1 bg-surface-container-lowest text-on-surface-variant text-[10px] font-bold rounded cursor-pointer hover:bg-surface-container-highest transition-colors uppercase">High Value</span>
                <span class="px-3 py-1 bg-surface-container-lowest text-on-surface-variant text-[10px] font-bold rounded cursor-pointer hover:bg-surface-container-highest transition-colors uppercase">Flagged</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
             <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-sm text-on-surface-variant">search</span>
                <input type="text" placeholder="TX Hash / Vessel / Party..." class="bg-surface-container-lowest border-outline-variant border rounded text-[11px] py-1 pl-9 pr-4 w-64 focus:ring-1 focus:ring-primary outline-none transition-all"/>
             </div>
             <button class="bg-surface-container-lowest p-1.5 rounded border border-outline-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-sm">download</span>
             </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest bg-surface-container-low">
                <tr>
                    <th class="px-6 py-4 border-b border-outline-variant">Transaction Hash</th>
                    <th class="px-6 py-4 border-b border-outline-variant">Parties (S → B)</th>
                    <th class="px-6 py-4 border-b border-outline-variant">Mineral Type</th>
                    <th class="px-6 py-4 border-b border-outline-variant text-right">Volume / Value</th>
                    <th class="px-6 py-4 border-b border-outline-variant">Tracking Status</th>
                    <th class="px-6 py-4 border-b border-outline-variant text-center">Verification</th>
                    <th class="px-6 py-4 border-b border-outline-variant">Oversight Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @php
                    $trades = [
                        ['hash' => '0x8f2d...49a1', 'seller' => 'Rio Tinto', 'buyer' => 'Hunan Valin', 'mineral' => 'Iron Ore Fin.', 'volume' => '120k MT', 'value' => '$11.8M', 'status' => 'IN_TRANSIT', 'vessel' => 'MV Oceanic Star', 'verify' => 'OK'],
                        ['hash' => '0x2c1e...9d22', 'seller' => 'Glencore', 'buyer' => 'CATL', 'mineral' => 'Nickel Sulfate', 'volume' => '1,500 MT', 'value' => '$28.4M', 'status' => 'LOADING', 'vessel' => 'MV Green Power', 'verify' => 'OK'],
                        ['hash' => '0x7b4a...1100', 'seller' => 'Tanzania Gold M.', 'buyer' => 'PAMP SA', 'mineral' => 'Gold (Dore Bars)', 'volume' => '250 KG', 'value' => '$16.2M', 'status' => 'SECURED_HL', 'vessel' => 'AIR_FRIGHT_AF421', 'verify' => 'FLAGGED'],
                        ['hash' => '0x4e9c...bb38', 'seller' => 'SQM Lithium', 'buyer' => 'LG Energy', 'mineral' => 'Lithium Carbonate', 'volume' => '800 MT', 'value' => '$9.1M', 'status' => 'CLEARING', 'vessel' => 'MV Blue Horizon', 'verify' => 'OK'],
                    ];
                @endphp
                @foreach($trades as $trade)
                <tr class="hover:bg-primary/5 transition-colors group cursor-default">
                    <td class="px-6 py-5">
                        <div class="font-data-tabular text-[11px] text-primary flex items-center gap-2">
                             {{ $trade['hash'] }}
                             <span class="material-symbols-outlined text-[12px] opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">content_copy</span>
                        </div>
                        <div class="text-[9px] text-on-surface-variant flex items-center gap-1 mt-1">
                             <span class="material-symbols-outlined text-[10px]">vessel_filter</span> {{ $trade['vessel'] }}
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="text-[11px] font-bold text-on-background">{{ $trade['seller'] }}</div>
                        <div class="material-symbols-outlined text-[11px] text-on-surface-variant py-0.5">south</div>
                        <div class="text-[11px] font-bold text-on-background">{{ $trade['buyer'] }}</div>
                    </td>
                    <td class="px-6 py-5 font-bold text-[11px] text-on-background">
                         {{ $trade['mineral'] }}
                    </td>
                    <td class="px-6 py-5 text-right">
                         <div class="text-[11px] font-bold text-on-background">{{ $trade['volume'] }}</div>
                         <div class="text-[11px] text-primary font-data-tabular">{{ $trade['value'] }}</div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <span class="w-10 h-1 mt-0.5 bg-surface-container-high rounded-full overflow-hidden">
                                <span class="bg-secondary h-full" style="width: {{ rand(30, 95) }}%"></span>
                            </span>
                            <span class="text-[9px] font-bold text-on-surface-variant">{{ $trade['status'] }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @if($trade['verify'] == 'OK')
                            <span class="material-symbols-outlined text-secondary bg-secondary/10 p-1.5 rounded-full text-sm">verified_user</span>
                        @else
                            <span class="material-symbols-outlined text-error bg-error/10 p-1.5 rounded-full text-sm animate-bounce">report</span>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <button class="h-8 w-8 rounded border border-outline-variant flex items-center justify-center hover:text-primary transition-colors" title="Track Shipment">
                                <span class="material-symbols-outlined text-sm">near_me</span>
                            </button>
                            <button class="h-8 w-8 rounded border border-outline-variant flex items-center justify-center hover:text-primary transition-colors" title="View Documentation">
                                <span class="material-symbols-outlined text-sm">description</span>
                            </button>
                            <div class="relative group/action">
                                <button class="h-8 w-8 rounded bg-surface-container-highest border border-outline-variant flex items-center justify-center hover:bg-primary hover:text-on-primary-container transition-all">
                                    <span class="material-symbols-outlined text-sm">more_vert</span>
                                </button>
                                <div class="absolute right-0 top-full mt-2 w-48 bg-surface-container rounded-lg border border-outline-variant shadow-xl z-20 opacity-0 invisible group-hover/action:opacity-100 group-hover/action:visible transition-all">
                                     <div class="p-2 space-y-1">
                                        <button class="w-full text-left px-3 py-2 text-[10px] font-bold hover:bg-primary/10 rounded flex items-center gap-2 text-secondary uppercase">
                                            <span class="material-symbols-outlined text-sm">check_circle</span> Approve Trade
                                        </button>
                                        <button class="w-full text-left px-3 py-2 text-[10px] font-bold hover:bg-error/10 rounded flex items-center gap-2 text-error uppercase">
                                            <span class="material-symbols-outlined text-sm">block</span> Block Trade
                                        </button>
                                        <button class="w-full text-left px-3 py-2 text-[10px] font-bold hover:bg-tertiary/10 rounded flex items-center gap-2 text-tertiary uppercase">
                                            <span class="material-symbols-outlined text-sm">flag</span> Flag Shipment
                                        </button>
                                        <div class="h-px bg-outline-variant my-1"></div>
                                        <button class="w-full text-left px-3 py-2 text-[10px] font-bold hover:bg-surface-container-highest rounded flex items-center gap-2 uppercase">
                                            <span class="material-symbols-outlined text-sm">summarize</span> Trade Report
                                        </button>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bottom Intelligence Layer -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 pb-12">
    <div class="card-premium p-6 rounded-xl">
        <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase flex items-center gap-2">
             <span class="material-symbols-outlined text-sm">hub</span>
             Trade Lifecycle Distribution
        </h3>
        <div class="space-y-6">
            @php
                $steps = [
                    ['label' => 'Negotiation & Contract', 'val' => 14, 'color' => 'primary'],
                    ['label' => 'Mineral Certification', 'val' => 28, 'color' => 'tertiary'],
                    ['label' => 'Customs Clearance', 'val' => 12, 'color' => 'warning'],
                    ['label' => 'In-Transit / Logistics', 'val' => 45, 'color' => 'secondary'],
                ];
            @endphp
            @foreach($steps as $step)
            <div>
                <div class="flex justify-between text-[11px] mb-2 font-bold uppercase">
                    <span class="text-on-surface-variant">{{ $step['label'] }}</span>
                    <span>{{ $step['val'] }} ACTIVE</span>
                </div>
                <div class="w-full bg-surface-container-lowest h-2 rounded-full overflow-hidden">
                    <div class="h-full bg-{{ $step['color'] ?? 'primary' }}" style="width: {{ $step['val'] * 2 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- AI Anomaly Center -->
    <div class="bg-surface-container-low border border-outline-variant p-6 rounded-xl relative overflow-hidden group">
         <div class="absolute -right-4 -top-4 w-32 h-32 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-all"></div>
         <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm text-primary">psychology</span>
            AI FORENSICS: ABNORMAL PATTERNS
         </h3>
         <div class="space-y-4">
             <div class="p-3 bg-surface-container-high rounded border border-outline-variant flex items-start gap-3">
                 <span class="material-symbols-outlined text-warning text-sm mt-0.5">query_stats</span>
                 <div>
                    <div class="text-[11px] font-bold text-on-background">Non-Linear Pricing Route</div>
                    <div class="text-[10px] text-on-surface-variant">Lithium from Brazil entering Europe via unusual Asian redirection.</div>
                 </div>
             </div>
             <div class="p-3 bg-surface-container-high rounded border border-outline-variant flex items-start gap-3">
                 <span class="material-symbols-outlined text-error text-sm mt-0.5">vpn_lock</span>
                 <div>
                    <div class="text-[11px] font-bold text-on-background">Proxy Jurisdiction Signal</div>
                    <div class="text-[10px] text-on-surface-variant">Vessel ID mask detected in sanctioned coastal waters. High correlation with unregulated cobalt extraction.</div>
                 </div>
             </div>
         </div>
         <button class="mt-6 w-full text-center text-[10px] font-bold text-primary tracking-widest hover:underline uppercase">ENTER FULL FORENSIC CONSOLE</button>
    </div>
</div>
@endsection