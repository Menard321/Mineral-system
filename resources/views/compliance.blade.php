@extends('layouts.executive')

@section('title', 'GMITE - Compliance & Audit')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div class="flex items-center gap-5">
        <div class="w-14 h-14 bg-error/10 border border-error/20 rounded-2xl flex items-center justify-center">
            <span class="material-symbols-outlined text-error text-3xl">gavel</span>
        </div>
        <div>
            <h1 class="text-display-lg font-bold text-on-background tracking-tighter">Compliance & Audit</h1>
            <div class="flex items-center gap-3 mt-1 text-label-caps font-bold text-on-surface-variant">
                <span>Enforcement Protocol v4.0</span>
                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                <span class="text-error flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">radar</span> 4 Active Violations
                </span>
            </div>
        </div>
    </div>
    <div class="flex gap-3">
        <button class="px-6 py-2.5 bg-surface-container-high rounded border border-outline-variant text-xs font-bold hover:border-primary transition-all uppercase tracking-widest flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">assignment_late</span>
            Open Cases
        </button>
        <button class="btn-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">description</span>
            Generate Audit Report
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-surface-container-low border border-outline-variant p-5 rounded-2xl">
        <div class="flex justify-between items-start mb-4">
            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">License Applications</span>
            <span class="material-symbols-outlined text-primary">feed</span>
        </div>
        <div class="flex items-end gap-3 font-data-tabular">
            <span class="text-4xl font-bold text-on-background">42</span>
            <span class="text-xs text-on-surface-variant pb-1">PENDING REVIEW</span>
        </div>
        <div class="w-full bg-surface-container-highest h-1.5 mt-4 rounded-full overflow-hidden">
            <div class="bg-primary h-full w-[65%]"></div>
        </div>
    </div>

    <div class="bg-surface-container-low border border-outline-variant p-5 rounded-2xl">
        <div class="flex justify-between items-start mb-4">
            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Env. Compliance</span>
            <span class="material-symbols-outlined text-secondary">eco</span>
        </div>
        <div class="flex items-end gap-3 font-data-tabular">
            <span class="text-4xl font-bold text-secondary">94%</span>
            <span class="text-xs text-on-surface-variant pb-1">GLOBAL RATING</span>
        </div>
        <div class="w-full bg-surface-container-highest h-1.5 mt-4 rounded-full overflow-hidden">
            <div class="bg-secondary h-full w-[94%]"></div>
        </div>
    </div>

    <div class="bg-surface-container-low border border-outline-variant p-5 rounded-2xl">
        <div class="flex justify-between items-start mb-4">
            <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Illegal Hotspots</span>
            <span class="material-symbols-outlined text-error">satellite_alt</span>
        </div>
        <div class="flex items-end gap-3 font-data-tabular">
            <span class="text-4xl font-bold text-error">08</span>
            <span class="text-xs text-on-surface-variant pb-1">ACTIVE SIGNALS</span>
        </div>
        <div class="w-full bg-surface-container-highest h-1.5 mt-4 rounded-full overflow-hidden">
            <div class="bg-error h-full w-[20%]"></div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- License Approval System -->
    <div class="card-premium p-6 rounded-2xl">
        <div class="flex justify-between items-center mb-8 border-b border-outline-variant/30 pb-4">
            <h2 class="text-headline-sm font-bold flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">license</span>
                Mining License Approvals
            </h2>
            <button class="text-xs font-bold text-primary hover:underline uppercase">View All</button>
        </div>

        <div class="space-y-4">
            @php
                $licenses = [
                    ['project' => 'Northern Cobalt Expansion', 'app' => 'Global Minera Ltd', 'impact' => 'Medium', 'status' => 'Reviewing'],
                    ['project' => 'Katanga Deep Sea Mine', 'app' => 'Oceanic Resources', 'impact' => 'High', 'status' => 'Urgent'],
                    ['project' => 'Amazon Sector B Exploration', 'app' => 'Eco-Trace Group', 'impact' => 'Low', 'status' => 'Pending'],
                ];
            @endphp
            @foreach($licenses as $lic)
            <div class="p-4 bg-surface-container-high rounded-xl border border-outline-variant hover:bg-surface-container-highest transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <div class="text-[10px] font-bold text-primary uppercase mb-1">{{ $lic['app'] }}</div>
                        <div class="text-lg font-bold text-on-background">{{ $lic['project'] }}</div>
                        <div class="inline-flex items-center gap-3 mt-2">
                             <span class="text-[10px] font-bold flex items-center gap-1 {{ $lic['impact'] == 'High' ? 'text-error' : 'text-on-surface-variant' }}">
                                <span class="material-symbols-outlined text-xs">nature</span> Impact: {{ $lic['impact'] }}
                             </span>
                             <span class="text-[10px] font-bold text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">calendar_today</span> 12 May 2026
                             </span>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-surface-container-lowest border border-outline-variant rounded text-[10px] font-bold">{{ $lic['status'] }}</span>
                </div>
                <div class="flex gap-2 pt-4 border-t border-outline-variant/20 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0">
                    <button class="flex-1 py-1.5 bg-secondary text-on-secondary text-[10px] font-bold rounded uppercase tracking-widest hover:opacity-90">Approve License</button>
                    <button class="flex-1 py-1.5 bg-error text-on-error text-[10px] font-bold rounded uppercase tracking-widest hover:opacity-90">Reject License</button>
                    <button class="w-10 py-1.5 bg-surface-container-lowest border border-outline-variant flex items-center justify-center rounded"><span class="material-symbols-outlined text-xs">info</span></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Enforcement Monitor -->
    <div class="space-y-8">
        <div class="card-premium p-6 rounded-2xl relative overflow-hidden">
            <h2 class="text-headline-sm font-bold mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-error">policy</span>
                Active Violations & Enforcement
            </h2>
            <div class="space-y-4">
                <div class="flex gap-4 p-4 bg-error/5 border border-error/10 rounded-xl relative">
                    <div class="w-10 h-10 rounded-lg bg-error/10 flex items-center justify-center text-error">
                         <span class="material-symbols-outlined">satellite</span>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-error">VIO-9912: Illegal Surface Extraction</div>
                        <div class="text-[10px] text-on-surface-variant mb-3">Sector F-4 (Mato Grosso Reserve). Satellite imagery confirms night activity.</div>
                        <div class="flex gap-2">
                             <button class="text-[10px] font-bold px-3 py-1 bg-error text-on-error rounded uppercase tracking-widest">Investigate Case</button>
                             <button class="text-[10px] font-bold px-3 py-1 border border-error text-error rounded uppercase tracking-widest">Issue Sanction</button>
                        </div>
                    </div>
                    <span class="absolute top-4 right-4 text-[9px] font-bold text-on-surface-variant">48m ago</span>
                </div>

                <div class="flex gap-4 p-4 bg-surface-container-highest border border-outline-variant rounded-xl opacity-80">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-low flex items-center justify-center text-on-surface-variant">
                         <span class="material-symbols-outlined">water_drop</span>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-on-background">VIO-9908: Water Contamination</div>
                        <div class="text-[10px] text-on-surface-variant mb-1">Tailings leak detected in local river system by automated IoT sensors.</div>
                        <div class="text-[9px] font-bold text-secondary uppercase">Remediation in progress</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compliance Calendar / Schedule -->
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-2xl">
             <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 flex items-center gap-2 uppercase tracking-widest">
                <span class="material-symbols-outlined text-sm">event_note</span>
                Upcoming On-Site Audits
             </h3>
             <div class="grid grid-cols-1 gap-3">
                 @php
                    $audits = [
                        ['date' => 'MAY 14', 'loc' => 'Andean Copper Mines', 'lead' => 'Insp. Rossi'],
                        ['date' => 'MAY 18', 'loc' => 'Geita Gold Facility', 'lead' => 'Insp. Mbwana'],
                        ['date' => 'MAY 22', 'loc' => 'Pilbara Lithium Plant', 'lead' => 'Insp. Thompson'],
                    ];
                @endphp
                @foreach($audits as $audit)
                <div class="flex items-center justify-between p-3 bg-surface-container-high border border-outline-variant rounded-lg">
                    <div class="flex items-center gap-4">
                        <div class="text-center font-data-tabular">
                            <div class="text-[9px] text-on-surface-variant font-bold leading-none">{{ explode(' ', $audit['date'])[0] }}</div>
                            <div class="text-lg font-bold text-primary leading-none">{{ explode(' ', $audit['date'])[1] }}</div>
                        </div>
                        <div>
                            <div class="text-[11px] font-bold text-on-background">{{ $audit['loc'] }}</div>
                            <div class="text-[10px] text-on-surface-variant">{{ $audit['lead'] }}</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant text-sm hover:text-primary cursor-pointer transition-colors">calendar_month</span>
                </div>
                @endforeach
             </div>
        </div>
    </div>
</div>
@endsection