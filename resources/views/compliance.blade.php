@extends('layouts.admin')

@section('title', 'GMITE - Regulatory Enforcement')

@section('content')
<!-- Compliance Executive Header -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative group">
            <div class="absolute inset-0 bg-error/20 rounded-2xl blur-2xl group-hover:bg-error/40 transition-all duration-700 font-black"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-error/40 rounded-[28px] flex items-center justify-center text-error shadow-2xl">
                 <span class="material-symbols-outlined text-4xl group-hover:scale-110 transition-transform duration-500">gavel</span>
            </div>
        </div>
        <div>
             <div class="flex items-center gap-4">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Regulatory Enforcement</h1>
                <span class="bg-error/10 text-error text-[10px] font-black px-3 py-1 rounded-full border border-error/20 tracking-[0.2em] uppercase animate-pulse">Live Oversight</span>
             </div>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60 font-data-tabular">National Mineral Compliance & Law Enforcement [GMITE-REG]</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="triggerExecutiveAction('Initialize Regulatory Audit')" class="px-8 py-4 bg-error text-on-error-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 transition-all flex items-center gap-4 shadow-2xl shadow-error/20">
            <span class="material-symbols-outlined text-xl">policy</span>
            Launch Field Audit
        </button>
        <button onclick="triggerExecutiveAction('Rule Management Terminal')" class="px-8 py-4 bg-surface-container-low text-on-surface rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] border border-outline-variant hover:border-error transition-all flex items-center gap-4">
            <span class="material-symbols-outlined text-xl">rule</span>
            Manage Laws
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Enforcement Command Column -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Live Investigation Lifecycle -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden group/incidents">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase flex items-center gap-4">
                    <span class="w-1.5 h-8 bg-error rounded-full"></span>
                    Active Compliance Cases
                </h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                        <input type="text" placeholder="Search cases / companies..." class="bg-surface-container-highest border border-outline-variant rounded-full pl-12 pr-6 py-2 text-[11px] font-bold text-on-surface w-64 focus:border-error outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @if(isset($companies) && count($companies) > 0)
                    @foreach($companies as $c)
                    <div class="p-6 bg-surface-container-low border border-outline-variant/50 hover:border-error/40 rounded-3xl transition-all group/case relative overflow-hidden">
                        <div class="absolute inset-y-0 left-0 w-1 bg-{{ $c->status_color == 'secondary' ? 'secondary' : 'error animate-pulse' }}"></div>
                        <div class="flex flex-col md:flex-row justify-between gap-8 relative z-10">
                            <div class="flex gap-6">
                                <div class="w-14 h-14 bg-surface-container-highest border border-outline-variant rounded-2xl flex items-center justify-center text-on-surface-variant group-hover/case:text-error transition-all group-hover/case:scale-105 duration-500">
                                    <span class="material-symbols-outlined text-3xl">apartment</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <span class="text-[9px] font-black text-error uppercase tracking-[0.2em] font-data-tabular">REG: {{ $c->reg_number }}</span>
                                        <span class="w-1 h-1 bg-outline rounded-full"></span>
                                        <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest">{{ $c->category }}</span>
                                    </div>
                                    <div class="text-xl font-black text-on-background tracking-tighter uppercase mb-1">{{ $c->name }}</div>
                                    <div class="text-[10px] font-bold text-on-surface-variant flex items-center gap-2 opacity-60 uppercase">
                                        <span class="material-symbols-outlined text-[14px]">account_circle</span> SUBMITTED BY: {{ $c->user->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-10">
                                <div class="text-right">
                                    <div class="text-[10px] font-black text-{{ $c->status_color }} uppercase tracking-widest mb-1">{{ strtoupper(str_replace('_', ' ', $c->status)) }}</div>
                                    <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-40">Oversight Level: 4.2</div>
                                </div>
                                <button class="bg-error text-on-error-container px-6 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-error/20">Verify Entity</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                @if(isset($licenses) && count($licenses) > 0)
                    @foreach($licenses as $l)
                    <div class="p-6 bg-surface-container-low border border-outline-variant/50 hover:border-primary/40 rounded-3xl transition-all group/case relative overflow-hidden">
                        <div class="absolute inset-y-0 left-0 w-1 bg-primary"></div>
                        <div class="flex flex-col md:flex-row justify-between gap-8 relative z-10">
                            <div class="flex gap-6">
                                <div class="w-14 h-14 bg-surface-container-highest border border-outline-variant rounded-2xl flex items-center justify-center text-on-surface-variant group-hover/case:text-primary transition-all group-hover/case:scale-105 duration-500">
                                    <span class="material-symbols-outlined text-3xl">badge</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <span class="text-[9px] font-black text-primary uppercase tracking-[0.2em] font-data-tabular">LIC: {{ $l->license_id }}</span>
                                        <span class="w-1 h-1 bg-outline rounded-full"></span>
                                        <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest">{{ $l->type }}</span>
                                    </div>
                                    <div class="text-xl font-black text-on-background tracking-tighter uppercase mb-1">{{ $l->company->name ?? 'REGISTRATION PENDING' }}</div>
                                    <div class="text-[10px] font-bold text-on-surface-variant flex items-center gap-2 opacity-60 uppercase">
                                        <span class="material-symbols-outlined text-[14px]">account_circle</span> APPLICANT: {{ $l->user->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-10">
                                <div class="text-right">
                                    <div class="text-[10px] font-black text-{{ $l->status_color }} uppercase tracking-widest mb-1">{{ strtoupper(str_replace('_', ' ', $l->status)) }}</div>
                                    <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-40">Oversight Level: 4.2</div>
                                </div>
                                <button class="bg-primary text-on-primary-container px-6 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primary/20">Review App</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                @if((!isset($companies) || count($companies) == 0) && (!isset($licenses) || count($licenses) == 0))
                    <div class="py-20 text-center border border-dashed border-outline-variant rounded-[40px] opacity-20">
                        <span class="material-symbols-outlined text-6xl mb-4">fact_check</span>
                        <div class="text-[10px] font-black uppercase tracking-[0.3em]">No Compliance Cases Logged</div>
                    </div>
                @endif
            </div>

            <button class="w-full mt-10 py-4 bg-surface-container-highest border border-outline-variant rounded-2xl text-[11px] font-black uppercase tracking-[0.3em] text-on-surface hover:text-error transition-all">
                Access Full Enforcement Archive
            </button>
        </div>

        <!-- Entity Compliance Scoring Registry -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden group/compliance">
             <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-10 flex items-center gap-4">
                <span class="material-symbols-outlined text-primary">assessment</span>
                Entity Risk & Reputation Matrix
             </h2>
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(isset($companies) && count($companies) > 0)
                    @foreach($companies as $c)
                    @php
                        $score = $c->latestComplianceReview->compliance_score ?? 100.0;
                        $status = $c->latestComplianceReview->status ?? 'COMPLIANT';
                        $col = $status == 'COMPLIANT' ? 'secondary' : ($status == 'WARNING' ? 'primary' : 'error');
                    @endphp
                    <div class="p-6 bg-surface-container-low border border-outline-variant rounded-[32px] group/entity hover:border-{{ $col }}/50 transition-all cursor-pointer">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex-1 pr-4">
                                 <div class="text-[12px] font-black text-on-background uppercase tracking-tight truncate">{{ $c->name }}</div>
                                 <div class="text-[9px] font-black text-{{ $col }} uppercase tracking-widest mt-1">{{ $status }}</div>
                            </div>
                            <div class="text-right shrink-0">
                                 <div class="text-2xl font-black text-on-background font-data-tabular">{{ number_format($score / 10, 1) }}</div>
                                 <div class="text-[8px] font-bold text-on-surface-variant uppercase opacity-40">Matrix Score</div>
                            </div>
                        </div>
                        <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                            <div class="h-full bg-{{ $col }} transition-all duration-[2000ms]" style="width: {{ $score }}%"></div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-2 py-10 text-center opacity-20">
                        <p class="text-[10px] font-black uppercase tracking-widest">No entities registered for matrix analysis</p>
                    </div>
                @endif
             </div>
        </div>
    </div>

    <!-- Right Regulatory Column -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Emergency Enforcement Terminal -->
        <div class="bg-error/5 border border-error/20 p-8 rounded-[48px] relative overflow-hidden">
             <div class="absolute top-0 right-0 p-8 opacity-10">
                <span class="material-symbols-outlined text-6xl">not_interested</span>
             </div>
             <h3 class="text-label-caps font-black text-error mb-10 tracking-[0.3em] uppercase opacity-60">High-Authority Sanctions</h3>
             <div class="space-y-4">
                 @php
                    $sanctions = [
                        ['label' => 'Suspend Mining license', 'id' => 'SAN-01'],
                        ['label' => 'Block Trade Access', 'id' => 'SAN-02'],
                        ['label' => 'Freeze Export Permit', 'id' => 'SAN-03'],
                        ['label' => 'Flag Entity Blacklist', 'id' => 'SAN-04'],
                    ];
                 @endphp
                 @foreach($sanctions as $s)
                 <button onclick="triggerExecutiveAction('Enforce {{ $s['label'] }} Protocol')" class="w-full flex items-center justify-between p-6 bg-surface-container-high border border-outline-variant/30 rounded-3xl group hover:border-error transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-error/10 text-error rounded-xl flex items-center justify-center border border-error/20 group-hover:scale-110 transition-transform">
                             <span class="material-symbols-outlined text-xl">gavel</span>
                        </div>
                        <span class="text-[11px] font-black uppercase tracking-widest text-on-surface opacity-80 group-hover:opacity-100">{{ $s['label'] }}</span>
                    </div>
                    <span class="material-symbols-outlined text-lg text-on-surface-variant group-hover:text-error transition-colors">verified_user</span>
                 </button>
                 @endforeach
             </div>
        </div>

        <!-- Automatic Violation Steam (AI Discovery) -->
        <div class="card-premium p-8 rounded-[40px] border border-error/30 bg-error-[2%] relative overflow-hidden">
             <div class="absolute -top-12 -right-12 w-48 h-48 bg-error/5 rounded-full blur-3xl opacity-40"></div>
             <h3 class="text-label-caps font-black text-error mb-8 tracking-[0.2em] uppercase flex items-center gap-3">
                 <span class="material-symbols-outlined text-xl animate-pulse">radar</span>
                 Live Anomaly Radar
             </h3>
             <div class="space-y-6">
                @php
                    $alerts = [
                        ['msg' => 'Unauthorized Export Corridor activity detected near Sub-Node 04.', 'type' => 'CRITICAL'],
                        ['msg' => 'Environmental Clearance Certificate expired for AngloGold batch B-921.', 'type' => 'WARNING'],
                    ];
                @endphp
                @foreach($alerts as $a)
                <div class="p-6 bg-surface-container-low border border-error/10 rounded-2xl">
                    <div class="text-[8px] font-black text-error uppercase tracking-widest mb-1">{{ $a['type'] }} THREAT</div>
                    <p class="text-[11px] font-bold text-on-surface/80 uppercase tracking-tight leading-relaxed">{{ $a['msg'] }}</p>
                    <div class="mt-4 flex gap-3">
                        <button class="text-[9px] font-black text-error uppercase tracking-widest">Intervene</button>
                        <span class="text-white/10">|</span>
                        <button class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest">Mark Clear</button>
                    </div>
                </div>
                @endforeach
             </div>
        </div>

        <!-- Audit & Digital Signature Hub -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] space-y-8 h-fit">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.2em] uppercase opacity-60">Inspection Registry</h3>
            <div class="p-6 bg-surface-container-highest rounded-[32px] border border-outline-variant flex items-center gap-5">
                <div class="w-14 h-14 bg-secondary/10 border border-secondary/30 rounded-2xl flex items-center justify-center text-secondary relative">
                     <span class="material-symbols-outlined text-3xl">verified</span>
                     <div class="absolute -top-2 -right-2 w-5 h-5 bg-secondary text-on-secondary text-[8px] font-black rounded-full flex items-center justify-center border-2 border-surface-container-highest">18</div>
                </div>
                <div>
                    <div class="text-[12px] font-black text-on-background uppercase tracking-tight mb-0.5">Signed Field Reports</div>
                    <p class="text-[9px] font-bold text-on-surface-variant opacity-60 uppercase tracking-widest">Verified Q2 2026</p>
                </div>
            </div>
            <p class="text-[10px] font-bold text-on-surface-variant leading-relaxed uppercase tracking-wider px-2">
                All enforcement actions are cryptographically notarized to ensure legal admissibility in Sovereign Trade Courts.
            </p>
        </div>
    </div>
</div>
@endsection