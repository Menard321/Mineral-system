@extends('layouts.executive')

@section('title', 'GMITE | Certificates & Lifecycle')

@section('content')
<style>
    .lifecycle-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .stage-done    { background: #4edea3; box-shadow: 0 0 8px rgba(78,222,163,0.6); }
    .stage-active  { background: #adc6ff; box-shadow: 0 0 10px rgba(173,198,255,0.7); animation: pulse 2s infinite; }
    .stage-pending { background: #424754; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.5} }
    .cert-glow { box-shadow: 0 0 40px rgba(78,222,163,0.06); }
    .track-card { background: linear-gradient(145deg,#1a1b1e,#111215); border:1px solid rgba(255,255,255,0.05); transition: all 0.3s ease; }
    .track-card:hover { border-color: rgba(173,198,255,0.3); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.5); }
    .status-badge { font-size:9px; font-weight:800; letter-spacing:.15em; text-transform:uppercase; border-radius:4px; padding: 2px 8px; }
    .progress-bar { height: 3px; border-radius:2px; background:#1e2028; overflow:hidden; }
    .progress-fill { height:100%; border-radius:2px; transition: width 1s ease; }
</style>

<!-- Page Header -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div>
        <div class="flex items-center gap-4 mb-2">
            <div class="w-12 h-12 rounded-2xl bg-secondary/10 border border-secondary/20 flex items-center justify-center">
                <span class="material-symbols-outlined text-secondary text-2xl">workspace_premium</span>
            </div>
            <div>
                <h1 class="text-2xl font-black text-on-background tracking-tighter">CERTIFICATES &amp; LIFECYCLE</h1>
                <p class="text-[10px] text-on-surface-variant uppercase tracking-[.3em] opacity-60">Real-Time Sample Tracking &amp; Certification Portal</p>
            </div>
        </div>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('user.samples.register') }}"
           class="px-6 py-3 bg-surface-container-low border border-outline-variant text-on-surface text-[10px] font-black uppercase tracking-widest rounded-xl hover:border-primary flex items-center gap-2 transition-all">
            <span class="material-symbols-outlined text-sm">add_circle</span> New Registration
        </a>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
    @php
    $cards = [
        ['label'=>'Total Submitted',  'val'=>$stats['total'],     'icon'=>'science',            'col'=>'primary',   'desc'=>'All Samples'],
        ['label'=>'Pending',          'val'=>$stats['pending'],   'icon'=>'pending',             'col'=>'primary',   'desc'=>'Layer 1'],
        ['label'=>'In Laboratory',    'val'=>$stats['in_lab'],    'icon'=>'biotech',             'col'=>'secondary', 'desc'=>'Layer 2-3'],
        ['label'=>'Under Review',     'val'=>$stats['approved'],  'icon'=>'gavel',               'col'=>'primary',   'desc'=>'Gov Review'],
        ['label'=>'Rejected',         'val'=>$stats['rejected'],  'icon'=>'cancel',              'col'=>'error',     'desc'=>'Did Not Pass'],
        ['label'=>'Certified',        'val'=>$stats['certified'], 'icon'=>'workspace_premium',   'col'=>'secondary', 'desc'=>'Cleared'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="bg-surface-container-low border border-outline-variant/30 p-5 rounded-2xl relative overflow-hidden group hover:border-{{ $card['col'] }}/40 transition-all cursor-default">
        <div class="flex justify-between items-start mb-3">
            <span class="material-symbols-outlined text-{{ $card['col'] }} text-xl">{{ $card['icon'] }}</span>
            <span class="text-[8px] text-{{ $card['col'] }}/50 uppercase font-black tracking-widest">{{ $card['desc'] }}</span>
        </div>
        <div class="text-3xl font-black text-on-background font-['JetBrains_Mono',monospace] mb-1">{{ $card['val'] }}</div>
        <div class="text-[9px] text-on-surface-variant uppercase tracking-widest opacity-60">{{ $card['label'] }}</div>
        <div class="absolute bottom-0 left-0 h-0.5 bg-{{ $card['col'] }} w-0 group-hover:w-full transition-all duration-700"></div>
    </div>
    @endforeach
</div>

<!-- Main Content: Sample Tracking List + Certificates -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Sample Tracking Cards (2/3 width) -->
    <div class="lg:col-span-2 space-y-4">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-[11px] font-black text-on-surface-variant uppercase tracking-[.3em]">
                <span class="text-primary">●</span> Active Sample Pipeline
            </h2>
            <span class="text-[9px] text-on-surface-variant/40 uppercase tracking-widest">{{ $samples->count() }} specimen(s)</span>
        </div>

        @forelse($samples as $sample)
        @php
            $statusColors = [
                'REGISTERED' => ['bg'=>'primary',   'label'=>'Registered',    'icon'=>'fingerprint'],
                'RECEIVED'   => ['bg'=>'blue',       'label'=>'Intake Done',   'icon'=>'inventory_2'],
                'TESTING'    => ['bg'=>'secondary',  'label'=>'In Testing',    'icon'=>'biotech'],
                'REVIEWED'   => ['bg'=>'orange',     'label'=>'Under Review',  'icon'=>'gavel'],
                'CERTIFIED'  => ['bg'=>'secondary',  'label'=>'Certified',     'icon'=>'workspace_premium'],
                'REJECTED'   => ['bg'=>'error',      'label'=>'Rejected',      'icon'=>'cancel'],
            ];
            $sc = $statusColors[$sample->status] ?? ['bg'=>'primary','label'=>$sample->status,'icon'=>'help'];
            $stages = ['REGISTERED','RECEIVED','TESTING','REVIEWED','CERTIFIED'];
            $activeIdx = max(0, array_search($sample->status, $stages));
        @endphp
        <a href="{{ route('user.certificates.show', $sample->id) }}" class="track-card block p-6 rounded-2xl group">
            <!-- Header Row -->
            <div class="flex justify-between items-start mb-5">
                <div>
                    <div class="font-black text-on-background tracking-tighter text-sm font-['JetBrains_Mono',monospace]">{{ $sample->sample_id }}</div>
                    <div class="text-[10px] text-on-surface-variant uppercase mt-1">
                        {{ $sample->mineral_type }} &bull; {{ $sample->mineral_category ?? 'Ore' }}
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-{{ $sc['bg'] === 'blue' ? 'primary' : $sc['bg'] }} text-sm">{{ $sc['icon'] }}</span>
                    <span class="status-badge bg-{{ $sc['bg'] === 'blue' ? 'primary' : $sc['bg'] }}/10 text-{{ $sc['bg'] === 'blue' ? 'primary' : $sc['bg'] }}">{{ $sc['label'] }}</span>
                </div>
            </div>

            <!-- Mini Stage Pipeline -->
            <div class="flex items-center gap-1 mb-4">
                @foreach($stages as $i => $stage)
                    @php
                        $done    = $i < $activeIdx || ($sample->status === 'CERTIFIED' && $stage === 'CERTIFIED');
                        $current = ($stages[$activeIdx] === $stage && $sample->status !== 'CERTIFIED') || ($stage === 'CERTIFIED' && $sample->status === 'CERTIFIED');
                        $cls = $done ? 'stage-done' : ($current ? 'stage-active' : 'stage-pending');
                    @endphp
                    <div class="lifecycle-dot {{ $cls }}"></div>
                    @if(!$loop->last)
                        <div class="flex-1 h-px {{ $done ? 'bg-secondary/40' : 'bg-white/5' }}"></div>
                    @endif
                @endforeach
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar mb-4">
                <div class="progress-fill {{ $sample->status === 'CERTIFIED' ? 'bg-secondary' : ($sample->status === 'REJECTED' ? 'bg-error' : 'bg-primary') }}"
                     style="width:{{ $sample->progress }}%"></div>
            </div>

            <!-- Footer Row -->
            <div class="flex justify-between items-center text-[10px] text-on-surface-variant/50">
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[12px]">scale</span> {{ $sample->estimated_weight ?? $sample->quantity_kg }} kg
                    </span>
                    <span class="hidden md:flex items-center gap-1">
                        <span class="material-symbols-outlined text-[12px]">location_on</span> {{ Str::limit($sample->collection_site, 20) }}
                    </span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="opacity-40">{{ $sample->created_at->format('d M Y') }}</span>
                    <span class="text-primary group-hover:translate-x-1 transition-transform material-symbols-outlined text-sm">arrow_forward</span>
                </div>
            </div>
        </a>
        @empty
        <div class="track-card p-16 rounded-2xl text-center">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant/20 mb-4 block">science_off</span>
            <p class="text-[11px] font-black text-on-surface-variant/30 uppercase tracking-[.3em]">No Samples Registered</p>
            <a href="{{ route('user.samples.register') }}" class="inline-block mt-6 px-6 py-3 bg-primary text-black text-[10px] font-black uppercase tracking-widest rounded-xl hover:brightness-110 transition-all">
                Register First Sample
            </a>
        </div>
        @endforelse
    </div>

    <!-- Issued Certificates Panel (1/3) -->
    <div class="space-y-4">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-[11px] font-black text-on-surface-variant uppercase tracking-[.3em]">
                <span class="text-secondary">●</span> Issued Certificates
            </h2>
        </div>

        @forelse($certificates as $cert)
        <div class="cert-glow bg-surface-container-low border border-secondary/20 p-5 rounded-2xl relative overflow-hidden group">
            <!-- Watermark -->
            <div class="absolute top-2 right-3 text-secondary/5 text-6xl font-black tracking-tighter select-none">CERT</div>

            <div class="mb-4">
                <div class="text-[8px] text-secondary/60 uppercase tracking-[.3em] mb-1">Official Certificate</div>
                <div class="font-black text-white tracking-tighter text-xs font-['JetBrains_Mono',monospace]">{{ $cert->cert_id }}</div>
            </div>

            <div class="grid grid-cols-2 gap-2 mb-4 text-[10px]">
                <div>
                    <div class="text-on-surface-variant/40 uppercase mb-0.5">Mineral</div>
                    <div class="font-bold text-white uppercase">{{ $cert->mineral_type }}</div>
                </div>
                <div>
                    <div class="text-on-surface-variant/40 uppercase mb-0.5">Grade</div>
                    <div class="font-bold text-secondary uppercase">{{ $cert->grade ?? 'Verified' }}</div>
                </div>
                <div>
                    <div class="text-on-surface-variant/40 uppercase mb-0.5">Qty (kg)</div>
                    <div class="font-bold text-white">{{ number_format($cert->quantity_kg, 2) }}</div>
                </div>
                <div>
                    <div class="text-on-surface-variant/40 uppercase mb-0.5">Status</div>
                    <div class="font-bold text-secondary uppercase">{{ $cert->status }}</div>
                </div>
            </div>

            <div class="flex items-center justify-between border-t border-white/5 pt-3">
                <div class="text-[9px] text-on-surface-variant/40 uppercase">
                    Issued: {{ $cert->created_at->format('d M Y') }}
                </div>
                <a href="{{ route('user.certificates.show', $cert->sample_id) }}"
                   class="flex items-center gap-1 text-[9px] text-secondary font-black uppercase tracking-widest hover:gap-2 transition-all">
                    View <span class="material-symbols-outlined text-xs">open_in_new</span>
                </a>
            </div>
        </div>
        @empty
        <div class="bg-surface-container-low border border-outline-variant/20 p-8 rounded-2xl text-center">
            <span class="material-symbols-outlined text-3xl text-on-surface-variant/20 mb-2 block">verified_off</span>
            <p class="text-[10px] text-on-surface-variant/30 uppercase tracking-widest">No Certificates Issued</p>
            <p class="text-[9px] text-on-surface-variant/20 mt-2 uppercase tracking-widest">Complete sample lifecycle to unlock</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
