@extends('layouts.admin')

@section('title', 'GMITE - Sovereign Control Center')

@section('content')
<!-- Mission Control Branding -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative">
            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-2xl animate-pulse"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-primary/40 rounded-[28px] flex items-center justify-center text-primary shadow-2xl">
                 <span class="material-symbols-outlined text-4xl animate-[spin_10s_linear_infinite]">settings_input_composite</span>
            </div>
        </div>
        <div>
             <div class="flex items-center gap-4">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Operations Control</h1>
                <span class="bg-error/10 text-error text-[10px] font-black px-3 py-1 rounded-full border border-error/20 tracking-[0.2em] uppercase animate-pulse">Sovereign Direct</span>
             </div>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60 font-data-tabular">Mission Control Room — NODE 01 [DAR ES SALAAM]</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="triggerExecutiveAction('High Security Mode')" class="px-8 py-4 bg-error text-on-error-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all flex items-center gap-4 shadow-2xl shadow-error/20">
            <span class="material-symbols-outlined text-xl">security</span>
            Activate High Security
        </button>
        <button onclick="triggerExecutiveAction('System Sync')" class="px-8 py-4 bg-surface-container-low text-on-surface rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] border border-outline-variant hover:border-primary transition-all flex items-center gap-4">
            <span class="material-symbols-outlined text-xl">sync_alt</span>
            Local Sync
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Left Command Column -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Live Infrastructure Intelligence -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $metrics = [
                    ['icon' => 'dns', 'label' => 'Server Load', 'val' => '14.2%', 'status' => 'OPTIMAL', 'col' => 'secondary'],
                    ['icon' => 'database', 'label' => 'DB Health', 'val' => '99.99%', 'status' => 'SYNCHRONIZED', 'col' => 'secondary'],
                    ['icon' => 'network_check', 'label' => 'API Latency', 'val' => '42ms', 'status' => 'HIGH SPEED', 'col' => 'primary'],
                ];
            @endphp
            @foreach($metrics as $m)
            <div class="bg-surface-container-low border border-outline-variant/30 p-8 rounded-[40px] relative overflow-hidden group">
                <div class="absolute -top-6 -right-6 w-20 h-20 bg-{{ $m['col'] }}/5 rounded-full blur-2xl group-hover:bg-{{ $m['col'] }}/10 transition-all"></div>
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-surface-container-highest rounded-2xl flex items-center justify-center text-{{ $m['col'] }} border border-{{ $m['col'] }}/20">
                        <span class="material-symbols-outlined text-2xl">{{ $m['icon'] }}</span>
                    </div>
                    <div class="text-[8px] font-black text-{{ $m['col'] }} tracking-widest uppercase px-2 py-1 bg-{{ $m['col'] }}/5 rounded-full border border-{{ $m['col'] }}/10">
                        {{ $m['status'] }}
                    </div>
                </div>
                <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-1 opacity-50">{{ $m['label'] }}</div>
                <div class="text-3xl font-black text-on-background tracking-tighter font-data-tabular">{{ $m['val'] }}</div>
            </div>
            @endforeach
        </div>

        <!-- Geographic Activity Intelligence (Heatmap Mockup) -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden group/map min-h-[500px]">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
            
            <div class="relative z-10 flex justify-between items-start mb-10">
                <div>
                     <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-2">Live Activity Heatmap</h2>
                     <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60">Real-time geographic sample inflow distribution</p>
                </div>
                <div class="flex gap-4">
                     <div class="flex items-center gap-2 bg-surface-container-highest px-4 py-2 rounded-xl border border-outline-variant">
                         <span class="w-2 h-2 rounded-full bg-error animate-pulse shadow-[0_0_8px_#ff4d4d]"></span>
                         <span class="text-[9px] font-black text-on-surface uppercase tracking-widest">Live Flow</span>
                     </div>
                </div>
            </div>

            <!-- Vector Map Simulation -->
            <div class="relative h-[300px] flex items-center justify-center">
                 <div class="w-full h-full opacity-20 border border-white/5 rounded-[40px] flex items-center justify-center">
                    <span class="material-symbols-outlined text-9xl text-white opacity-10 shrink-0">map</span>
                 </div>
                 <!-- Animated Ripple Points -->
                 @foreach([['top: 20%; left: 30%'], ['top: 45%; left: 60%'], ['bottom: 10%; right: 20%']] as $p)
                 <div class="absolute w-20 h-20 rounded-full bg-primary/20 animate-ping" style="{{ $p[0] }}"></div>
                 <div class="absolute w-4 h-4 rounded-full bg-primary shadow-[0_0_15px_rgba(173,198,255,0.8)]" style="{{ $p[0] }}"></div>
                 @endforeach
            </div>

            <div class="absolute bottom-10 left-10 right-10 flex justify-between items-end relative z-10">
                 <div class="flex gap-10">
                     <div>
                        <div class="text-[9px] font-black text-white/30 uppercase tracking-widest mb-1">Peak Site</div>
                        <div class="text-xl font-black text-on-background uppercase tracking-tight">Geita Gold Hub</div>
                     </div>
                     <div>
                        <div class="text-[9px] font-black text-white/30 uppercase tracking-widest mb-1">Flow Rate</div>
                        <div class="text-xl font-black text-secondary uppercase tracking-tight">84.2/HR</div>
                     </div>
                 </div>
                 <button class="px-6 py-3 bg-surface-container-highest border border-outline-variant rounded-xl text-[10px] font-black uppercase tracking-widest text-on-surface hover:text-primary transition-all">
                    Expand GEO-INT
                 </button>
            </div>
        </div>

        <!-- Incident Control Matrix -->
        <div class="card-premium p-10 rounded-[48px] border border-error/20 bg-error-[2%]">
             <div class="flex justify-between items-center mb-10">
                <h2 class="text-headline-sm font-black tracking-tight text-error uppercase flex items-center gap-4">
                    <span class="material-symbols-outlined text-3xl">warning</span>
                    Sovereign Alert Stream
                </h2>
                <div class="flex gap-3">
                    <button class="w-10 h-10 bg-surface-container-highest rounded-xl flex items-center justify-center hover:bg-error/20 hover:text-error transition-all"><span class="material-symbols-outlined text-xl">filter_list</span></button>
                    <button class="w-10 h-10 bg-surface-container-highest rounded-xl flex items-center justify-center hover:bg-error/20 hover:text-error transition-all"><span class="material-symbols-outlined text-xl">close_fullscreen</span></button>
                </div>
             </div>

             <div class="space-y-6">
                 @if(isset($alerts) && count($alerts) > 0)
                    @foreach($alerts as $a)
                    <div class="p-6 bg-surface-container-low border border-error/10 hover:border-error/40 rounded-3xl transition-all group/alert flex justify-between items-center relative overflow-hidden">
                        <div class="flex items-start gap-6 relative z-10">
                            <div class="w-px h-10 bg-error/20 group-hover/alert:bg-error transition-all"></div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[9px] font-black text-error uppercase tracking-widest">{{ strtoupper($a->source_module) }} THREAT</span>
                                    <span class="text-[9px] font-bold text-white/30 uppercase tracking-widest font-data-tabular">{{ $a->alert_id }}</span>
                                </div>
                                <div class="text-[14px] font-black text-on-background uppercase tracking-tight leading-none mb-1">{{ $a->title }}</div>
                                <div class="text-[10px] text-on-surface-variant font-medium opacity-60 mb-2">{{ $a->message }}</div>
                                <div class="text-[9px] font-bold text-on-surface-variant flex items-center gap-2 uppercase opacity-60">
                                    <span class="material-symbols-outlined text-[14px]">schedule</span> INTERCEPTED: {{ $a->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 relative z-10">
                            <button class="bg-error text-on-error-container px-6 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:brightness-110">Suppress</button>
                            <button class="bg-surface-container-highest text-on-surface px-6 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:border-primary border border-outline-variant">Investigate</button>
                        </div>
                    </div>
                    @endforeach
                 @else
                    <div class="py-20 text-center border border-dashed border-outline-variant rounded-[40px] opacity-20">
                        <span class="material-symbols-outlined text-6xl mb-4">gpp_good</span>
                        <div class="text-[10px] font-black uppercase tracking-[0.3em]">No Threats Detected</div>
                    </div>
                 @endif
             </div>
        </div>
    </div>

    <!-- Right Command Column -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Emergency Controls Panel -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[48px] relative overflow-hidden">
             <div class="absolute top-0 right-0 p-8 opacity-10">
                <span class="material-symbols-outlined text-6xl">emergency</span>
             </div>
             <h3 class="text-label-caps font-black text-on-surface-variant mb-10 tracking-[0.3em] uppercase opacity-60">Global Emergency Controls</h3>
             <div class="space-y-4">
                 @php
                    $controls = [
                        ['icon' => 'science', 'label' => 'Pause Lab Ops', 'col' => 'error'],
                        ['icon' => 'lock', 'label' => 'Restrict Submissions', 'col' => 'primary'],
                        ['icon' => 'no_accounts', 'label' => 'Freeze Suspicious IDs', 'col' => 'warning'],
                        ['icon' => 'history_toggle_off', 'label' => 'Deactivate Certs', 'col' => 'error'],
                    ];
                 @endphp
                 @foreach($controls as $c)
                 <button onclick="triggerExecutiveAction('{{ $c['label'] }} Interface')" class="w-full flex items-center justify-between p-6 bg-surface-container-high border border-outline-variant/30 rounded-3xl group hover:border-{{ $c['col'] }} transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-{{ $c['col'] }}/10 text-{{ $c['col'] }} rounded-xl flex items-center justify-center border border-{{ $c['col'] }}/20 group-hover:scale-110 transition-transform">
                             <span class="material-symbols-outlined text-xl">{{ $c['icon'] }}</span>
                        </div>
                        <span class="text-[11px] font-black uppercase tracking-widest text-on-surface opacity-80 group-hover:opacity-100">{{ $c['label'] }}</span>
                    </div>
                    <span class="material-symbols-outlined text-lg text-on-surface-variant group-hover:text-{{ $c['col'] }} transition-colors">power_settings_new</span>
                 </button>
                 @endforeach
             </div>
        </div>

        <!-- User Surveillance Intelligence -->
        <div class="card-premium p-8 rounded-[40px] border border-primary/20">
             <h3 class="text-label-caps font-black text-primary mb-8 tracking-[0.2em] uppercase">User Activity Observation</h3>
             <div class="space-y-10">
                <div class="space-y-2">
                    <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                        <span class="text-on-surface-variant">Active Sessions</span>
                        <span class="text-primary font-data-tabular">2,142</span>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary" style="width: 78%"></div>
                    </div>
                </div>

                <div class="space-y-6">
                    @php
                        $actives = [
                            ['user' => 'Dr. Menard J.', 'loc' => 'Mission Control (HQ)', 'type' => 'ADMIN'],
                            ['user' => 'Eng. Vance K.', 'loc' => 'Lab Sub-Node (South)', 'type' => 'TECH'],
                            ['user' => 'Anonymous B.', 'loc' => 'Berlin, Germany', 'type' => 'UNKNOWN - FLAG'],
                        ];
                    @endphp
                    @foreach($actives as $a)
                    <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant/30 rounded-2xl group cursor-pointer hover:border-primary transition-all">
                        <div class="flex gap-4">
                            <div class="w-1 h-8 rounded-full {{ $a['type'] == 'UNKNOWN - FLAG' ? 'bg-error animate-pulse' : 'bg-secondary' }}"></div>
                            <div>
                                <div class="text-[11px] font-black text-on-surface uppercase">{{ $a['user'] }}</div>
                                <div class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60">{{ $a['loc'] }}</div>
                            </div>
                        </div>
                        <span class="text-[8px] font-black {{ $a['type'] == 'UNKNOWN - FLAG' ? 'text-error' : 'text-on-surface-variant' }} font-data-tabular">LIVE</span>
                    </div>
                    @endforeach
                </div>
                
                <button class="w-full py-4 bg-surface-container-highest border border-outline-variant rounded-2xl text-[9px] font-black uppercase tracking-[0.3em] text-on-surface hover:text-primary transition-all">
                    Open Surveillance Deck
                </button>
             </div>
        </div>

        <!-- System Governance Stats -->
        <div class="p-8 bg-surface-container-low border border-outline-variant rounded-[40px] space-y-6">
            <h3 class="text-label-caps font-black text-on-surface-variant mb-6 tracking-widest uppercase opacity-60">Governance Metrics</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-surface-container-high rounded-2xl border border-outline-variant text-center">
                    <div class="text-2xl font-black text-on-background font-data-tabular">2.4<span class="text-xs font-bold ml-1 opacity-40">M</span></div>
                    <div class="text-[8px] font-black text-on-surface-variant uppercase mt-1">Queries/HR</div>
                </div>
                <div class="p-4 bg-surface-container-high rounded-2xl border border-outline-variant text-center">
                    <div class="text-2xl font-black text-secondary font-data-tabular">100<span class="text-xs font-bold ml-1 opacity-40">%</span></div>
                    <div class="text-[8px] font-black text-on-surface-variant uppercase mt-1">Uptime</div>
                </div>
            </div>
            <div class="p-6 bg-surface-container-highest rounded-2xl border border-white/5 flex items-center justify-between">
                <div>
                    <div class="text-[10px] font-black text-on-surface uppercase">Backup Cycle</div>
                    <div class="text-[9px] font-bold text-secondary uppercase animate-pulse">Synchronized</div>
                </div>
                <span class="material-symbols-outlined text-secondary text-3xl">verified_user</span>
            </div>
        </div>
    </div>
</div>
@endsection
