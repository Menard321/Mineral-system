@extends('layouts.executive')

@section('title', 'GMITE | Export Intelligence Terminal')

@section('content')
<style>
    .trade-card { background: linear-gradient(145deg, rgba(26,27,30,0.4), rgba(17,18,21,0.6)); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.05); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .trade-card:hover { border-color: rgba(173,198,255,0.3); transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.6); }
    .status-badge { font-size: 9px; font-weight: 900; letter-spacing: 0.15em; text-transform: uppercase; border-radius: 6px; padding: 4px 12px; }
</style>

<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 gap-6">
    <div class="flex items-center gap-6">
        <div class="w-16 h-16 rounded-[28px] bg-primary/10 border border-primary/20 flex items-center justify-center shadow-lg shadow-primary/5">
            <span class="material-symbols-outlined text-primary text-4xl">ship</span>
        </div>
        <div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase leading-none mb-2">Export Intelligence</h1>
            <p class="text-[10px] text-on-surface-variant uppercase tracking-[.5em] font-bold opacity-50">Sovereign Mineral Trade Execution Hub</p>
        </div>
    </div>
    <a href="{{ route('user.trades.create') }}" class="px-8 py-4 bg-primary text-black text-[11px] font-black uppercase tracking-widest rounded-2xl hover:brightness-110 active:scale-95 transition-all flex items-center gap-4 shadow-2xl shadow-primary/20">
        <span class="material-symbols-outlined text-xl">add_box</span>
        Initiate Export Application
    </a>
</div>

<div class="grid grid-cols-1 gap-6">
    @forelse($trades as $trade)
    <div class="trade-card p-8 rounded-[40px] group">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-10">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center font-black text-primary font-mono text-xs">EXE</div>
                <div>
                    <div class="text-[16px] font-black text-white uppercase tracking-tighter leading-none mb-2">{{ $trade->trade_id }}</div>
                    <div class="flex items-center gap-3">
                        <span class="text-[10px] font-black text-primary uppercase">{{ $trade->mineral_type }}</span>
                        <span class="w-1 h-1 rounded-full bg-white/20"></span>
                        <span class="text-[10px] text-white/30 uppercase font-bold tracking-widest">{{ $trade->trade_type }} &bull; {{ $trade->quantity_kg }} KG</span>
                    </div>
                </div>
            </div>

            <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-12 border-x border-white/5 px-10">
                <div>
                    <div class="text-[9px] font-black text-white/20 uppercase tracking-widest mb-1">Market Value</div>
                    <div class="text-[14px] font-black text-white uppercase tabular-nums">${{ number_format($trade->value_usd, 2) }}</div>
                </div>
                <div>
                    <div class="text-[9px] font-black text-white/20 uppercase tracking-widest mb-1">Recipient</div>
                    <div class="text-[14px] font-black text-white uppercase tracking-tight">{{ Str::limit($trade->buyer_name, 12) }}</div>
                </div>
                <div>
                    <div class="text-[9px] font-black text-white/20 uppercase tracking-widest mb-1">Destination</div>
                    <div class="text-[14px] font-black text-white uppercase tracking-tight">{{ $trade->buyer_country }}</div>
                </div>
                <div>
                    <div class="text-[9px] font-black text-white/20 uppercase tracking-widest mb-1">Risk Assessment</div>
                    <div class="flex items-center gap-2">
                         <div class="w-2 h-2 rounded-full bg-{{ strtolower($trade->risk_level) }} shadow-[0_0_8px_currentColor]"></div>
                         <span class="text-[10px] font-black text-white uppercase tracking-widest">{{ $trade->risk_level }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-8">
                <div class="text-right">
                    <span class="status-badge bg-{{ $trade->status_color }} text-{{ $trade->status_color }} bg-opacity-10 border border-{{ $trade->status_color }} border-opacity-20">
                        {{ $trade->status_label }}
                    </span>
                    <div class="text-[9px] text-white/20 uppercase font-bold mt-2 tracking-widest">{{ $trade->created_at->format('d M Y') }}</div>
                </div>
                <button class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-primary hover:text-black transition-all">
                    <span class="material-symbols-outlined text-xl">arrow_forward</span>
                </button>
            </div>
        </div>
    </div>
    @empty
    <div class="trade-card p-24 rounded-[48px] text-center border-dashed border-white/10">
        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="material-symbols-outlined text-4xl text-white/10">radar</span>
        </div>
        <h3 class="text-lg font-black text-white/40 uppercase tracking-tighter">No Active Export Applications</h3>
        <p class="text-[10px] text-white/20 uppercase tracking-[0.2em] mt-2 mb-8">Ready to execute? Register a certified sample to begin the export process.</p>
        <a href="{{ route('user.trades.create') }}" class="px-8 py-3.5 bg-primary text-black text-[11px] font-black uppercase tracking-widest rounded-xl hover:brightness-110 transition-all font-bold">
            Initiate First Trade
        </a>
    </div>
    @endforelse
</div>
@endsection
