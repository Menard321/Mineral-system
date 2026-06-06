@extends('layouts.admin')

@section('title', 'GMITE - National Mineral Intelligence')

@section('content')
<!-- Analytics Executive Header -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative group">
            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-2xl group-hover/brief:bg-primary/40 transition-all duration-700"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-primary/40 rounded-[28px] flex items-center justify-center text-primary shadow-2xl">
                 <span class="material-symbols-outlined text-4xl animate-pulse">query_stats</span>
            </div>
        </div>
        <div>
             <div class="flex items-center gap-4">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Intelligence Analytics</h1>
                <span class="bg-primary/10 text-primary text-[10px] font-black px-3 py-1 rounded-full border border-primary/20 tracking-[0.2em] uppercase">AI-Ready v2.4</span>
             </div>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60 font-data-tabular">National Mineral Data Intelligence Centre [GMITE-INT]</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="triggerExecutiveAction('Generate National Report')" class="px-8 py-4 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 transition-all flex items-center gap-4 shadow-2xl shadow-primary/20">
            <span class="material-symbols-outlined text-xl">file_download</span>
            Export National Report
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Executive KPI Pulse -->
    <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $kpis = [
                ['label' => 'Samples Processed', 'val' => '142,801', 'delta' => '+12.4%', 'col' => 'primary', 'desc' => 'Total lifecycle units'],
                ['label' => 'Certified Mkt Value', 'val' => '$4.2B', 'delta' => '+8.1%', 'col' => 'secondary', 'desc' => 'Global valuation est.'],
                ['label' => 'Avg Turnaround', 'val' => '2.4 Hrs', 'delta' => '-14min', 'col' => 'primary', 'desc' => 'Lab efficiency index'],
                ['label' => 'Compliance Rate', 'val' => '99.98%', 'delta' => '+0.02%', 'col' => 'secondary', 'desc' => 'National legal score'],
            ];
        @endphp
        @foreach($kpis as $k)
        <div class="bg-surface-container-low border border-outline-variant/30 p-8 rounded-[40px] relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-{{ $k['col'] }}/5 rounded-full blur-3xl group-hover:bg-{{ $k['col'] }}/10 transition-all duration-700"></div>
            <div class="text-[10px] font-black text-{{ $k['col'] }} uppercase tracking-[0.2em] mb-4">{{ $k['label'] }}</div>
            <div class="text-4xl font-black text-on-background tracking-tighter font-data-tabular mb-1">{{ $k['val'] }}</div>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-black text-{{ $k['col'] }} uppercase tracking-widest font-data-tabular">{{ $k['delta'] }}</span>
                <span class="text-[9px] font-bold text-on-surface-variant uppercase opacity-40 italic">{{ $k['desc'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Science & Production Intelligence -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Mineral Production Trends (Chart Mockup) -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden group/chart">
            <div class="flex justify-between items-center mb-10">
                <div>
                     <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-2">Production Intelligence</h2>
                     <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60">National output trends by mineral classification</p>
                </div>
                <div class="flex gap-2">
                     @foreach(['WEEKLY', 'MONTHLY', 'ANNUAL'] as $t)
                     <button class="px-4 py-2 bg-surface-container-highest border border-outline-variant rounded-full text-[9px] font-black uppercase tracking-widest text-on-surface hover:text-primary transition-all">{{ $t }}</button>
                     @endforeach
                </div>
            </div>

            <!-- Chart Visualizer Simulation -->
            <div class="h-64 flex items-end justify-between px-4 pb-2 border-b border-outline-variant/30 relative">
                 @for($i=0; $i<30; $i++)
                    @php $h = rand(20, 95); @endphp
                    <div class="flex-1 max-w-[12px] bg-primary/20 border-t-2 border-primary/40 rounded-t-sm transition-all duration-[2000ms] relative group/bar hover:bg-primary/60" style="height: {{ $h }}%">
                         <div class="absolute -top-8 left-1/2 -translate-x-1/2 text-[8px] font-black text-primary opacity-0 group-hover/bar:opacity-100 transition-opacity">{{ $h }}k</div>
                    </div>
                 @endfor
                 <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-5 px-4 text-[8px] font-bold">
                     <span class="border-t border-white">100k UNITS</span>
                     <span class="border-t border-white">50k UNITS</span>
                     <span class="border-t border-white">0 UNITS</span>
                 </div>
            </div>
            <div class="flex justify-between text-[9px] font-bold text-on-surface-variant uppercase tracking-[0.3em] mt-6 opacity-40">
                <span>01 JAN</span>
                <span>15 JAN</span>
                <span>30 JAN</span>
            </div>
        </div>

        <!-- Laboratory Performance Intelligence -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div class="bg-surface-container-low border border-outline-variant/30 p-8 rounded-[40px] space-y-8">
                 <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.2em] uppercase opacity-60">Technician Efficacy</h3>
                 <div class="space-y-6">
                    @php
                        $techs = [
                            ['name' => 'DR. MENARD J.', 'rate' => '9.8s', 'col' => 'secondary'],
                            ['name' => 'ENG. VANCE K.', 'rate' => '12.4s', 'col' => 'primary'],
                            ['name' => 'SARAH L.', 'rate' => '14.1s', 'col' => 'primary'],
                        ];
                    @endphp
                    @foreach($techs as $t)
                    <div class="space-y-2">
                        <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                            <span class="text-on-surface">{{ $t['name'] }}</span>
                            <span class="text-{{ $t['col'] }} font-data-tabular">{{ $t['rate'] }}</span>
                        </div>
                        <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                             <div class="h-full bg-{{ $t['col'] }}" style="width: {{ 100 - (float)$t['rate'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                 </div>
             </div>
             <div class="bg-surface-container-low border border-outline-variant/30 p-8 rounded-[40px]">
                 <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.2em] uppercase opacity-60">Mineral Distribution</h3>
                 <div class="h-48 flex items-center justify-center relative">
                    <div class="w-32 h-32 rounded-full border-[16px] border-primary/20 border-t-primary border-r-secondary flex items-center justify-center rotate-45">
                        <div class="-rotate-45 text-center">
                            <div class="text-2xl font-black text-on-background">64<span class="text-sm opacity-40">%</span></div>
                            <div class="text-[8px] font-black text-primary uppercase">GOLD</div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 space-y-1">
                        <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-primary"></span><span class="text-[9px] font-bold text-on-surface-variant uppercase">Gold (64%)</span></div>
                        <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="text-[9px] font-bold text-on-surface-variant uppercase">Lithium (22%)</span></div>
                    </div>
                 </div>
             </div>
        </div>
    </div>

    <!-- Right Data Column -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Risk & Fraud Intelligence -->
        <div class="bg-error/5 border border-error/20 p-8 rounded-[48px] relative overflow-hidden">
             <div class="absolute top-0 right-0 p-8 opacity-10">
                <span class="material-symbols-outlined text-6xl">gavel</span>
             </div>
             <h3 class="text-label-caps font-black text-error mb-8 tracking-[0.3em] uppercase opacity-60">Sovereign Risk Discovery</h3>
             
             <div class="space-y-6">
                @php
                    $risks = [
                        ['type' => 'CLUSTER', 'msg' => 'High-Frequency Gold Trade Anomaly detected in Geita Hub.', 'id' => 'ANM-9201'],
                        ['type' => 'PATTERN', 'msg' => 'Repeated Certificate usage attempt for refined Lithium batch.', 'id' => 'SEC-4402'],
                    ];
                @endphp
                @foreach($risks as $r)
                <div class="flex gap-4 group">
                    <div class="w-1 h-12 bg-error/20 group-hover:bg-error transition-all rounded-full"></div>
                    <div>
                        <div class="text-[8px] font-black text-error uppercase tracking-widest mb-1">{{ $r['type'] }} THREAT — {{ $r['id'] }}</div>
                        <div class="text-[12px] font-black text-on-background uppercase tracking-tight leading-tight">{{ $r['msg'] }}</div>
                    </div>
                </div>
                @endforeach
             </div>
        </div>

        <!-- Predictive Intelligence & AI Forecast -->
        <div class="card-premium p-8 rounded-[40px] border border-secondary/20 bg-secondary-[2%] relative overflow-hidden group/ai">
             <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover/ai:bg-secondary/10 transition-all duration-700"></div>
             
             <h3 class="text-label-caps font-black text-secondary mb-10 tracking-[0.2em] uppercase flex items-center gap-3">
                 <span class="material-symbols-outlined text-xl">psychology</span>
                 AI Production Forecast
             </h3>
             <div class="space-y-8">
                 <div class="p-6 bg-surface-container-high rounded-[32px] border border-white/5 relative z-10">
                    <div class="text-[10px] font-black text-secondary uppercase tracking-widest mb-2">Projected Revenue [Q3 2026]</div>
                    <div class="text-3xl font-black text-on-background font-data-tabular">$1.84B <span class="text-sm font-bold text-secondary ml-2">+14%</span></div>
                    <p class="text-[9px] text-on-surface-variant font-bold uppercase tracking-wide mt-2 opacity-60 italic">Based on 284 active mining license expansions.</p>
                 </div>
                 
                 <div class="grid grid-cols-2 gap-4 relative z-10">
                    <div class="p-4 bg-surface-container-low border border-outline-variant rounded-2xl">
                        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest mb-1">Mkt Demand</div>
                        <div class="text-xl font-black text-on-background font-data-tabular">HIGH</div>
                    </div>
                    <div class="p-4 bg-surface-container-low border border-outline-variant rounded-2xl">
                        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest mb-1">Risk Volatility</div>
                        <div class="text-xl font-black text-on-background font-data-tabular text-secondary">LOW</div>
                    </div>
                 </div>
             </div>
        </div>

        <!-- Report Generation Suite -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] space-y-8">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.2em] uppercase opacity-60">Reporting Infrastructure</h3>
            <div class="space-y-4">
                <button onclick="triggerExecutiveAction('PDF National Statistic Digest')" class="w-full p-4 bg-surface-container-high border border-outline-variant rounded-2xl flex justify-between items-center group hover:border-primary transition-all">
                    <div class="flex items-center gap-4">
                         <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">picture_as_pdf</span>
                         <span class="text-[10px] font-black uppercase tracking-widest text-on-surface opacity-80 group-hover:opacity-100">National Stat Digest</span>
                    </div>
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">download</span>
                </button>
                <button onclick="triggerExecutiveAction('Excel Trade Velocity Export')" class="w-full p-4 bg-surface-container-high border border-outline-variant rounded-2xl flex justify-between items-center group hover:border-primary transition-all">
                    <div class="flex items-center gap-4">
                         <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">table_chart</span>
                         <span class="text-[10px] font-black uppercase tracking-widest text-on-surface opacity-80 group-hover:opacity-100">Trade Velocity Sheet</span>
                    </div>
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">download</span>
                </button>
            </div>
            <div class="p-4 bg-primary/10 border border-primary/20 rounded-2xl">
                 <div class="flex items-center gap-2 text-primary font-black uppercase tracking-widest text-[9px] mb-2">
                    <span class="material-symbols-outlined text-[14px]">verified</span>
                    Digital Signature Active
                 </div>
                 <p class="text-[8px] font-bold text-on-surface-variant italic leading-relaxed opacity-60">Every report is cryptographically signed by the Sovereign Intelligence Node (SID:{{ rand(1000, 9999) }}).</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Live Chart Simulation Heartbeat
    setInterval(() => {
        const bars = document.querySelectorAll('.group\/chart div[style*="height"]');
        bars.forEach(bar => {
            const currentH = parseInt(bar.style.height);
            const delta = (Math.random() - 0.5) * 8;
            const newH = Math.max(10, Math.min(95, currentH + delta));
            bar.style.height = newH + '%';
            
            const label = bar.querySelector('.group\/bar div');
            if(label) label.textContent = Math.round(newH) + 'k';
        });
    }, 1500);
</script>
@endsection