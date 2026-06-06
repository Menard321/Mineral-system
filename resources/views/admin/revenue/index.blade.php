@extends('layouts.executive')

@section('title', 'MOCC | Revenue Assurance Control Room')

@section('content')
<style>
    .revenue-card { background: linear-gradient(145deg, rgba(10, 11, 13, 0.9), rgba(20, 21, 25, 0.95)); border: 1px solid rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .revenue-card:hover { border-color: rgba(78, 222, 163, 0.2); transform: translateY(-4px) scale(1.01); box-shadow: 0 30px 60px rgba(0,0,0,0.8); }
    .risk-badge { font-size: 9px; font-weight: 900; letter-spacing: 0.15em; border-radius: 6px; padding: 4px 12px; text-transform: uppercase; }
    .bg-critical { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2); }
    .bg-high     { background: rgba(249, 115, 22, 0.1); color: #f97316; border: 1px solid rgba(249, 115, 22, 0.2); }
    .bg-medium   { background: rgba(234, 179, 8, 0.1); color: #eab308; border: 1px solid rgba(234, 179, 8, 0.2); }
    .bg-low      { background: rgba(78, 222, 163, 0.1); color: #4edea3; border: 1px solid rgba(78, 222, 163, 0.2); }
    .stat-glow   { text-shadow: 0 0 20px rgba(78, 222, 163, 0.3); }
    .leakage-glow { text-shadow: 0 0 20px rgba(239, 68, 68, 0.4); }
</style>

<!-- Header Intelligence -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 gap-6">
    <div class="flex items-center gap-6">
        <div class="w-16 h-16 rounded-[24px] bg-secondary/10 border border-secondary/30 flex items-center justify-center shadow-2xl shadow-secondary/5 rotate-3">
            <span class="material-symbols-outlined text-secondary text-4xl">payments</span>
        </div>
        <div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase leading-none mb-2">Revenue Assurance</h1>
            <p class="text-[10px] text-on-surface-variant uppercase tracking-[0.5em] font-bold opacity-50 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                MOCC National Economic Oversight Terminal
            </p>
        </div>
    </div>
    <div class="flex gap-4">
        <div class="px-6 py-3 bg-surface-container-low border border-outline-variant rounded-2xl flex items-center gap-8">
            <div class="flex flex-col">
                <span class="text-[8px] text-white/30 uppercase font-black tracking-widest leading-none mb-1 text-right">System Health</span>
                <span class="text-[10px] text-secondary font-black uppercase flex items-center gap-2">
                    Synced <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_8px_#4edea3]"></span>
                </span>
            </div>
            <div class="w-px h-8 bg-white/5"></div>
            <button class="px-6 py-2.5 bg-primary text-black text-[10px] font-black uppercase tracking-widest rounded-xl hover:brightness-110 active:scale-95 transition-all">
                Export Audit Report
            </button>
        </div>
    </div>
</div>

<!-- 💰 A. National Revenue Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
    <div class="revenue-card p-8 rounded-[40px] relative overflow-hidden group">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-white/5 rounded-full blur-3xl"></div>
        <div class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-4">Gross Mineral Value</div>
        <div class="text-3xl font-black text-white font-mono stat-glow mb-1">${{ number_format($stats['total_real_value'] / 1e6, 1) }}M</div>
        <p class="text-[8px] text-secondary font-bold uppercase tracking-widest">National Real Value</p>
    </div>

    <div class="revenue-card p-8 rounded-[40px] relative overflow-hidden group">
        <div class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-4">Declared Value</div>
        <div class="text-3xl font-black text-white font-mono mb-1">${{ number_format($stats['total_declared_value'] / 1e6, 1) }}M</div>
        <p class="text-[8px] text-white/30 font-bold uppercase tracking-widest">Registrant Submissions</p>
    </div>

    <div class="revenue-card p-8 rounded-[40px] border-error/20 bg-error/5 relative overflow-hidden group">
        <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-error/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="text-[9px] font-black text-error/60 uppercase tracking-widest mb-4">Revenue Leakage</div>
        <div class="text-4xl font-black text-error font-mono leakage-glow mb-1">-${{ number_format($stats['revenue_gap'] / 1e3, 1) }}K</div>
        <p class="text-[8px] text-error font-bold uppercase tracking-widest animate-pulse">Detection Active</p>
    </div>

    <div class="revenue-card p-8 rounded-[40px] border-secondary/20 bg-secondary/5 relative overflow-hidden group">
        <div class="text-[9px] font-black text-secondary/60 uppercase tracking-widest mb-4">Est. Royalties</div>
        <div class="text-3xl font-black text-secondary font-mono stat-glow mb-1">${{ number_format($stats['expected_royalties'] / 1e3, 1) }}K</div>
        <p class="text-[8px] text-secondary font-bold uppercase tracking-widest">Projected Intake</p>
    </div>

    <div class="revenue-card p-8 rounded-[40px] relative overflow-hidden group">
        <div class="text-[9px] font-black text-white/40 uppercase tracking-widest mb-4">Service Fees</div>
        <div class="text-3xl font-black text-white font-mono mb-1">${{ number_format($stats['processing_fees'] / 1e3, 1) }}K</div>
        <p class="text-[8px] text-white/30 font-bold uppercase tracking-widest">Bureaucratic Revenue</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

    <!-- 🚨 B. Risk Monitoring Panel -->
    <div class="lg:col-span-8">
        <div class="flex items-center justify-between mb-6 px-4">
            <h2 class="text-[11px] font-black text-on-surface-variant uppercase tracking-[.4em] flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-error border-2 border-white/10 shadow-[0_0_10px_#ef4444]"></span>
                Critical Risk Monitoring (Fraud Detection)
            </h2>
            <span class="text-[9px] font-bold text-white/20 uppercase tracking-widest">Real-time Analysis Stream</span>
        </div>

        <div class="revenue-card rounded-[48px] overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-white/5 border-b border-white/5">
                    <tr class="text-[9px] font-black text-white/30 uppercase tracking-[0.2em]">
                        <th class="px-8 py-6">Institution / Exporter</th>
                        <th class="px-8 py-6">Specimen</th>
                        <th class="px-8 py-6">Risk Profile</th>
                        <th class="px-8 py-6">Variance Amount</th>
                        <th class="px-8 py-6">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($highRiskTrades as $trade)
                    <tr class="group hover:bg-white-[2%] transition-all">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center font-black text-primary text-xs uppercase">{{ substr($trade->user->companies->first()->name ?? $trade->user->name, 0, 2) }}</div>
                                <div>
                                    <div class="text-[13px] font-black text-white uppercase tracking-tight">{{ $trade->user->companies->first()->name ?? $trade->user->name }}</div>
                                    <div class="text-[9px] text-white/20 font-bold uppercase tracking-widest mt-1">License: {{ $trade->trade_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] font-black text-white uppercase">{{ $trade->mineral_type }}</div>
                            <div class="text-[9px] text-white/40 font-bold uppercase tracking-widest mt-1">{{ number_format($trade->quantity_kg, 2) }} KG</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <span class="risk-badge bg-{{ strtolower($trade->risk_level) }} bg-opacity-10 border border-{{ strtolower($trade->risk_level) }} opacity-20">
                                    {{ $trade->risk_level }}
                                </span>
                                <div class="w-16 h-1.5 bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-{{ strtolower($trade->risk_level) }}" style="width: {{ $trade->risk_score }}%"></div>
                                </div>
                                <span class="text-[10px] font-black text-white">{{ $trade->risk_score }}%</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 font-mono font-black text-error text-[12px]">
                            -${{ number_format($trade->real_market_value - $trade->value_usd, 2) }}
                        </td>
                        <td class="px-8 py-6">
                            <button class="px-4 py-2 bg-error/10 border border-error/20 text-error text-[9px] font-black uppercase tracking-widest rounded-lg hover:bg-error hover:text-black transition-all">Flag & Block</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-32 text-center opacity-20">
                            <span class="material-symbols-outlined text-6xl mb-4">verified_user</span>
                            <p class="text-xs font-black uppercase tracking-widest">No Critical Financial Leakage Detected</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 📊 C. Revenue Analytics & Alerts -->
    <div class="lg:col-span-4 space-y-10">
        
        <!-- Revenue by Mineral Type -->
        <div class="revenue-card p-10 rounded-[48px]">
            <h3 class="text-[11px] font-black text-white/60 uppercase tracking-[.3em] mb-10">Revenue by Composition</h3>
            <div class="space-y-8">
                @foreach($revenueByMineral as $item)
                <div class="space-y-3">
                    <div class="flex justify-between items-end text-[10px] font-black uppercase tracking-widest">
                        <span class="text-white/40">{{ $item->mineral_type }}</span>
                        <span class="text-white">${{ number_format($item->total_royalty / 1e3, 1) }}K</span>
                    </div>
                    <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                        @php $peak = $revenueByMineral->max('total_royalty') ?: 1; @endphp
                        <div class="h-full bg-secondary shadow-[0_0_8px_rgba(78,222,163,0.3)]" style="width: {{ ($item->total_royalty / $peak) * 100 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ⚠️ D. Alert Center -->
        <div class="revenue-card p-10 rounded-[48px] border-error/10">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-[11px] font-black text-error uppercase tracking-[.3em] flex items-center gap-4">
                    <span class="material-symbols-outlined text-xl">gpp_maybe</span>
                    Financial Intelligence Alerts
                </h3>
            </div>
            
            <div class="space-y-4">
                @forelse($undervaluedAlerts as $alert)
                <div class="p-6 bg-error/5 border border-error/10 rounded-3xl group cursor-pointer hover:border-error/30 transition-all">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-[8px] font-black text-error uppercase tracking-widest">CRITICAL UNDERVALUATION</span>
                        <span class="text-[9px] text-white/20 font-mono tracking-tighter">{{ $alert->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-[11px] font-bold text-white uppercase tracking-tight leading-tight">
                        {{ $alert->tradeRequest->user->name }}: Value mismatch of {{ round($alert->valuation_gap / ($alert->real_market_value?:1) * 100) }}% detected on {{ $alert->tradeRequest->mineral_type }} export.
                    </p>
                    <div class="mt-6 flex justify-between items-center pt-4 border-t border-error/10">
                        <span class="text-[10px] font-black text-white/40 uppercase tracking-widest">Score: {{ $alert->risk_score }}%</span>
                        <button class="text-[9px] font-black text-error uppercase tracking-widest hover:underline">Request Audit</button>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 opacity-20 border-2 border-dashed border-white/5 rounded-[32px]">
                    <span class="material-symbols-outlined text-4xl mb-4">monitoring</span>
                    <p class="text-[10px] font-black uppercase tracking-widest">Scanning Global Ledger...</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Global Price Index Pulse -->
        <div class="p-8 bg-primary/5 border border-primary/20 rounded-[40px] relative overflow-hidden group">
            <div class="relative z-10">
                <h4 class="text-[10px] font-black text-primary uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm animate-spin">sync</span>
                    London Metal Exchange (LME) Sync
                </h4>
                <div class="space-y-4">
                    <div class="flex justify-between text-[11px] font-mono font-bold text-white uppercase">
                        <span class="text-white/40">Gold (XAU)</span>
                        <span>$62.42/G <span class="text-secondary text-[8px] ml-1">▲ 0.4%</span></span>
                    </div>
                     <div class="flex justify-between text-[11px] font-mono font-bold text-white uppercase">
                        <span class="text-white/40">Lithium (Li)</span>
                        <span>$14,200/T <span class="text-error text-[8px] ml-1">▼ 1.2%</span></span>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/20 transition-all duration-700"></div>
        </div>
    </div>
</div>
@endsection
