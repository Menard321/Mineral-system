@extends('layouts.executive')

@section('title', 'GMITE | Certificates & Lifecycle')

@section('content')
<style>
    .lifecycle-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .stage-done    { background: #4edea3; box-shadow: 0 0 12px rgba(78,222,163,0.4); }
    .stage-active  { background: #adc6ff; box-shadow: 0 0 15px rgba(173,198,255,0.6); animation: pulse 2s infinite; }
    .stage-pending { background: #424754; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.3} }
    .cert-glow { box-shadow: 0 0 40px rgba(173,198,255,0.03); }
    .track-card { 
        background: linear-gradient(145deg, rgba(26,27,30,0.4), rgba(17,18,21,0.6)); 
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.05); 
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
    }
    .track-card:hover { 
        border-color: rgba(173,198,255,0.3); 
        transform: translateY(-4px) scale(1.01); 
        box-shadow: 0 20px 40px rgba(0,0,0,0.6); 
    }
    .status-badge { font-size:9px; font-weight:900; letter-spacing:.15em; text-transform:uppercase; border-radius:6px; padding: 3px 10px; }
    .progress-bar { height: 4px; border-radius:4px; background: rgba(255,255,255,0.05); overflow:hidden; }
    .progress-fill { height:100%; border-radius:4px; transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1); }
</style>

<!-- Page Header -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 gap-6">
    <div>
        <div class="flex items-center gap-5 mb-3">
            <div class="w-14 h-14 rounded-[20px] bg-primary/10 border border-primary/20 flex items-center justify-center shadow-lg shadow-primary/5">
                <span class="material-symbols-outlined text-primary text-3xl">workspace_premium</span>
            </div>
            <div>
                <h1 class="text-3xl font-black text-white tracking-tighter uppercase">Certificates &amp; Tracking</h1>
                <p class="text-[10px] text-on-surface-variant uppercase tracking-[.4em] font-bold opacity-50">Sovereign Mineral Certification Terminal</p>
            </div>
        </div>
    </div>
    <div class="flex gap-4">
        <div class="px-5 py-3 bg-surface-container-low border border-outline-variant rounded-xl flex items-center gap-6">
             <div class="flex flex-col">
                <span class="text-[8px] text-white/30 uppercase font-bold tracking-widest leading-none mb-1">Node Status</span>
                <span class="text-[10px] text-secondary font-black uppercase flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_5px_#4edea3]"></span>
                    Encrypted
                </span>
             </div>
             <div class="w-px h-6 bg-white/5"></div>
             <a href="{{ route('user.samples.register') }}"
                class="px-6 py-2.5 bg-primary text-black text-[10px] font-black uppercase tracking-widest rounded-lg hover:brightness-110 active:scale-95 transition-all flex items-center gap-2">
                 <span class="material-symbols-outlined text-sm">add_box</span> New Submission
             </a>
        </div>
    </div>
</div>

<!-- Summary Global Intelligence -->
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5 mb-12">
    @php
    $cards = [
        ['label'=>'Total Filed',    'val'=>$stats['total'],     'icon'=>'inventory',           'col'=>'primary',   'desc'=>'SUBMITTED'],
        ['label'=>'Registered',     'val'=>$stats['pending'],   'icon'=>'fingerprint',         'col'=>'primary',   'desc'=>'LAYER 1'],
        ['label'=>'Laboratory',     'val'=>$stats['in_lab'],    'icon'=>'biotech',             'col'=>'secondary', 'desc'=>'LAYER 2-3'],
        ['label'=>'Gov Review',     'val'=>$stats['approved'],  'icon'=>'gavel',               'col'=>'primary',   'desc'=>'VAL-SYS'],
        ['label'=>'Rejected',       'val'=>$stats['rejected'],  'icon'=>'block',               'col'=>'error',     'desc'=>'FAILED'],
        ['label'=>'Certified',      'val'=>$stats['certified'], 'icon'=>'verified',            'col'=>'secondary', 'desc'=>'ISSUED'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="bg-surface-container-low border border-outline-variant/30 p-6 rounded-3xl relative overflow-hidden group hover:bg-surface-container-high transition-all">
        <div class="flex justify-between items-start mb-4">
            <div class="w-10 h-10 rounded-xl bg-{{ $card['col'] }}/5 flex items-center justify-center border border-{{ $card['col'] }}/10">
                <span class="material-symbols-outlined text-{{ $card['col'] }} text-xl">{{ $card['icon'] }}</span>
            </div>
            <span class="text-[8px] text-{{ $card['col'] }}/60 uppercase font-black tracking-widest">{{ $card['desc'] }}</span>
        </div>
        <div class="text-3xl font-black text-white font-mono mb-1">{{ str_pad($card['val'], 2, '0', STR_PAD_LEFT) }}</div>
        <div class="text-[9px] text-on-surface-variant uppercase tracking-widest font-bold opacity-40">{{ $card['label'] }}</div>
        <div class="absolute bottom-0 left-0 h-1 bg-{{ $card['col'] }} w-0 group-hover:w-full transition-all duration-700"></div>
    </div>
    @endforeach
</div>

<!-- Main Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- Active Pipeline -->
    <div class="lg:col-span-2 space-y-5">
        <div class="flex items-center justify-between mb-4 px-2">
            <h2 class="text-[11px] font-black text-on-surface-variant uppercase tracking-[.4em] flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-primary/20 flex items-center justify-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                </span>
                Active Sample Pipeline
            </h2>
            <div class="flex items-center gap-4 text-[9px] font-bold text-on-surface-variant/40 uppercase tracking-widest">
                <span>Real-Time Sync</span>
                <span class="material-symbols-outlined text-[14px] animate-spin">sync</span>
            </div>
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
        <a href="{{ route('user.certificates.show', $sample->id) }}" class="track-card block p-7 rounded-[32px] group">
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-start gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center group-hover:border-primary/40 transition-colors">
                         <span class="material-symbols-outlined text-primary/60 group-hover:text-primary transition-colors">{{ $sc['icon'] }}</span>
                    </div>
                    <div>
                        <div class="font-mono font-black text-white tracking-tighter text-base">{{ $sample->sample_id }}</div>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-[10px] font-black text-primary/80 uppercase">{{ $sample->mineral_type }}</span>
                            <span class="w-1 h-1 rounded-full bg-white/10"></span>
                            <span class="text-[10px] text-white/30 uppercase font-bold tracking-widest">{{ $sample->mineral_category ?? 'Raw Ore' }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <span class="status-badge bg-{{ $sc['bg'] === 'blue' ? 'primary' : $sc['bg'] }}/10 text-{{ $sc['bg'] === 'blue' ? 'primary' : $sc['bg'] }} border border-{{ $sc['bg'] === 'blue' ? 'primary' : $sc['bg'] }}/10">
                        {{ $sc['label'] }}
                    </span>
                    <div class="text-[9px] text-white/20 uppercase font-bold mt-2 tracking-widest">TS: {{ $sample->updated_at->format('H:i') }}</div>
                </div>
            </div>

            <!-- Enhanced Pipeline Stepper -->
            <div class="relative mb-6">
                <div class="flex justify-between items-center px-1">
                    @foreach($stages as $i => $stage)
                        @php
                            $done    = $i < $activeIdx || ($sample->status === 'CERTIFIED' && $stage === 'CERTIFIED');
                            $current = ($stages[$activeIdx] === $stage && $sample->status !== 'CERTIFIED') || ($stage === 'CERTIFIED' && $sample->status === 'CERTIFIED');
                            $cls = $done ? 'stage-done' : ($current ? 'stage-active' : 'stage-pending');
                        @endphp
                        <div class="lifecycle-dot {{ $cls }}"></div>
                        @if(!$loop->last)
                            <div class="flex-1 h-[1.5px] mx-2 {{ $done ? 'bg-secondary/40' : 'bg-white/5' }}"></div>
                        @endif
                    @endforeach
                </div>
                <!-- Labels -->
                <div class="flex justify-between mt-3 text-[7px] font-black text-white/20 uppercase tracking-[.2em] px-0.5">
                    <span>REG</span>
                    <span>INT</span>
                    <span>LAB</span>
                    <span>VAL</span>
                    <span>CRT</span>
                </div>
            </div>

            <!-- Progressive Engagement -->
            <div class="progress-bar mb-6">
                <div class="progress-fill {{ $sample->status === 'CERTIFIED' ? 'bg-secondary' : ($sample->status === 'REJECTED' ? 'bg-error' : 'bg-primary') }} shadow-[0_0_10px_currentColor]"
                     style="width:{{ $sample->progress }}%"></div>
            </div>

            <div class="flex justify-between items-center pt-2 border-t border-white/5">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-white/20">scale</span>
                        <span class="text-[10px] font-bold text-white/50">{{ number_format($sample->estimated_weight ?? $sample->quantity_kg, 2) }} KG</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-white/20">location_on</span>
                        <span class="text-[10px] font-bold text-white/50">{{ Str::limit($sample->collection_site, 24) }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                     <span class="text-[9px] font-bold text-white/20 uppercase tracking-widest">{{ $sample->created_at->format('d M Y') }}</span>
                     <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-primary transition-all">
                        <span class="material-symbols-outlined text-sm text-white/40 group-hover:text-black transition-colors">arrow_forward</span>
                     </span>
                </div>
            </div>
        </a>
        @empty
        <div class="track-card p-24 rounded-[40px] text-center border-dashed border-white/10 bg-transparent">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-4xl text-white/10">biotech</span>
            </div>
            <h3 class="text-lg font-black text-white/40 uppercase tracking-tighter">No Active Specimens Found</h3>
            <p class="text-[10px] text-white/20 uppercase tracking-[0.2em] mt-2 mb-8">Begin by registering your first mineral sample</p>
            <a href="{{ route('user.samples.register') }}" class="px-8 py-3.5 bg-primary text-black text-[11px] font-black uppercase tracking-widest rounded-xl hover:brightness-110 transition-all shadow-xl shadow-primary/10">
                Register Now
            </a>
        </div>
        @endforelse
    </div>

    <!-- Verified Certificates -->
    <div class="space-y-6">
        <div class="flex items-center justify-between mb-4 px-2">
            <h2 class="text-[11px] font-black text-on-surface-variant uppercase tracking-[.4em] flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-secondary/20 flex items-center justify-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                </span>
                Issued Certificates
            </h2>
        </div>

        @forelse($certificates as $cert)
        <div class="cert-glow bg-surface-container-high border border-secondary/20 p-6 rounded-[32px] relative overflow-hidden group hover:border-secondary transition-all">
            <!-- Institutional Background -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-full blur-[60px] group-hover:bg-secondary/10 transition-all duration-700"></div>
            
            <div class="flex justify-between items-start mb-6">
                <div>
                    <div class="text-[8px] text-secondary font-black uppercase tracking-[.4em] mb-2">OFFICIAL GMITE CERT</div>
                    <div class="font-mono font-black text-white text-base tracking-tighter">{{ $cert->cert_id }}</div>
                </div>
                <div class="w-10 h-10 bg-white rounded-lg p-0.5 flex items-center justify-center">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $cert->cert_id }}" alt="QR" class="w-full h-full opacity-90">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                    <div class="text-[8px] text-white/30 uppercase font-black mb-1">Mineral</div>
                    <div class="text-[11px] font-black text-white uppercase">{{ $cert->mineral_type }}</div>
                </div>
                <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                    <div class="text-[8px] text-white/30 uppercase font-black mb-1">Grade</div>
                    <div class="text-[11px] font-black text-secondary uppercase">{{ $cert->grade ?? 'A-GRADE' }}</div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-white/5">
                <div class="text-[9px] text-white/20 uppercase font-bold tracking-widest">
                    {{ $cert->created_at->format('d M Y') }}
                </div>
                <a href="{{ route('user.certificates.show', $cert->sample_id) }}"
                   class="px-5 py-2 bg-secondary/10 border border-secondary/20 text-secondary text-[9px] font-black uppercase tracking-widest rounded-lg hover:bg-secondary hover:text-black transition-all">
                    View Dossier
                </a>
            </div>
        </div>
        @empty
        <div class="p-12 rounded-[32px] bg-white/5 border border-white/5 text-center">
            <span class="material-symbols-outlined text-4xl text-white/10 mb-4">verified_user</span>
            <p class="text-[10px] text-white/20 uppercase font-bold tracking-widest leading-loose">No institutional certificates have been minted for your account yet.</p>
        </div>
        @endforelse
        
        <!-- Live Intelligence Badge -->
        <div class="p-6 bg-primary/5 border border-primary/10 rounded-[32px] relative overflow-hidden group">
            <div class="relative z-10">
                <h4 class="text-[10px] font-black text-primary uppercase tracking-widest mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">shield</span>
                    Security Protocol
                </h4>
                <p class="text-[10px] text-white/40 leading-relaxed font-bold">All certificates are cryptographically signed and stored on the GMITE sovereign ledger. Modification is strictly prohibited.</p>
            </div>
            <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-all duration-700"></div>
        </div>
    </div>
</div>
@endsection
