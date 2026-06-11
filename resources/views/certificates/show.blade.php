@extends('layouts.executive')

@section('title', 'Lifecycle Tracking | ' . $sample->sample_id)

@section('content')
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 24px;
    }
    .timeline-line {
        position: absolute;
        left: 20px;
        top: 40px;
        bottom: 0;
        width: 2px;
        background: rgba(255, 255, 255, 0.05);
    }
    .step-node {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 10;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .step-active {
        box-shadow: 0 0 20px rgba(173, 198, 255, 0.3);
        animation: pulse-border 2s infinite;
    }
    @keyframes pulse-border {
        0% { border-color: rgba(173, 198, 255, 0.2); }
        50% { border-color: rgba(173, 198, 255, 0.8); }
        100% { border-color: rgba(173, 198, 255, 0.2); }
    }
    .status-pill {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.1em;
        padding: 4px 12px;
        border-radius: 20px;
        text-transform: uppercase;
    }
</style>

<!-- Breadcrumbs & Header -->
<div class="mb-10">
    <div class="flex items-center gap-2 text-[10px] text-on-surface-variant uppercase tracking-widest mb-4">
        <a href="{{ route('user.certificates') }}" class="hover:text-primary transition-colors">Certificates</a>
        <span class="material-symbols-outlined text-[12px]">chevron_right</span>
        <span class="text-white">Sample Lifecycle</span>
    </div>
    
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 rounded-3xl bg-primary/10 border border-primary/20 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-3xl">analytics</span>
            </div>
            <div>
                <h1 class="text-3xl font-black text-white tracking-tighter">{{ $sample->sample_id }}</h1>
                <div class="flex items-center gap-3 mt-1">
                    <span class="status-pill bg-{{ $sample->status_color }}/10 text-{{ $sample->status_color }} border border-{{ $sample->status_color }}/20">
                        {{ $sample->status }}
                    </span>
                    <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">
                        Last Update: {{ $sample->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="flex gap-3">
            @if($sample->status === 'CERTIFIED' && $sample->certificate)
            <button class="px-6 py-3 bg-secondary text-black text-[10px] font-black uppercase tracking-widest rounded-xl hover:brightness-110 flex items-center gap-2 transition-all">
                <span class="material-symbols-outlined text-sm">download</span> Download Certificate
            </button>
            @endif
            <button class="px-6 py-3 bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-white/10 flex items-center gap-2 transition-all">
                <span class="material-symbols-outlined text-sm">print</span> Print QR Label
            </button>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- LEFT: Lifecycle Timeline -->
    <div class="lg:col-span-2">
        <div class="glass-card p-8">
            <h2 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-10 flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                Official Lifecycle Timeline
            </h2>
            
            <div class="relative space-y-12">
                @foreach($lifecycle as $index => $step)
                    @php
                        $isActive = ($sample->status === $step['key']) || 
                                    ($sample->status === 'REJECTED' && $step['key'] === 'CERTIFIED' && false); // Handle rejection specially
                        $isPast = $step['done'] && !$isActive;
                    @endphp
                    
                    <div class="relative flex gap-8">
                        @if(!$loop->last)
                            <div class="timeline-line {{ $isPast ? 'bg-secondary/40' : '' }}"></div>
                        @endif
                        
                        <div class="step-node border-2 {{ $isActive ? 'bg-primary/20 border-primary step-active' : ($isPast ? 'bg-secondary/20 border-secondary' : 'bg-surface-container-highest border-white/10') }}">
                            <span class="material-symbols-outlined {{ $isActive ? 'text-primary' : ($isPast ? 'text-secondary' : 'text-white/20') }} text-xl">
                                {{ $isPast ? 'check' : $step['icon'] }}
                            </span>
                        </div>
                        
                        <div class="flex-1 pb-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-sm font-black text-white uppercase tracking-tight">{{ $step['label'] }}</h3>
                                    <p class="text-[9px] text-{{ $step['color'] }} font-bold uppercase tracking-widest mt-0.5">{{ $step['authority'] }}</p>
                                </div>
                                @if($step['timestamp'])
                                <div class="text-[10px] font-mono text-white/30">{{ $step['timestamp']->format('d M Y • H:i') }}</div>
                                @endif
                            </div>
                            <p class="text-[11px] text-on-surface-variant leading-relaxed max-w-xl">
                                {{ $step['desc'] }}
                            </p>
                            
                            @if($step['key'] === 'TESTING' && $sample->status !== 'REGISTERED' && $sample->status !== 'RECEIVED')
                                <div class="mt-4 p-4 bg-white/5 rounded-xl border border-white/5 flex items-center justify-between group cursor-pointer hover:bg-white/10 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-purple-400 text-sm">biotech</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-white/60 uppercase tracking-widest">Laboratory Report Summary</span>
                                    </div>
                                    <span class="material-symbols-outlined text-white/20 group-hover:text-white transition-colors">chevron_right</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- RIGHT: Sample Info + Lab Results -->
    <div class="space-y-6">
        <!-- Sample Identity Card -->
        <div class="glass-card p-6 overflow-hidden relative">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
            
            <h3 class="text-[10px] font-black text-on-surface-variant uppercase tracking-[0.2em] mb-6">Specimen Details</h3>
            
            <div class="space-y-4 mb-8">
                <div class="flex justify-between items-center text-[11px] border-b border-white/5 pb-3">
                    <span class="text-white/40 uppercase tracking-widest font-black">Cert ID</span>
                    <span class="text-white font-mono font-bold">
                        {{ $sample->certificate?->cert_id ?? 'Certificate Not Generated' }}
                    </span>
                </div>
                <div class="flex justify-between items-center text-[11px] border-b border-white/5 pb-3">
                    <span class="text-white/40 uppercase tracking-widest font-black">Issued By</span>
                    <span class="text-white font-mono font-bold">
                        {{ $sample->certificate?->cert_id ?? 'Certificate Not Generated' }}
                    </span>
                </div>
                <div class="flex justify-between items-center text-[11px] border-b border-white/5 pb-3">
                    <span class="text-white/40 uppercase tracking-widest font-black">Signing Authority</span>
                    <span class="text-secondary font-bold">{{ $sample->certificate->signing_authority ?? 'Sovereign Digital Seal' }}</span>
                </div>
                <div class="mt-4 p-4 bg-black/40 border border-secondary/10 rounded-xl overflow-hidden group">
                    <div class="text-[8px] text-secondary font-black uppercase tracking-[.3em] mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[12px]">security</span>
                        Digital Signature Hash
                    </div>
                    <div class="text-[9px] font-mono text-white/50 break-all leading-tight group-hover:text-secondary transition-colors uppercase">
                        {{ $sample->certificate->digital_signature ?? 'IMMUTABLE_HASH_PENDING' }}
                    </div>
                </div>
                <div class="flex justify-between items-center text-[11px] pt-4">
                    <span class="text-white/40 uppercase tracking-widest font-black">Expiration</span>
                   <span class="text-error font-bold uppercase">
                        {{ $sample->certificate?->expires_at ? \Carbon\Carbon::parse($sample->certificate->expires_at)->format('d M Y') : 'N/A' }}
                    </span>
                </div>
            </div>
            
            <div class="flex justify-between items-center py-3 border-b border-white/5">
                <span class="text-[10px] text-white/40 uppercase font-bold">Purpose</span>
                <span class="text-[11px] font-black text-white uppercase">{{ $sample->sample_purpose ?? 'General Analysis' }}</span>
            </div>
            
            <div class="mt-8 flex items-center gap-4 p-4 bg-white/5 rounded-2xl border border-white/5">
                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-1">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $sample->sample_id }}" alt="QR" class="w-full h-full opacity-80">
                </div>
                <div>
                    <div class="text-[9px] font-black text-white uppercase tracking-widest">Digital ID Verified</div>
                    <div class="text-[8px] text-white/40 uppercase tracking-tighter mt-0.5">Scan for immutable chain-of-custody</div>
                </div>
            </div>
        </div>
        
        <!-- Lab Results Preview (Only visible after official validation) -->
        @if(in_array($sample->status, ['REVIEWED', 'CERTIFIED']))
        <div class="glass-card p-6 border-secondary/20 relative">
            <div class="absolute -top-12 -left-12 w-24 h-24 bg-secondary/5 rounded-full blur-2xl"></div>
            
            <h3 class="text-[10px] font-black text-secondary uppercase tracking-[0.2em] mb-6 flex items-center justify-between">
                Verified Lab Results
                <span class="material-symbols-outlined text-sm">verified</span>
            </h3>
            
            <div class="space-y-6">
                @forelse($sample->labTests as $test)
                    <div class="p-4 bg-white/5 rounded-xl border border-white/5">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-[10px] font-black text-white uppercase">{{ $test->test_type }} Analysis</span>
                            <span class="text-[9px] text-secondary font-bold uppercase">Validated</span>
                        </div>
                        
                        <div class="space-y-3">
                            @foreach($test->results as $res)
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-white/40 uppercase tracking-tighter">{{ $res->element_name }}</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-1 bg-white/5 rounded-full overflow-hidden">
                                        <div class="h-full bg-secondary" style="width: {{ $res->value }}%"></div>
                                    </div>
                                    <span class="text-[10px] font-mono font-bold text-white">{{ $res->value }}{{ $res->unit }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 opacity-30">
                        <span class="material-symbols-outlined text-4xl mb-2">pending_actions</span>
                        <p class="text-[9px] font-bold uppercase tracking-widest">Waiting for Official Release</p>
                    </div>
                @endforelse
                
                @if($sample->grade)
                <div class="p-5 bg-secondary/10 border border-secondary/20 rounded-2xl text-center">
                    <div class="text-[9px] text-secondary/60 uppercase font-black tracking-widest mb-1">Final Graded Quality</div>
                    <div class="text-3xl font-black text-secondary tracking-tighter uppercase">{{ $sample->grade }}</div>
                </div>
                @endif
            </div>
        </div>
        @elseif($sample->status === 'TESTING')
        <div class="glass-card p-8 border-primary/20 text-center">
            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                 <span class="material-symbols-outlined text-primary text-3xl animate-spin">refresh</span>
            </div>
            <h3 class="text-[10px] font-black text-primary uppercase tracking-[0.2em] mb-2">Analysis in Progress</h3>
            <p class="text-[9px] text-white/30 uppercase font-bold leading-relaxed">Laboratory is currently performing metallurgical analysis. Results will be visible after official government validation.</p>
        </div>
        @endif
        
        <!-- Document Access -->
        <div class="glass-card p-6">
            <h3 class="text-[10px] font-black text-white/40 uppercase tracking-[0.2em] mb-4">Secure Documents</h3>
            <div class="space-y-2">
                <button class="w-full p-4 bg-white/5 border border-white/5 rounded-xl flex items-center justify-between group hover:border-primary/40 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-white/30 group-hover:text-primary transition-colors">description</span>
                        <span class="text-[10px] font-bold text-white/60 uppercase tracking-widest">Chain of Custody PDF</span>
                    </div>
                    <span class="material-symbols-outlined text-xs text-white/20">download</span>
                </button>
                @if($sample->status === 'CERTIFIED')
                <button class="w-full p-4 bg-secondary/10 border border-secondary/20 rounded-xl flex items-center justify-between group hover:brightness-110 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">workspace_premium</span>
                        <span class="text-[10px] font-black text-secondary uppercase tracking-widest">Official Certificate</span>
                    </div>
                    <span class="material-symbols-outlined text-xs text-secondary">download</span>
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
