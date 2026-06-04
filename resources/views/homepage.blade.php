@extends('layouts.executive')

@section('title', 'GMITE Executive - Intelligence Portal')

@section('content')
<!-- Executive Top Header (Control Bar) -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4 bg-surface-container-low p-4 rounded-2xl border border-outline-variant shadow-lg shadow-black/20">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center border border-primary/20">
            <span class="material-symbols-outlined text-primary text-3xl animate-pulse">terminal</span>
        </div>
        <div>
            <h1 class="text-headline-md font-bold tracking-tighter text-on-background">EXECUTIVE TERMINAL <span class="text-primary italic">v4.0</span></h1>
            <div class="flex items-center gap-3 text-[10px] font-bold text-on-surface-variant uppercase tracking-[0.2em]">
                <span id="current-date">04 JUN 2026</span>
                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                <span id="current-time" class="text-secondary font-data-tabular">19:37:21 GMT+3</span>
                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                <span class="text-secondary flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_5px_#4edea3]"></span>
                    DATA SYNC: OPERATIONAL
                </span>
            </div>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 bg-surface-container-high rounded-lg border border-outline-variant text-[10px] font-bold hover:bg-surface-container-highest transition-all flex items-center gap-2 uppercase tracking-widest text-on-surface">
            <span class="material-symbols-outlined text-sm text-primary">picture_as_pdf</span> Generate Executive Report
        </button>
        <a href="/intelligence-map" class="px-4 py-2 bg-surface-container-high rounded-lg border border-outline-variant text-[10px] font-bold hover:bg-surface-container-highest transition-all flex items-center gap-2 uppercase tracking-widest text-on-surface">
            <span class="material-symbols-outlined text-sm text-primary">public</span> Open Global Map
        </a>
        <div class="flex items-center bg-surface-container-high rounded-lg border border-outline-variant px-2">
            <span class="material-symbols-outlined text-sm text-on-surface-variant px-2">schedule</span>
            <select class="bg-transparent border-none focus:ring-0 text-[10px] font-bold text-on-surface uppercase py-2 cursor-pointer outline-none">
                <option>Live</option>
                <option>1h</option>
                <option selected>24h</option>
                <option>7d</option>
                <option>30d</option>
            </select>
        </div>
        <div class="relative group/notif">
            <button class="w-10 h-10 bg-surface-container-high rounded-lg border border-outline-variant flex items-center justify-center relative hover:bg-surface-container-highest">
                <span class="material-symbols-outlined text-on-surface">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full animate-ping"></span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
            </button>
            <!-- Dropdown placeholder -->
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Main Dashboard Section -->
    <div class="lg:col-span-9 space-y-6">
        
        <!-- GLOBAL KPI DASHBOARD -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @php
                $kpis = [
                    ['label' => 'Total Minerals', 'val' => '12,842', 'change' => '+2.4%', 'color' => 'primary', 'icon' => 'diamond'],
                    ['label' => 'Trade Volume', 'val' => '$4.2B', 'change' => '+12.5%', 'color' => 'secondary', 'icon' => 'payments'],
                    ['label' => 'Compliance Rate', 'val' => '94.2%', 'change' => '-0.4%', 'color' => 'tertiary', 'icon' => 'fact_check'],
                    ['label' => 'Market Growth', 'val' => '+6.8%', 'change' => '+1.1%', 'color' => 'primary', 'icon' => 'trending_up'],
                ];
            @endphp
            @foreach($kpis as $kpi)
            <div class="bg-surface-container-high border border-outline-variant p-4 rounded-2xl relative overflow-hidden group hover:border-{{ $kpi['color'] }}/50 transition-all cursor-pointer">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest">{{ $kpi['label'] }}</span>
                    <span class="material-symbols-outlined text-{{ $kpi['color'] }} text-sm">{{ $kpi['icon'] }}</span>
                </div>
                <div class="text-2xl font-bold text-on-background font-data-tabular">{{ $kpi['val'] }}</div>
                <div class="text-[9px] font-bold {{ str_contains($kpi['change'], '+') ? 'text-secondary' : 'text-error' }} mt-1 flex items-center gap-1 uppercase">
                    {{ $kpi['change'] }} VS PREVIOUS PERIOD
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-{{ $kpi['color'] }} w-0 group-hover:w-full transition-all duration-500"></div>
            </div>
            @endforeach
        </div>

        <!-- REAL-TIME MARKET CHARTS -->
        <div class="card-premium p-6 rounded-3xl relative overflow-hidden min-h-[400px]">
             <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-headline-sm font-bold flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">query_stats</span>
                        Live Mineral Market Analytics
                    </h2>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">Real-time valuation across global corridors</p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1 bg-surface-container-highest rounded border border-outline-variant text-[10px] font-bold text-on-surface hover:text-primary transition-colors flex items-center gap-2 uppercase">
                        <span class="material-symbols-outlined text-xs">diamond</span> Select Mineral
                    </button>
                    <button class="px-3 py-1 bg-surface-container-highest rounded border border-outline-variant text-[10px] font-bold text-on-surface hover:text-primary transition-colors flex items-center gap-2 uppercase">
                        <span class="material-symbols-outlined text-xs">compare</span> Compare
                    </button>
                    <button class="px-3 py-1 bg-surface-container-highest rounded border border-outline-variant text-[10px] font-bold text-on-surface hover:text-primary transition-colors flex items-center gap-2 uppercase">
                        <span class="material-symbols-outlined text-xs">download</span> Export
                    </button>
                    <button id="refresh-data" class="w-8 h-8 bg-surface-container-highest rounded border border-outline-variant flex items-center justify-center text-on-surface hover:text-secondary transition-all active:rotate-180">
                         <span class="material-symbols-outlined text-sm">refresh</span>
                    </button>
                </div>
             </div>

             <!-- Chart Canvas Visual -->
             <div class="h-64 w-full relative">
                <div class="absolute inset-0 flex items-end justify-between px-2">
                    @php $points = [62, 58, 65, 72, 68, 75, 82, 90, 88, 95, 102, 110, 105, 115, 120, 118, 125, 130, 127, 135]; @endphp
                    @foreach($points as $idx => $p)
                        <div class="flex-1 flex flex-col items-center justify-end h-full group/col">
                             <div class="w-full max-w-[20px] bg-primary/10 border-t border-primary/30 rounded-t-sm transition-all duration-1000 relative {{ $idx == count($points)-1 ? 'bg-primary/40 border-primary' : '' }}" style="height: {{ $p }}px">
                                 @if($idx == count($points)-1)
                                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 flex flex-col items-center">
                                         <div class="bg-primary text-on-primary-container text-[8px] font-bold px-2 py-0.5 rounded-full whitespace-nowrap mb-1">NOW</div>
                                         <div class="w-px h-10 bg-primary animate-pulse"></div>
                                    </div>
                                 @endif
                                 <div class="absolute inset-0 opacity-0 group-hover/col:opacity-100 bg-primary/20 pointer-events-none transition-opacity"></div>
                             </div>
                        </div>
                    @endforeach
                </div>
                <!-- Grid Lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-10">
                     @for($i=0; $i<5; $i++) <div class="w-full h-px bg-on-surface"></div> @endfor
                </div>
             </div>

             <div class="flex justify-between mt-8 text-[10px] font-bold text-on-surface-variant/40 tracking-widest uppercase px-4 border-t border-outline-variant/30 pt-4">
                 <span>19:00</span>
                 <span>19:15</span>
                 <span>19:30</span>
                 <span class="text-primary">PRESENT (NOW)</span>
             </div>
        </div>

        <!-- MOVABLE MINERAL INTELLIGENCE MODULE -->
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-3xl relative min-h-[300px] overflow-hidden" id="intelligence-canvas">
             <div class="flex justify-between items-center mb-6 z-10 relative">
                <h2 class="text-headline-sm font-bold flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">drag_pan</span>
                    Mineral Intelligence Objects
                </h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-surface-container-high rounded border border-outline-variant text-[10px] font-bold text-on-surface hover:text-primary transition-colors flex items-center gap-2 uppercase">
                        <span class="material-symbols-outlined text-xs">add</span> Add Node
                    </button>
                    <button class="px-3 py-1 bg-surface-container-high rounded border border-outline-variant text-[10px] font-bold text-on-surface hover:text-tertiary transition-colors flex items-center gap-2 uppercase">
                        <span class="material-symbols-outlined text-xs">restart_alt</span> Reset Layout
                    </button>
                </div>
             </div>

             <!-- Draggable Mineral Nodes -->
             <div id="node-lithium" class="absolute top-20 left-20 w-48 glass p-4 rounded-2xl border border-primary/30 cursor-move z-20 hover:scale-105 transition-transform draggable-node">
                <div class="flex justify-between items-start mb-2">
                    <div class="text-[9px] font-bold text-primary uppercase">Active Node: LI</div>
                    <span class="material-symbols-outlined text-xs text-on-surface-variant cursor-pointer hover:text-error">push_pin</span>
                </div>
                <div class="text-lg font-bold text-on-background">Lithium Carbonate</div>
                <div class="flex justify-between mt-2 font-data-tabular">
                    <div class="text-[10px] text-on-surface-variant">Demand: <span class="text-secondary font-bold">HIGH</span></div>
                    <div class="text-[10px] text-on-surface-variant">Supply: <span class="text-error font-bold">LOW</span></div>
                </div>
                <div class="mt-2 text-xl font-bold text-primary">$14.2K <span class="text-[10px] text-secondary font-bold">↑ 2.1%</span></div>
             </div>

             <div id="node-copper" class="absolute top-40 right-20 w-48 glass p-4 rounded-2xl border border-secondary/30 cursor-move z-20 hover:scale-105 transition-transform draggable-node">
                <div class="flex justify-between items-start mb-2">
                    <div class="text-[9px] font-bold text-secondary uppercase">Active Node: CU</div>
                    <span class="material-symbols-outlined text-xs text-on-surface-variant cursor-pointer">push_pin</span>
                </div>
                <div class="text-lg font-bold text-on-background">Copper Refined</div>
                <div class="flex justify-between mt-2 font-data-tabular">
                    <div class="text-[10px] text-on-surface-variant">Demand: <span class="text-on-background font-bold">STEADY</span></div>
                    <div class="text-[10px] text-on-surface-variant">Supply: <span class="text-secondary font-bold">OPTIMAL</span></div>
                </div>
                <div class="mt-2 text-xl font-bold text-secondary">$8.9K <span class="text-[10px] text-on-surface-variant font-bold">~ 0.0%</span></div>
             </div>
             
             <!-- Decorative GIS-like background grid -->
             <div class="absolute inset-0 grid grid-cols-12 grid-rows-12 opacity-5 pointer-events-none">
                @for($i=0; $i<144; $i++) <div class="border border-on-surface"></div> @endfor
             </div>
        </div>
    </div>

    <!-- Right Sidebar Intelligence Layer -->
    <div class="lg:col-span-3 space-y-6">
        
        <!-- COMPLIANCE PANEL (MINI) -->
        <div class="card-premium p-5 rounded-2xl border-l-4 border-l-secondary">
             <div class="flex justify-between items-center mb-4">
                <h3 class="text-label-caps font-bold text-secondary uppercase tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">gavel</span>
                    Compliance Panel
                </h3>
             </div>
             <div class="space-y-3">
                 <div class="p-3 bg-surface-container-high rounded border border-outline-variant relative group">
                    <div class="text-[10px] font-bold text-primary mb-1 uppercase">New Application</div>
                    <div class="text-[11px] font-bold">Project: North lithium Expansion</div>
                    <div class="flex gap-2 mt-3">
                         <button class="flex-1 py-1 bg-secondary text-on-secondary text-[8px] font-bold rounded uppercase">Approve License</button>
                         <button class="flex-1 py-1 bg-error text-on-error text-[8px] font-bold rounded uppercase">Reject</button>
                    </div>
                 </div>
                 <button class="w-full py-1.5 bg-surface-container-lowest border border-outline-variant rounded text-[9px] font-bold uppercase tracking-widest hover:text-primary">View Full Audit Report</button>
             </div>
        </div>

        <!-- SECURITY & SYSTEM HEALTH -->
        <div class="card-premium p-5 rounded-2xl border border-error/20 bg-error/5">
             <div class="flex justify-between items-center mb-4">
                <h3 class="text-label-caps font-bold text-error uppercase tracking-widest flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">security</span>
                    Security Integrity
                </h3>
                <span class="w-2 h-2 rounded-full bg-error animate-pulse shadow-[0_0_8px_#ffb4ab]"></span>
             </div>
             <div class="space-y-3">
                <button class="w-full py-2 bg-error text-on-error rounded text-[10px] font-bold uppercase tracking-widest flex items-center justify-center gap-2 hover:opacity-90">
                    <span class="material-symbols-outlined text-xs">lock</span> Lock System
                </button>
                <div class="p-3 bg-error/10 border border-error/20 rounded-lg">
                    <div class="text-[11px] font-bold text-error uppercase">Anomaly Detected</div>
                    <p class="text-[9px] text-on-surface-variant mt-1 leading-tight">Unauthorized login attempt from restricted geographic block IP: 142.12.8.xx</p>
                    <button class="mt-2 text-[9px] font-bold text-error underline uppercase">Investigate Threat</button>
                </div>
             </div>
        </div>

        <!-- LIVE ACTIVITY FEED -->
        <div class="bg-surface-container-low border border-outline-variant p-5 rounded-3xl h-[400px] flex flex-col">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase tracking-[0.2em] flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">history</span>
                Live Activity Feed
            </h3>
            <div class="flex-1 overflow-y-auto space-y-4 custom-scrollbar pr-2">
                @php
                    $activities = [
                        ['type' => 'TRADE', 'msg' => 'Copper Shipment #4928 Verified in Port of Busan', 'time' => '1m ago', 'col' => 'primary'],
                        ['type' => 'AUTH', 'msg' => 'Level 05 Admin Login: Dr. Vance', 'time' => '4m ago', 'col' => 'secondary'],
                        ['type' => 'COMPLIANCE', 'msg' => 'Violation Issued: Amazon Sector G-4', 'time' => '12m ago', 'col' => 'error'],
                        ['type' => 'MARKET', 'msg' => 'Lithium Price Surge detected +4.2%', 'time' => '18m ago', 'col' => 'secondary'],
                        ['type' => 'SYSTEM', 'msg' => 'Global Database Sync successful', 'time' => '24m ago', 'col' => 'primary'],
                    ];
                @endphp
                @foreach($activities as $act)
                <div class="flex gap-4 group">
                    <div class="w-0.5 h-12 bg-{{ $act['col'] }}/30 group-hover:bg-{{ $act['col'] }} transition-all flex items-center justify-center">
                         <div class="w-2 h-2 rounded-full bg-{{ $act['col'] }} shadow-[0_0_5px_#{{ $act['col'] }}]"></div>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-on-background group-hover:text-{{ $act['col'] }} transition-colors">{{ $act['msg'] }}</div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[9px] font-bold text-on-surface-variant uppercase">{{ $act['type'] }}</span>
                            <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                            <span class="text-[9px] text-on-surface-variant italic">{{ $act['time'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pt-4 border-t border-outline-variant/30 mt-4 flex gap-2">
                <button class="flex-1 py-2 bg-surface-container-high rounded text-[9px] font-bold uppercase tracking-widest border border-outline-variant hover:text-primary">Search Logs</button>
                 <button class="flex-1 py-2 bg-surface-container-high rounded text-[9px] font-bold uppercase tracking-widest border border-outline-variant hover:text-primary">Export Logs</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Real-time time display
    function updateLiveTime() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('en-GB') + ' GMT+3';
        const dateStr = now.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }).toUpperCase();
        
        document.getElementById('current-time').textContent = timeStr;
        document.getElementById('current-date').textContent = dateStr;
    }
    setInterval(updateLiveTime, 1000);
    updateLiveTime();

    // Movable Nodes Logic (Simple Native implementation)
    document.querySelectorAll('.draggable-node').forEach(node => {
        let isDragging = false;
        let startX, startY, initialLeft, initialTop;

        node.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX;
            startY = e.clientY;
            initialLeft = node.offsetLeft;
            initialTop = node.offsetTop;
            node.style.zIndex = 1000;
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const dx = e.clientX - startX;
            const dy = e.clientY - startY;
            node.style.left = (initialLeft + dx) + 'px';
            node.style.top = (initialTop + dy) + 'px';
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            node.style.zIndex = 20;
        });
    });

    // Refresh Data simulation
    document.getElementById('refresh-data').addEventListener('click', function() {
        const bars = document.querySelectorAll('.group\/col div:first-child');
        bars.forEach(bar => {
            const h = Math.floor(Math.random() * 100) + 50;
            bar.style.height = h + 'px';
        });
        updateLiveTime();
    });
</script>

<style>
    .glass {
        background: rgba(18, 20, 23, 0.85);
        backdrop-filter: blur(12px);
    }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #343537; border-radius: 2px; }
    
    #intelligence-canvas {
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(77, 142, 255, 0.05) 0%, transparent 20%),
            radial-gradient(circle at 80% 90%, rgba(79, 222, 163, 0.05) 0%, transparent 20%);
    }
</style>
@endsection
