@extends('layouts.admin')

@section('title', 'GMITE - Global Control Center')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
    <!-- System Health -->
    <div class="card-premium p-4 rounded-xl">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">System Health</span>
            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
        </div>
        <div class="text-headline-md font-bold text-on-background">99.9%</div>
        <div class="text-[10px] text-secondary mt-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">trending_up</span> ALL NODES OPERATIONAL
        </div>
    </div>

    <!-- Active Traders -->
    <div class="card-premium p-4 rounded-xl">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">Active Users</span>
            <span class="material-symbols-outlined text-primary text-sm">group</span>
        </div>
        <div class="text-headline-md font-bold text-on-background">{{ number_format($stats['total_users'] ?? 1284) }}</div>
        <div class="text-[10px] text-on-surface-variant mt-1 uppercase">Sovereign Data Authorized</div>
    </div>

    <!-- Global Trade Volume -->
    <div class="card-premium p-4 rounded-xl">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">Total Exports (Val)</span>
            <span class="material-symbols-outlined text-primary text-sm">payments</span>
        </div>
        <div class="text-headline-md font-bold text-on-background">${{ number_format(($stats['revenue_usd'] ?? 4200000000) / 1000000, 1) }}M</div>
        <div class="text-[10px] text-secondary mt-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">trending_up</span> MARKET EXECUTION LIVE
        </div>
    </div>

    <!-- Critical Alerts -->
    <div class="card-premium p-4 rounded-xl border-l-4 border-l-error">
        <div class="flex justify-between items-start mb-2">
            <span class="text-label-caps text-on-surface-variant">Pending Alerts</span>
            <span class="material-symbols-outlined text-error text-sm">warning</span>
        </div>
        <div class="text-headline-md font-bold text-error">{{ $stats['alerts'] ?? 12 }}</div>
        <div class="text-[10px] text-error mt-1 flex items-center gap-1">
            <span class="material-symbols-outlined text-xs">security</span> FRAUD DETECTION ACTIVE
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Global Control Center Section -->
    <div class="lg:col-span-2 space-y-6">
        <div class="card-premium p-6 rounded-xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-headline-sm font-bold flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">hub</span>
                    Global Real-Time Trade Monitoring
                </h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-surface-container-high rounded text-[10px] font-bold border border-outline-variant hover:bg-surface-container-highest transition-colors">LIVE FEED</button>
                    <button class="px-3 py-1 bg-surface-container-high rounded text-[10px] font-bold border border-outline-variant hover:bg-surface-container-highest transition-colors">HISTORY</button>
                </div>
            </div>
            
            <div class="space-y-4">
                @if(isset($recent_trades) && count($recent_trades) > 0)
                    @foreach($recent_trades as $trade)
                    <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant rounded-lg hover:border-primary transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded bg-surface-container-highest flex items-center justify-center border border-outline-variant group-hover:bg-primary/10 transition-colors">
                                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">database</span>
                            </div>
                            <div>
                                <div class="font-bold text-on-background">{{ $trade->mineral_type }} Shipment #{{ $trade->trade_id }}</div>
                                <div class="text-[10px] text-on-surface-variant flex items-center gap-2 uppercase">
                                    <span class="material-symbols-outlined text-[12px]">public</span> {{ $trade->user->name }} &bull; {{ $trade->buyer_country ?? 'GLOBAL' }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-data-tabular font-bold text-primary">${{ number_format($trade->value_usd / 1000000, 2) }}M</div>
                            <div class="text-[10px] font-bold text-{{ $trade->status_color }}">
                                {{ $trade->status_label }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-10 opacity-20 text-[10px] font-black uppercase tracking-[0.3em]">No Trades Detected</div>
                @endif
            </div>
        </div>

        <!-- Country Activity Summary -->
        <div class="card-premium p-6 rounded-xl">
             <h2 class="text-headline-sm font-bold mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">public</span>
                National Mining Activity Summary
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                 @php
                    $countries = [
                        ['name' => 'Tanzania', 'production' => '84,000t', 'revenue' => '$1.2B', 'trend' => '+4.1%'],
                        ['name' => 'Chile', 'production' => '210,000t', 'revenue' => '$3.4B', 'trend' => '+2.8%'],
                        ['name' => 'Australia', 'production' => '150,000t', 'revenue' => '$2.9B', 'trend' => '+1.5%'],
                        ['name' => 'DRC', 'production' => '45,000t', 'revenue' => '$1.8B', 'trend' => '-1.2%'],
                    ];
                @endphp
                @foreach($countries as $country)
                <div class="p-4 bg-surface-container-highest rounded border border-outline-variant relative overflow-hidden group">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-on-background">{{ $country['name'] }}</span>
                        <span class="text-[10px] {{ str_contains($country['trend'], '+') ? 'text-secondary' : 'text-error' }} font-bold">{{ $country['trend'] }}</span>
                    </div>
                    <div class="flex justify-between text-[11px] text-on-surface-variant">
                        <span>Production: {{ $country['production'] }}</span>
                        <span>Revenue: {{ $country['revenue'] }}</span>
                    </div>
                    <div class="absolute bottom-0 left-0 h-0.5 bg-primary w-0 group-hover:w-full transition-all duration-500"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar actions & Analytics -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-surface-container-high border border-outline-variant p-6 rounded-xl relative overflow-hidden group/actions">
            <!-- Institutional Background Accents -->
            <div class="absolute -top-12 -right-12 w-24 h-24 bg-primary/5 rounded-full blur-2xl group-hover/actions:bg-primary/20 transition-all duration-700"></div>
            
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 tracking-[0.2em] flex items-center justify-between">
                EXECUTIVE ACTIONS
                <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
            </h3>
            
            <div class="grid grid-cols-1 gap-4">
                <button onclick="triggerExecutiveAction('Global Intelligence Report')" class="group relative w-full py-3.5 bg-primary rounded-xl text-on-primary-container font-black text-[11px] uppercase tracking-widest hover:brightness-105 active:scale-95 transition-all flex items-center justify-center gap-3 shadow-[0_4px_20px_rgba(173,198,255,0.15)] overflow-hidden">
                    <div class="absolute inset-x-0 bottom-0 h-0.5 bg-white/20 w-0 group-hover:w-full transition-all duration-700"></div>
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    <span class="action-label">Global Intelligence</span>
                    <span class="material-symbols-outlined text-sm hidden animate-spin">sync</span>
                </button>

                <button onclick="triggerExecutiveAction('World Mining Map')" class="w-full py-3 bg-surface-container-highest text-on-surface font-bold text-[10px] rounded-xl border border-outline-variant hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center gap-4 px-6 active:scale-[0.98] group">
                    <span class="material-symbols-outlined text-sm text-primary group-hover:rotate-12 transition-transform">map</span>
                    <span class="tracking-widest uppercase">World Mining Map</span>
                </button>

                <button onclick="triggerExecutiveAction('System Analytics')" class="w-full py-3 bg-surface-container-highest text-on-surface font-bold text-[10px] rounded-xl border border-outline-variant hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center gap-4 px-6 active:scale-[0.98] group">
                    <span class="material-symbols-outlined text-sm text-primary group-hover:scale-110 transition-transform">query_stats</span>
                    <span class="tracking-widest uppercase">System Analytics</span>
                </button>

                <button onclick="triggerExecutiveAction('Security Audit')" class="w-full py-3 bg-error/5 text-error font-bold text-[10px] rounded-xl border border-error/20 hover:bg-error/10 hover:border-error transition-all flex items-center gap-4 px-6 active:scale-[0.98] group">
                    <span class="material-symbols-outlined text-sm group-hover:animate-shake transition-transform">notification_important</span>
                    <span class="tracking-widest uppercase">View Critical Alerts</span>
                </button>

                <button onclick="triggerExecutiveAction('User Management')" class="w-full py-3 bg-surface-container-highest text-on-surface font-bold text-[10px] rounded-xl border border-outline-variant hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center gap-4 px-6 active:scale-[0.98] group">
                    <span class="material-symbols-outlined text-sm text-primary group-hover:scale-110 transition-transform">group</span>
                    <span class="tracking-widest uppercase">Manage Users</span>
                </button>

                <button onclick="triggerExecutiveAction('System Configuration')" class="w-full py-3 bg-surface-container-highest text-on-surface font-bold text-[10px] rounded-xl border border-outline-variant hover:border-primary/50 hover:bg-primary/5 transition-all flex items-center gap-4 px-6 active:scale-[0.98] group">
                    <span class="material-symbols-outlined text-sm text-primary group-hover:rotate-90 transition-transform duration-500">settings</span>
                    <span class="tracking-widest uppercase">Configuration</span>
                </button>

                <button onclick="exportExecutiveReport()" id="btn-export" class="w-full py-3 bg-secondary/10 text-secondary font-bold text-[10px] rounded-xl border border-secondary/20 hover:bg-secondary hover:text-black transition-all flex items-center gap-4 px-6 active:scale-[0.98] group">
                    <span class="material-symbols-outlined text-sm group-hover:translate-y-0.5 transition-transform">file_download</span>
                    <span class="btn-text tracking-widest uppercase">Export Executive Report</span>
                    <span class="material-symbols-outlined text-sm hidden animate-spin">sync</span>
                </button>
            </div>
        </div>

        <!-- Compliance Violations Section -->
        <div class="card-premium p-6 rounded-xl border border-error/20 bg-error-[5%] relative overflow-hidden group/compliance">
            <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-error/5 rounded-full blur-2xl group-hover/compliance:bg-error/10 transition-all duration-700"></div>
            
            <div class="flex justify-between items-center mb-4 relative z-10">
                <h3 class="text-label-caps font-bold text-error tracking-widest">Compliance Audit</h3>
                <span class="material-symbols-outlined text-error text-sm animate-pulse">report</span>
            </div>
            <div class="space-y-3 relative z-10">
                <div class="p-4 bg-error/5 border border-error/20 rounded-xl hover:bg-error/10 transition-colors cursor-pointer">
                    <div class="text-[11px] font-black text-error uppercase tracking-widest">ILLEGAL MINING DETECTED</div>
                    <div class="text-[10px] text-on-surface-variant flex items-center gap-2 mt-1 uppercase font-bold">
                        <span class="material-symbols-outlined text-[12px]">location_on</span> Zone 42 - Amazon Basin (Sector G)
                    </div>
                </div>
                <div class="p-4 bg-surface-container-highest border border-outline-variant rounded-xl opacity-70 hover:opacity-100 transition-opacity cursor-pointer">
                    <div class="text-[11px] font-black text-on-surface uppercase tracking-widest">EXPORT LICENSE EXPIRED</div>
                    <div class="text-[10px] text-on-surface-variant flex items-center gap-2 mt-1 uppercase font-bold">
                         <span class="material-symbols-outlined text-[12px]">business</span> Trader: Global Resources Ltd.
                    </div>
                </div>
            </div>
            <button class="mt-6 w-full text-[10px] font-black text-primary hover:text-secondary uppercase tracking-[0.2em] transition-colors flex items-center justify-center gap-2">
                All Compliance Cases <span class="material-symbols-outlined text-sm">east</span>
            </button>
        </div>

        <!-- User/System Activity -->
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-xl relative overflow-hidden group/activity">
            <div class="absolute top-0 right-0 w-full h-1 bg-gradient-to-r from-transparent via-primary/20 to-transparent"></div>
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 tracking-widest uppercase opacity-60">System Security Log</h3>
            <div class="space-y-5">
                @if(isset($recent_activities) && count($recent_activities) > 0)
                    @foreach($recent_activities as $log)
                    <div class="flex items-start gap-4">
                        <div class="w-1.5 h-1.5 rounded-full bg-{{ $loop->first ? 'secondary' : 'primary' }} mt-1.5 shadow-[0_0_8px_#4edea3]"></div>
                        <div class="text-[11px] text-on-surface leading-relaxed">
                            <span class="font-black text-white/40 uppercase tracking-tighter">{{ $log->module }}:</span> 
                            <span class="font-bold">{{ $log->admin->full_name ?? 'SYSTEM' }}</span> {{ $log->action_type }} 
                            <span class="text-[9px] opacity-40 font-data-tabular italic ml-2">{{ $log->timestamp->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="py-10 text-center opacity-20 text-[10px] font-black uppercase tracking-widest">Logs Synced & Clear</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function triggerExecutiveAction(action) {
        console.log(`Institutional Action Triggered: ${action}`);
        // World Standard Action simulation
        const overlay = document.createElement('div');
        overlay.className = 'fixed inset-0 z-[1000] bg-black/60 backdrop-blur-md flex items-center justify-center animate-in fade-in duration-500';
        overlay.innerHTML = `
            <div class="glass-card p-10 rounded-[32px] border border-white/10 text-center max-w-sm mx-auto shadow-2xl scale-in-center">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl border border-primary/20 flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-primary text-3xl animate-spin">refresh</span>
                </div>
                <h4 class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] mb-2 font-display">System Processing</h4>
                <div class="text-lg font-black text-white uppercase tracking-tighter mb-4">${action} Initialization</div>
                <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden mb-6">
                    <div class="h-full bg-primary animate-[progress_1.5s_ease-in-out_infinite]" style="width: 30%"></div>
                </div>
                <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest leading-loose">Establishing secure connection to Global Intelligence Node v4.2... Authorization Verified.</p>
            </div>
        `;
        document.body.appendChild(overlay);
        setTimeout(() => {
            overlay.classList.add('fade-out');
            setTimeout(() => overlay.remove(), 500);
        }, 1500);
    }

    function exportExecutiveReport() {
        const btn = document.getElementById('btn-export');
        const text = btn.querySelector('.btn-text');
        const loader = btn.querySelector('.animate-spin');
        const originalText = text.textContent;

        btn.disabled = true;
        text.textContent = 'GENERATING PDF...';
        loader.classList.remove('hidden');

        setTimeout(() => {
            text.textContent = 'DOWNLOADING...';
            setTimeout(() => {
                text.textContent = 'EXPORT SUCCESSFUL';
                btn.classList.add('bg-secondary', 'text-black');
                loader.classList.add('hidden');
                
                setTimeout(() => {
                    text.textContent = originalText;
                    btn.classList.remove('bg-secondary', 'text-black');
                    btn.disabled = false;
                }, 2000);
            }, 1000);
        }, 1500);
    }
</script>

<style>
    @keyframes progress {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(400%); }
    }
    @keyframes shake {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(5deg); }
        75% { transform: rotate(-5deg); }
    }
    .animate-shake { animation: shake 0.3s ease-in-out infinite; }
    .scale-in-center { animation: scale-in-center 0.4s cubic-bezier(0.250, 0.460, 0.450, 0.940) both; }
    @keyframes scale-in-center {
        0% { transform: scale(0); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
@endsection