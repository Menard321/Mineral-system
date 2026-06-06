@extends('layouts.executive')

@section('title', 'GMITE - Global Mineral Operations Workspace')

@section('content')
<!-- Terminal Synchronization Header -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative">
             <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-3xl animate-pulse"></div>
             <div class="relative w-20 h-20 bg-surface-container-low border border-primary/40 rounded-[28px] flex items-center justify-center text-primary shadow-2xl">
                 <span class="material-symbols-outlined text-4xl animate-[spin_10s_linear_infinite]">terminal</span>
             </div>
        </div>
        <div>
             <div class="flex items-center gap-4">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Intelligence Terminal</h1>
                <span class="bg-secondary/10 text-secondary text-[10px] font-black px-3 py-1 rounded-full border border-secondary/20 tracking-[0.2em] uppercase">Sovereign Node 01</span>
             </div>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60 font-data-tabular">Session Operator: {{ Auth::user()->name ?? 'Executive' }} | Sync Level: 04</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="triggerExecutiveAction('Initialize Data Export')" class="px-8 py-4 bg-surface-container-low text-on-surface rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] border border-outline-variant hover:border-primary transition-all flex items-center gap-4 shadow-xl">
            <span class="material-symbols-outlined text-xl">database</span>
            Sync Ledger
        </button>
        <button onclick="triggerExecutiveAction('Activate High-Security Stream')" class="px-8 py-4 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all flex items-center gap-4 shadow-2xl shadow-primary/20">
            <span class="material-symbols-outlined text-xl">security</span>
            Secure Stream
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Main Command Layer -->
    <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-5 gap-6">
        @php
            $kpis = [
                ['label' => 'Active Samples', 'val' => $stats['samples'] ?? '0', 'sub' => 'SCIENTIFIC VALIDATION', 'col' => 'primary', 'icon' => 'science', 'link' => route('user.certificates')],
                ['label' => 'Pending Trades', 'val' => $stats['trades'] ?? '0', 'sub' => 'MARKET EXECUTION', 'col' => 'secondary', 'icon' => 'currency_exchange', 'link' => '#'],
                ['label' => 'Certs Issued', 'val' => $stats['certs'] ?? '0', 'sub' => 'SOVEREIGN TRUST', 'col' => 'primary', 'icon' => 'verified', 'link' => route('user.certificates')],
                ['label' => 'Compliance', 'val' => $stats['compliance'] ?? '0', 'sub' => 'REGULATORY SCORE', 'col' => 'secondary', 'icon' => 'gavel', 'link' => route('user.compliance')],
                ['label' => 'Active Alerts', 'val' => $stats['alerts'] ?? '0', 'sub' => 'RISK DETECTION', 'col' => 'error', 'icon' => 'notifications_active', 'link' => route('user.alerts')],
            ];
        @endphp
        @foreach($kpis as $k)
        <a href="{{ $k['link'] }}" class="bg-surface-container-low border border-outline-variant/30 p-8 rounded-[40px] relative overflow-hidden group hover:border-{{ $k['col'] }}/50 transition-all cursor-pointer block">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-{{ $k['col'] }}/5 rounded-full blur-3xl group-hover:bg-{{ $k['col'] }}/10 transition-all duration-700"></div>
            <div class="flex justify-between items-start mb-6">
                 <span class="material-symbols-outlined text-{{ $k['col'] }} text-2xl animate-pulse">{{ $k['icon'] }}</span>
                 <span class="text-[8px] font-black text-{{ $k['col'] }} uppercase tracking-widest font-data-tabular">LIVE_FEED</span>
            </div>
            <div class="text-4xl font-black text-on-background tracking-tighter font-data-tabular mb-1">{{ $k['val'] }}</div>
            <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest opacity-60">{{ $k['sub'] }}</div>
        </a>
        @endforeach
    </div>

    <!-- Center Intelligence Column -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Live Global Activity Stream (Ticker Style) -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden h-[450px] flex flex-col group">
            <div class="flex justify-between items-center mb-10 shrink-0">
                <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase flex items-center gap-4">
                    <span class="w-1.5 h-8 bg-primary rounded-full"></span>
                    Operational Activity Stream
                </h2>
                <div class="flex gap-4">
                     <div class="flex items-center gap-2 bg-surface-container-highest px-4 py-2 rounded-xl border border-outline-variant">
                         <span class="w-2 h-2 rounded-full bg-secondary animate-pulse shadow-[0_0_8px_#4edea3]"></span>
                         <span class="text-[9px] font-black text-on-surface uppercase tracking-widest">Real-time</span>
                     </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto space-y-4 pr-4 custom-scrollbar scroll-smooth" id="ticker-container">
                 @if(isset($activities) && count($activities) > 0)
                    @foreach($activities as $e)
                    <div class="flex items-start gap-6 p-6 bg-surface-container-low border border-outline-variant/20 rounded-3xl group/item hover:border-{{ $e['col'] ?? 'primary' }}/40 transition-all duration-500">
                        <div class="w-12 h-12 bg-surface-container-highest border border-outline-variant rounded-2xl flex items-center justify-center text-{{ $e['col'] ?? 'primary' }} shrink-0 group-hover/item:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-2xl">{{ $e['icon'] ?? 'notifications' }}</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-[9px] font-black text-{{ $e['col'] ?? 'primary' }} uppercase tracking-widest font-data-tabular">{{ $e['type'] }} Intelligence</span>
                                <span class="w-1 h-1 bg-outline-variant rounded-full"></span>
                                <span class="text-[9px] font-bold text-on-surface-variant italic opacity-40">{{ $e['time'] }}</span>
                            </div>
                            <div class="text-[14px] font-black text-on-background uppercase tracking-tight leading-none">{{ $act['msg'] ?? $e['msg'] }}</div>
                        </div>
                        <span class="material-symbols-outlined text-xl text-white/5 opacity-0 group-hover/item:opacity-100 transition-opacity">north_east</span>
                    </div>
                    @endforeach
                 @else
                    <div class="flex flex-col items-center justify-center h-full opacity-20 py-20">
                        <span class="material-symbols-outlined text-6xl mb-4">drafts</span>
                        <p class="text-[10px] font-black uppercase tracking-[0.3em]">No activity detected</p>
                    </div>
                 @endif
            </div>
        </div>

        <!-- GIS Activity Map Visualization -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden min-h-[400px]">
             <div class="flex justify-between items-start mb-10 relative z-10">
                <div>
                     <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-2">GIS Mineral Activity Map</h2>
                     <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60">Global mining sites and trade flow routes</p>
                </div>
                <button class="px-6 py-3 bg-surface-container-highest border border-outline-variant rounded-xl text-[9px] font-black uppercase tracking-widest text-on-surface hover:text-primary transition-all shadow-xl">Expand GIS Intelligence</button>
             </div>

             <!-- Mock Map Layer -->
             <div class="absolute inset-0 bg-[#08090a] opacity-40 rounded-[48px]"></div>
             <div class="relative h-[200px] w-full flex items-center justify-center">
                 <div class="w-3/4 h-3/4 border border-white/5 rounded-full flex items-center justify-center animate-[spin_20s_linear_infinite] opacity-5">
                    <div class="w-1/2 h-1/2 border border-primary/20 rounded-full"></div>
                 </div>
                 <!-- Map Markers -->
                 @foreach(['top-10 left-40', 'bottom-20 left-64', 'top-20 right-48', 'bottom-10 right-20'] as $pos)
                    <div class="absolute {{ $pos }} flex flex-col items-center gap-2 group/marker">
                         <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center border border-primary/40 group-hover/marker:scale-125 transition-all">
                             <div class="w-2 h-2 rounded-full bg-primary animate-ping"></div>
                         </div>
                    </div>
                 @endforeach
             </div>

             <div class="absolute bottom-10 left-10 right-10 flex justify-between items-center relative z-10 border-t border-white/5 pt-8">
                <div class="flex gap-12">
                     <div>
                        <div class="text-[8px] font-black text-white/30 uppercase tracking-widest mb-1">Peak Site</div>
                        <div class="text-xl font-black text-on-background uppercase">NORTH LAKE HUB</div>
                     </div>
                     <div>
                        <div class="text-[8px] font-black text-white/30 uppercase tracking-widest mb-1">Active Flow</div>
                        <div class="text-xl font-black text-secondary uppercase tracking-tighter">84.2/HR</div>
                     </div>
                </div>
                <div class="flex gap-2">
                     <span class="w-2 h-2 rounded-full bg-primary"></span>
                     <span class="w-2 h-2 rounded-full bg-secondary opacity-40"></span>
                     <span class="w-2 h-2 rounded-full bg-error opacity-40"></span>
                </div>
             </div>
        </div>

        <!-- Quick Sample Tracking (Transparency Layer) -->
        <div class="bg-surface-container-low border border-outline-variant p-10 rounded-[48px]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase flex items-center gap-4">
                    <span class="w-1.5 h-8 bg-secondary rounded-full"></span>
                    Recent Mineral Shipments
                </h2>
                <a href="{{ route('user.certificates') }}" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">View All Dossiers</a>
            </div>

            <div class="space-y-4">
                @php
                    $recent_samples = auth()->user()->mineralSamples()->latest()->take(3)->get();
                @endphp
                @forelse($recent_samples as $sample)
                <div class="p-6 bg-surface-container-high border border-outline-variant/30 rounded-[32px] flex flex-col md:flex-row justify-between items-center gap-6 group hover:border-primary/40 transition-all">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-xl font-bold">science</span>
                        </div>
                        <div>
                            <div class="text-[14px] font-black text-white uppercase tracking-tighter">{{ $sample->sample_id }}</div>
                            <div class="text-[9px] text-white/30 uppercase font-black tracking-[0.2em] mt-1">{{ $sample->mineral_type }} &bull; {{ $sample->mineral_category }}</div>
                        </div>
                    </div>

                    <div class="flex-1 max-w-xs w-full px-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Pipeline Status</span>
                            <span class="text-[9px] font-black text-{{ $sample->status_color }} uppercase tracking-widest">{{ $sample->status }}</span>
                        </div>
                        <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                            <div class="h-full bg-{{ $sample->status_color }} shadow-[0_0_10px_currentColor]" style="width: {{ $sample->progress }}%"></div>
                        </div>
                    </div>

                    <a href="{{ route('user.certificates.show', $sample->id) }}" class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white uppercase tracking-[0.2em] group-hover:bg-primary group-hover:text-black transition-all">
                        Track Dossier
                    </a>
                </div>
                @empty
                <div class="text-center py-10 opacity-20">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em]">No samples registered in system queue</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Sidebar Operational Metrics -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Performance Insights Panel -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[48px] relative overflow-hidden">
             <div class="absolute top-0 right-0 p-8 opacity-10">
                <span class="material-symbols-outlined text-6xl">insights</span>
             </div>
             <h3 class="text-label-caps font-black text-on-surface-variant mb-10 tracking-[0.3em] uppercase opacity-60">Success Intelligence</h3>
             
             <div class="space-y-10">
                 <div class="space-y-3">
                    <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                        <span class="text-on-surface-variant">Sample Success Rate</span>
                        <span class="text-primary font-data-tabular">98.4%</span>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-primary" style="width: 98.4%"></div>
                    </div>
                 </div>

                 <div class="space-y-3">
                    <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                        <span class="text-on-surface-variant">Trade Execution rate</span>
                        <span class="text-secondary font-data-tabular">82.1%</span>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-secondary" style="width: 82.1%"></div>
                    </div>
                 </div>

                 <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="p-6 bg-surface-container-high border border-outline-variant rounded-[32px] text-center group hover:border-primary transition-all cursor-pointer">
                        <div class="text-2xl font-black text-on-background font-data-tabular mb-1">04.2<span class="text-xs opacity-40 ml-1">H</span></div>
                        <div class="text-[8px] font-black text-on-surface-variant uppercase tracking-widest">Avg Lab Turnaround</div>
                    </div>
                    <div class="p-6 bg-surface-container-high border border-outline-variant rounded-[32px] text-center group hover:border-secondary transition-all cursor-pointer">
                        <div class="text-2xl font-black text-secondary font-data-tabular mb-1">88<span class="text-xs opacity-40 ml-1">/100</span></div>
                        <div class="text-[8px] font-black text-on-surface-variant uppercase tracking-widest">Operational Score</div>
                    </div>
                 </div>
             </div>
        </div>

        <!-- Intelligent Alerts & Notifications Hub -->
        <div class="card-premium p-8 rounded-[40px] border border-error/20 bg-error-[2%]">
             <div class="flex justify-between items-center mb-10">
                 <h3 class="text-label-caps font-black text-error tracking-[0.2em] uppercase flex items-center gap-3">
                     <span class="material-symbols-outlined text-xl">notifications_active</span>
                     Alert Intelligence
                 </h3>
                 <span class="w-10 h-10 bg-error/10 text-error rounded-xl flex items-center justify-center border border-error/20 animate-pulse">
                     <span class="material-symbols-outlined text-xl">radar</span>
                 </span>
             </div>
             
             <div class="space-y-4">
                 @if(isset($alerts) && count($alerts) > 0)
                     @foreach($alerts as $a)
                     <div class="p-6 bg-surface-container-low border border-{{ $a->type == 'CRITICAL' ? 'error' : ($a->type == 'WARNING' ? 'warning' : 'primary') }}/20 rounded-3xl group cursor-pointer hover:border-{{ $a->type == 'CRITICAL' ? 'error' : 'warning' }}/50 transition-all">
                        <div class="text-[8px] font-black text-{{ $a->type == 'CRITICAL' ? 'error' : 'warning' }} uppercase tracking-widest mb-1">{{ $a->type }} THREAT</div>
                        <p class="text-[11px] font-bold text-on-surface leading-tight uppercase tracking-tight">{{ $a->title }}: {{ $a->message }}</p>
                        <div class="mt-4 flex gap-4">
                            <button class="text-[9px] font-black text-{{ $a->type == 'CRITICAL' ? 'error' : 'warning' }} uppercase tracking-widest underline">Resolve Node</button>
                            <button class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest">Acknowledge</button>
                        </div>
                     </div>
                     @endforeach
                 @else
                    <div class="py-10 text-center opacity-20">
                        <span class="material-symbols-outlined text-4xl mb-2">shield_check</span>
                        <p class="text-[9px] font-black uppercase tracking-widest">No Alerts Detected</p>
                    </div>
                 @endif
             </div>
        </div>

        <!-- Sovereign Identity & Compliance Summary -->
        <div class="p-10 bg-surface-container-low border border-outline-variant rounded-[48px] space-y-8 h-fit">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">Identity Compliance Score</h3>
            <div class="text-center">
                 <div class="relative inline-flex items-center justify-center">
                    <svg class="w-24 h-24 transform -rotate-90">
                        <circle cx="48" cy="48" r="42" stroke="currentColor" stroke-width="8" fill="transparent" class="text-surface-container-highest" />
                        <circle cx="48" cy="48" r="42" stroke="currentColor" stroke-width="8" fill="transparent" stroke-dasharray="263.8" stroke-dashoffset="{{ 263.8 - (263.8 * ($stats['compliance'] ?? 0) / 100) }}" class="text-secondary" />
                    </svg>
                    <div class="absolute text-center">
                        <div class="text-2xl font-black text-on-background font-data-tabular">{{ round($stats['compliance'] ?? 0) }}</div>
                        <div class="text-[7px] font-black text-secondary tracking-widest uppercase">{{ ($stats['compliance'] ?? 0) > 90 ? 'OPTIMAL' : 'MONITORED' }}</div>
                    </div>
                 </div>
                 <div class="mt-8 text-[9px] font-black text-on-surface-variant uppercase tracking-widest opacity-60 leading-relaxed px-4">
                    Your institutional compliance rating is currently {{ $stats['compliance'] ?? '0' }}. Regulatory audits are synchronized across nodes.
                 </div>
            </div>
            <button class="w-full py-4 bg-surface-container-high border border-outline-variant rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] text-on-surface hover:text-secondary transition-all">
                Full Regulatory Brief
            </button>
        </div>
    </div>
</div>

<script>
    // Live Ticker Data Simulation Heartbeat
    setInterval(() => {
        const stream = document.getElementById('ticker-container');
        const firstItem = stream.children[0];
        const clone = firstItem.cloneNode(true);
        
        // Randomize the time for effect
        clone.querySelector('.italic').textContent = Math.floor(Math.random() * 60) + 's ago';
        
        stream.appendChild(clone);
        stream.removeChild(firstItem);
    }, 4000);

    // GIS Map Pulse
    setInterval(() => {
        const markers = document.querySelectorAll('.animate-ping');
        markers.forEach(m => {
            m.style.opacity = Math.random() > 0.5 ? '1' : '0.5';
        });
    }, 1000);
</script>
@endsection
