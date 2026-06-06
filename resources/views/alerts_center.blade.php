@extends('layouts.admin')

@section('title', 'GMITE - National Alerts Center')

@section('content')
<!-- Alerts Center Branding -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative group">
            <div class="absolute inset-0 bg-error/20 rounded-2xl blur-2xl group-hover:bg-error/40 transition-all duration-700"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-error/40 rounded-[28px] flex items-center justify-center text-error shadow-2xl">
                 <span class="material-symbols-outlined text-4xl animate-pulse">notifications_active</span>
            </div>
        </div>
        <div>
             <div class="flex items-center gap-4">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Alert Intelligence</h1>
                <span class="bg-error/10 text-error text-[10px] font-black px-3 py-1 rounded-full border border-error/20 tracking-[0.2em] uppercase">Live Monitoring</span>
             </div>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60 font-data-tabular">Central Nervous System [GMITE-ALRT]</p>
        </div>
    </div>
    <div class="flex items-center gap-4 bg-surface-container-low px-6 py-3 rounded-2xl border border-outline-variant/30">
        <div class="text-right">
            <div class="text-[9px] font-black text-white/30 uppercase tracking-widest leading-none">Security Heartbeat</div>
            <div class="text-[11px] font-black text-secondary uppercase mt-1">NOMINAL - 100% SECURE</div>
        </div>
        <div class="w-2 h-2 rounded-full bg-secondary animate-pulse shadow-[0_0_8px_#4edea3]"></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Live Alert Command Column -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Alerts Pulse Summary -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @php
                $alertKpis = [
                    ['label' => 'CRITICAL', 'val' => '02', 'col' => 'error', 'icon' => 'dangerous'],
                    ['label' => 'HIGH RISK', 'val' => '14', 'col' => 'warning', 'icon' => 'warning'],
                    ['label' => 'WARNINGS', 'val' => '42', 'col' => 'primary', 'icon' => 'info'],
                    ['label' => 'INFO', 'val' => '284', 'col' => 'secondary', 'icon' => 'chat_bubble'],
                ];
            @endphp
            @foreach($alertKpis as $k)
            <div class="bg-surface-container-low border border-{{ $k['col'] }}/10 p-6 rounded-[32px] group hover:border-{{ $k['col'] }}/40 transition-all">
                <div class="flex justify-between items-start mb-4">
                     <span class="material-symbols-outlined text-{{ $k['col'] }} text-xl">{{ $k['icon'] }}</span>
                     <span class="text-[10px] font-black text-{{ $k['col'] }} uppercase tracking-widest font-data-tabular">Live</span>
                </div>
                <div class="text-3xl font-black text-on-background tracking-tighter font-data-tabular mb-1">{{ $k['val'] }}</div>
                <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest opacity-60">{{ $k['label'] }}</div>
            </div>
            @endforeach
        </div>

        <!-- Live Intelligence Stream -->
        <div class="card-premium p-8 rounded-[40px] relative overflow-hidden group/stream h-[600px] flex flex-col">
            <div class="flex justify-between items-center mb-8 shrink-0">
                <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase flex items-center gap-4">
                    <span class="w-1.5 h-8 bg-error rounded-full"></span>
                    Alert Interaction Stream
                </h2>
                <div class="flex gap-4">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">filter_alt</span>
                        <input type="text" placeholder="Filter by Module / Severity..." class="bg-surface-container-highest border border-outline-variant rounded-full pl-12 pr-6 py-2 text-[11px] font-bold text-on-surface w-64 focus:border-error outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                @php
                    $alerts = [
                        ['id' => 'AL-9201', 'type' => 'CRITICAL', 'module' => 'SYSTEM', 'msg' => 'Unauthorized Access Attempt from IP: 192.168.1.18', 'time' => '12s ago', 'icon' => 'gpp_maybe'],
                        ['id' => 'AL-9202', 'type' => 'HIGH RISK', 'module' => 'TRADE', 'msg' => 'Suspicious Mineral Price Deviation [Gold B-42] flagged.', 'time' => '4m ago', 'icon' => 'currency_exchange'],
                        ['id' => 'AL-9203', 'type' => 'WARNING', 'module' => 'LAB', 'msg' => 'Laboratory Batch B-77402 overdue for scientific review.', 'time' => '18m ago', 'icon' => 'science'],
                        ['id' => 'AL-9204', 'type' => 'INFO', 'module' => 'COMPLIANCE', 'msg' => 'AngloGold T. Ltd updated their license documentation.', 'time' => '42m ago', 'icon' => 'gavel'],
                        ['id' => 'AL-9205', 'type' => 'HIGH RISK', 'module' => 'USER', 'msg' => 'Operator Dr. Menard J. initiated Sovereign Level-5 sync.', 'time' => '1h ago', 'icon' => 'fingerprint'],
                    ];
                @endphp
                @foreach($alerts as $a)
                <div class="p-6 bg-surface-container-low border border-outline-variant/30 hover:border-error/30 rounded-3xl transition-all group/item flex flex-col md:flex-row justify-between gap-6 relative overflow-hidden">
                    <div class="absolute inset-y-0 left-0 w-1 bg-{{ $a['type'] == 'CRITICAL' ? 'error' : ($a['type'] == 'HIGH RISK' ? 'warning' : 'outline-variant') }}"></div>
                    <div class="flex gap-5">
                        <div class="w-12 h-12 bg-surface-container-highest border border-outline-variant rounded-2xl flex items-center justify-center text-on-surface-variant group-hover/item:text-error transition-all">
                            <span class="material-symbols-outlined text-2xl">{{ $a['icon'] }}</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-[9px] font-black {{ $a['type'] == 'CRITICAL' ? 'text-error' : ($a['type'] == 'HIGH RISK' ? 'text-warning' : 'text-on-surface-variant') }} uppercase tracking-widest font-data-tabular">{{ $a['type'] }}</span>
                                <span class="w-1 h-1 bg-outline rounded-full"></span>
                                <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest opacity-40">{{ $a['id'] }} / {{ $a['module'] }}</span>
                            </div>
                            <div class="text-[14px] font-black text-on-background uppercase tracking-tight mb-1">{{ $a['msg'] }}</div>
                             <div class="text-[9px] font-bold text-on-surface-variant flex items-center gap-2 uppercase opacity-60">
                                <span class="material-symbols-outlined text-[14px]">schedule</span> INTERCEPTED: {{ $a['time'] }}
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3 h-fit mt-auto md:mt-0">
                         <button class="bg-surface-container-highest text-on-surface px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest border border-outline-variant hover:border-error transition-all">Acknowledge</button>
                         <button class="bg-error text-on-error-container px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all">Investigate</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right Alert Intelligence Column -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Detailed Alert Intelligence Panel -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] relative overflow-hidden">
             <div class="absolute top-0 right-0 p-8 opacity-10">
                <span class="material-symbols-outlined text-6xl">analytics</span>
             </div>
             <h3 class="text-label-caps font-black text-on-surface-variant mb-8 tracking-[0.3em] uppercase opacity-60">Alert Analytics Radar</h3>
             
             <div class="space-y-10">
                <div class="space-y-2">
                    <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                        <span class="text-on-surface-variant">Fraud Detection Rate</span>
                        <span class="text-secondary font-data-tabular">99.8%</span>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-secondary" style="width: 99.8%"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-surface-container-high border border-outline-variant rounded-2xl text-center">
                        <div class="text-2xl font-black text-on-background font-data-tabular">1.2<span class="text-xs font-bold ml-1 opacity-40">MIN</span></div>
                        <div class="text-[8px] font-black text-on-surface-variant uppercase mt-1">Avg Response</div>
                    </div>
                    <div class="p-4 bg-surface-container-high border border-outline-variant rounded-2xl text-center">
                        <div class="text-2xl font-black text-error font-data-tabular">0.02<span class="text-xs font-bold ml-1 opacity-40">%</span></div>
                        <div class="text-[8px] font-black text-on-surface-variant uppercase mt-1">False Positives</div>
                    </div>
                </div>

                <div class="p-6 bg-error/5 border border-error/20 rounded-3xl">
                     <h4 class="text-[10px] font-black text-error uppercase tracking-widest mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">radar</span> Anomaly Cluster Flag
                     </h4>
                     <p class="text-[11px] font-bold text-on-surface leading-relaxed uppercase tracking-tight">Geographic concentration of high-risk IP attempts detected in North Node. 12 interceptions in 1h.</p>
                </div>
             </div>
        </div>

        <!-- Sovereign Escalation Hierarchy -->
        <div class="card-premium p-8 rounded-[40px] border border-primary/20">
             <h3 class="text-label-caps font-black text-primary mb-8 tracking-[0.2em] uppercase">Escalation Protocol</h3>
             <div class="space-y-4">
                @php
                    $hierarchy = [
                        ['role' => 'SYSTEM ADMINISTRATOR', 'action' => 'Automatic INTERCEPTION', 'active' => true],
                        ['role' => 'COMPLIANCE OFFICER', 'action' => 'EVIDENCE REVIEW', 'active' => true],
                        ['role' => 'SOVEREIGN DIRECTOR', 'action' => 'LEGAL SANCTION', 'active' => false],
                        ['role' => 'NATIONAL AUTHORITY', 'action' => 'FIELD INTERVENTION', 'active' => false],
                    ];
                @endphp
                @foreach($hierarchy as $h)
                <div class="flex items-center justify-between p-4 bg-surface-container-high border border-outline-variant rounded-2xl group">
                    <div>
                         <div class="text-[10px] font-black text-on-surface uppercase">{{ $h['role'] }}</div>
                         <div class="text-[8px] font-bold text-on-surface-variant uppercase tracking-widest opacity-40">{{ $h['action'] }}</div>
                    </div>
                    <div class="w-6 h-6 rounded-lg {{ $h['active'] ? 'bg-secondary/10 text-secondary border border-secondary/20' : 'bg-surface-container-highest text-on-surface-variant border border-outline-variant' }} flex items-center justify-center transition-all">
                        <span class="material-symbols-outlined text-[16px]">{{ $h['active'] ? 'notifications' : 'notifications_off' }}</span>
                    </div>
                </div>
                @endforeach
             </div>
        </div>

        <!-- Notification Delivery Status -->
        <div class="p-8 bg-surface-container-low border border-outline-variant rounded-[40px] space-y-6">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">Delivery Gateways</h3>
            <div class="flex justify-between items-center px-4">
                <div class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined text-2xl">mail</span>
                    </div>
                    <span class="text-[8px] font-black opacity-40 uppercase">Email</span>
                </div>
                <div class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined text-2xl">sms</span>
                    </div>
                    <span class="text-[8px] font-black opacity-40 uppercase">SMS</span>
                </div>
                <div class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-all">
                        <span class="material-symbols-outlined text-2xl">chat_bubble</span>
                    </div>
                    <span class="text-[8px] font-black opacity-40 uppercase">Push</span>
                </div>
            </div>
            <div class="p-4 bg-secondary/10 border border-secondary/20 rounded-2xl text-center">
                <div class="text-[10px] font-black text-secondary uppercase tracking-widest leading-none">Gateway Integrity</div>
                <div class="text-[9px] font-bold text-secondary uppercase mt-2">NOMINAL STATUS</div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #343537; border-radius: 4px; }
</style>
@endsection
