@extends('layouts.admin')

@section('title', 'GMITE - Sovereign Laboratory Intelligence')

@section('content')
<!-- Laboratory Control Bar -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-6 bg-surface-container-low p-6 rounded-3xl border border-outline-variant/30 shadow-2xl">
    <div class="flex items-center gap-6">
        <div class="relative group">
            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-xl group-hover:bg-primary/40 transition-all duration-700"></div>
            <div class="relative w-16 h-16 bg-surface-container-highest border border-primary/30 rounded-2xl flex items-center justify-center shadow-inner overflow-hidden">
                 <span class="material-symbols-outlined text-primary text-4xl group-hover:scale-110 transition-transform duration-500">biotech</span>
                 <div class="absolute inset-0 bg-gradient-to-t from-primary/5 to-transparent"></div>
            </div>
        </div>
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase">Laboratary Systems</h1>
                <span class="bg-secondary/10 text-secondary text-[10px] font-black px-3 py-1 rounded-full border border-secondary/20 tracking-widest uppercase">Certified Hub v8.4</span>
            </div>
            <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.1em] uppercase mt-1 opacity-70">Sovereign Mineral Certification & Purity Analysis Ecosystem</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.laboratory.registration') }}" class="px-6 py-3 bg-primary text-on-primary-container rounded-xl font-black text-[11px] uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-3 shadow-lg shadow-primary/10">
            <span class="material-symbols-outlined text-lg">add_box</span>
            Register New Sample
        </a>
        <button onclick="triggerExecutiveAction('Certificate Verification')" class="px-6 py-3 bg-surface-container-highest text-on-surface rounded-xl font-black text-[11px] uppercase tracking-widest border border-outline-variant hover:border-primary transition-all flex items-center gap-3">
            <span class="material-symbols-outlined text-lg">verified</span>
            Validate Batch
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Active Intelligence Queue (Laboratory Core) -->
    <div class="lg:col-span-8 space-y-8">
        <div class="card-premium p-8 rounded-[40px] relative overflow-hidden group/queue">
            <div class="absolute top-0 right-0 p-8 opacity-5 group-hover/queue:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-9xl">microsave</span>
            </div>
            
            <div class="flex justify-between items-center mb-8 relative z-10">
                 <div class="flex items-center gap-4">
                    <div class="w-1.5 h-8 bg-primary rounded-full"></div>
                    <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase">Testing & Analysis Queue</h2>
                 </div>
                 <div class="flex items-center bg-surface-container-highest rounded-lg px-4 py-2 border border-outline-variant">
                     <span class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mr-4">Auto-Update:</span>
                     <span class="w-2 h-2 rounded-full bg-secondary animate-pulse mr-2 shadow-[0_0_8px_#4edea3]"></span>
                     <span class="text-[10px] font-bold text-secondary uppercase">LIVE ENABLED</span>
                 </div>
            </div>

            <div class="space-y-6">
                @php
                    $labTests = [
                        ['id' => 'B-77401', 'sample' => 'Lithium Carbonate (99.5%)', 'client' => 'North Star Mining Corp', 'priority' => 'CRITICAL', 'progress' => 85, 'status' => 'Atomic Absorption Spectroscpy', 'icon' => 'dynamic_formulas'],
                        ['id' => 'B-77402', 'sample' => 'Gold Dore Bar - 12kg', 'client' => 'Sovereign Royalties Ltd', 'priority' => 'EXECUTIVE', 'progress' => 42, 'status' => 'XRF Fluorescence Analysis', 'icon' => 'flare'],
                        ['id' => 'B-77403', 'sample' => 'Refined Copper Cathode', 'client' => 'Global Logistics Inc', 'priority' => 'STANDARD', 'progress' => 10, 'status' => 'Waiting in Reception', 'icon' => 'pending_actions'],
                    ];
                @endphp
                @foreach($labTests as $test)
                <div class="p-6 bg-surface-container-low border border-outline-variant/50 rounded-3xl hover:border-primary/40 transition-all group/item relative overflow-hidden">
                    <div class="absolute inset-y-0 left-0 w-1 bg-{{ $test['priority'] == 'CRITICAL' ? 'error' : ($test['priority'] == 'EXECUTIVE' ? 'primary' : 'outline-variant') }}"></div>
                    
                    <div class="flex flex-col md:flex-row justify-between gap-6 relative z-10">
                        <div class="flex items-start gap-5">
                            <div class="w-14 h-14 bg-surface-container-highest rounded-2xl flex items-center justify-center border border-outline-variant text-on-surface-variant group-hover/item:text-primary group-hover/item:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined text-3xl">{{ $test['icon'] }}</span>
                            </div>
                            <div>
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-[10px] font-black text-primary uppercase tracking-[0.2em] font-data-tabular">BATCH: {{ $test['id'] }}</span>
                                    <span class="w-1 h-1 bg-outline rounded-full"></span>
                                    <span class="text-[9px] font-bold {{ $test['priority'] == 'CRITICAL' ? 'text-error' : 'text-on-surface-variant' }} uppercase tracking-widest border border-{{ $test['priority'] == 'CRITICAL' ? 'error/30' : 'outline-variant' }} px-2 rounded">{{ $test['priority'] }}</span>
                                </div>
                                <div class="text-xl font-black text-on-background tracking-tighter uppercase mb-1">{{ $test['sample'] }}</div>
                                <div class="text-[11px] font-bold text-on-surface-variant flex items-center gap-2 opacity-60">
                                    <span class="material-symbols-outlined text-[14px]">account_balance</span> ORIGIN: {{ $test['client'] }}
                                </div>
                            </div>
                        </div>

                        <div class="md:w-64 space-y-3">
                            <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                                <span class="text-on-surface-variant">Process Integrity</span>
                                <span class="text-primary">{{ $test['progress'] }}%</span>
                            </div>
                            <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                                 <div class="h-full bg-primary transition-all duration-[2000ms] shadow-[0_0_10px_rgba(173,198,255,0.4)]" style="width: {{ $test['progress'] }}%"></div>
                            </div>
                            <div class="text-[10px] font-bold text-on-surface-variant/60 flex items-center gap-2 uppercase italic">
                                <span class="material-symbols-outlined text-[14px] animate-pulse">monitoring</span> {{ $test['status'] }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <button class="w-full mt-10 py-4 bg-surface-container-highest border border-outline-variant rounded-2xl text-[11px] font-black uppercase tracking-[0.3em] text-on-surface hover:text-primary transition-all">
                Expand Full Diagnostic Queue
            </button>
        </div>

        <!-- Chromatographic Mockup Visualizer -->
        <div class="card-premium p-8 rounded-[40px] border border-secondary/20 bg-secondary-[2%] relative overflow-hidden group/viz">
             <div class="absolute -top-12 -right-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover/viz:bg-secondary/10 transition-all duration-700"></div>
             
             <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-8 flex items-center gap-4">
                <span class="material-symbols-outlined text-secondary">analytics</span>
                Live Spectroscopy Feed [Sovereign-42]
             </h2>
             
             <div class="h-48 flex items-end justify-between px-2 gap-1 border-b border-outline-variant/30 pb-4 mb-4">
                @for($i=0; $i<40; $i++)
                    @php $h = rand(10, 95); @endphp
                    <div class="flex-1 bg-secondary/20 border-t border-secondary/40 transition-all duration-[3000ms] relative group/bar hover:bg-secondary/60" style="height: {{ $h }}%">
                         <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[8px] font-bold text-secondary opacity-0 group-hover/bar:opacity-100 transition-opacity">{{ $h }}.2</div>
                    </div>
                @endfor
             </div>
             <div class="flex justify-between text-[9px] font-bold text-on-surface-variant uppercase tracking-widest opacity-40">
                <span>200 nm</span>
                <span>400 nm</span>
                <span>600 nm</span>
                <span>800 nm</span>
                <span class="text-secondary opacity-100">Peak Identity: Lithium Carbonate</span>
             </div>
        </div>
    </div>

    <!-- Right Sidebar Module -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Lab Authority Identity Card -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] relative overflow-hidden">
             <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full border-b border-l border-outline-variant/30"></div>
             <h3 class="text-label-caps font-black text-on-surface-variant mb-6 tracking-widest uppercase opacity-60">Authority Profile</h3>
             <div class="flex items-center gap-5 mb-8">
                <div class="w-16 h-16 rounded-2xl bg-primary/10 border border-primary/30 flex items-center justify-center text-primary shadow-lg shadow-primary/5">
                    <span class="material-symbols-outlined text-3xl">person_check</span>
                </div>
                <div>
                    <div class="text-lg font-black text-on-background uppercase tracking-tighter">Dr. Menard J.</div>
                    <div class="text-[10px] font-bold text-secondary uppercase tracking-[0.2em] mt-0.5">CHIEF LABORATORY DIRECTOR</div>
                </div>
             </div>
             <div class="space-y-4">
                 <div class="flex justify-between items-center p-4 bg-surface-container-high rounded-2xl border border-outline-variant group cursor-pointer hover:border-primary/50 transition-all">
                    <div class="flex items-center gap-3">
                         <span class="material-symbols-outlined text-on-surface-variant text-xl group-hover:text-primary transition-colors">history</span>
                         <span class="text-[11px] font-black uppercase tracking-widest text-on-surface opacity-80">Action Logs</span>
                    </div>
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">east</span>
                 </div>
                 <div class="flex justify-between items-center p-4 bg-surface-container-high rounded-2xl border border-outline-variant group cursor-pointer hover:border-primary/50 transition-all">
                    <div class="flex items-center gap-3">
                         <span class="material-symbols-outlined text-on-surface-variant text-xl group-hover:text-primary transition-colors">description_save</span>
                         <span class="text-[11px] font-black uppercase tracking-widest text-on-surface opacity-80">Templates</span>
                    </div>
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">east</span>
                 </div>
             </div>
        </div>

        <!-- Global Performance Intelligence -->
        <div class="card-premium p-8 rounded-[40px] border border-primary/20 bg-primary-[2%]">
             <h3 class="text-label-caps font-black text-primary mb-8 tracking-[0.2em] uppercase">Laboratory Metrics</h3>
             <div class="space-y-10">
                <div class="space-y-3">
                    <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest">
                        <span class="text-on-surface-variant">Throughput Efficacy</span>
                        <span class="text-primary">+12.4%</span>
                    </div>
                    <div class="h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary" style="width: 84%"></div>
                    </div>
                    <p class="text-[9px] text-on-surface-variant italic opacity-60">Calculated over 2,482 monthly samples verified.</p>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="p-4 bg-surface-container-high border border-outline-variant rounded-2xl">
                        <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-1">Avg Lead Time</div>
                        <div class="text-2xl font-black text-on-background font-data-tabular">2.4<span class="text-sm font-bold ml-1 opacity-40">HRS</span></div>
                    </div>
                    <div class="p-4 bg-surface-container-high border border-outline-variant rounded-2xl">
                        <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-1">Accuracy Ref</div>
                        <div class="text-2xl font-black text-secondary font-data-tabular">99.9<span class="text-sm font-bold ml-1 opacity-40">%</span></div>
                    </div>
                </div>

                <div class="p-6 bg-surface-container-low border border-outline-variant rounded-3xl group cursor-pointer hover:bg-primary hover:text-on-primary-container transition-all">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-[10px] font-black uppercase tracking-widest mb-1">System Integrity</div>
                            <div class="text-sm font-bold">OPERATIONAL - NODE 01</div>
                        </div>
                        <span class="material-symbols-outlined text-3xl opacity-20 group-hover:opacity-100 transition-opacity">verified_user</span>
                    </div>
                </div>
             </div>
        </div>

        <!-- Legal/Regulatory Disclosures -->
        <div class="px-6 space-y-4">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-error text-lg mt-0.5">gavel</span>
                <p class="text-[9px] font-bold text-on-surface-variant leading-relaxed opacity-60 uppercase tracking-wider">
                    All mineral purity certifications are governed by the Trans-Global Mining Authority (TGMA) Regulatory Act of 2026. Fraudulent reporting triggers immediate session lock.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Laboratory Visualization Auto-Pulse
    setInterval(() => {
        const bars = document.querySelectorAll('.group\/viz div[style*="height"]');
        bars.forEach(bar => {
            const currentH = parseInt(bar.style.height);
            const delta = (Math.random() - 0.5) * 5;
            const newH = Math.max(10, Math.min(95, currentH + delta));
            bar.style.height = newH + '%';
        });
    }, 100);
</script>
@endsection

