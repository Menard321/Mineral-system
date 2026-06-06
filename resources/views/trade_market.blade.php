@extends('layouts.admin')

@section('title', 'GMITE - Sovereign Trade Terminal')

@section('content')
<!-- Trade Intelligence Branding -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative">
            <div class="absolute inset-0 bg-secondary/20 rounded-2xl blur-3xl animate-pulse"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-secondary/40 rounded-[28px] flex items-center justify-center text-secondary shadow-2xl">
                 <span class="material-symbols-outlined text-4xl group-hover:scale-110 transition-transform duration-500">currency_exchange</span>
            </div>
        </div>
        <div>
             <div class="flex items-center gap-4">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Trade Intelligence</h1>
                <span class="bg-secondary/10 text-secondary text-[10px] font-black px-3 py-1 rounded-full border border-secondary/20 tracking-[0.2em] uppercase">Market Validated</span>
             </div>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60 font-data-tabular">National Mineral Commerce Regulator [Sovereign-Trade v1.0]</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="triggerExecutiveAction('Initialize Trade Request')" class="px-8 py-4 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all flex items-center gap-4 shadow-2xl shadow-primary/20">
            <span class="material-symbols-outlined text-xl">add_circle</span>
            New Trade Request
        </button>
        <button onclick="triggerExecutiveAction('Batch Price Sync')" class="px-8 py-4 bg-surface-container-low text-on-surface rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] border border-outline-variant hover:border-secondary transition-all flex items-center gap-4">
            <span class="material-symbols-outlined text-xl">trending_up</span>
            Price Sync
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Market Analytics Dashboard -->
    <div class="lg:col-span-8 space-y-8">
        
        <!-- Live Market Intelligence Deck -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @php
                $stats = [
                    ['label' => 'Active Trades', 'val' => '1,242', 'sub' => '+12 today', 'col' => 'primary'],
                    ['label' => 'Mkt Value (Tsh)', 'val' => '42.8B', 'sub' => 'Sovereign Est.', 'col' => 'secondary'],
                    ['label' => 'Export Ratio', 'val' => '68%', 'sub' => 'International', 'col' => 'primary'],
                    ['label' => 'Compliance', 'val' => '100%', 'sub' => 'Full Audit', 'col' => 'secondary'],
                ];
            @endphp
            @foreach($stats as $s)
            <div class="bg-surface-container-low border border-outline-variant/30 p-6 rounded-[32px] group hover:border-{{ $s['col'] }}/40 transition-all">
                <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest mb-2 opacity-60">{{ $s['label'] }}</div>
                <div class="text-2xl font-black text-on-background tracking-tighter mb-1 font-data-tabular">{{ $s['val'] }}</div>
                <div class="text-[9px] font-bold text-{{ $s['col'] }} uppercase tracking-widest">{{ $s['sub'] }}</div>
            </div>
            @endforeach
        </div>

        <!-- Mineral Trade Registry (Transaction Layer) -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden group/registry">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase flex items-center gap-4">
                    <span class="w-1.5 h-8 bg-secondary rounded-full"></span>
                    Sovereign Transaction Registry
                </h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                        <input type="text" placeholder="Search Trade ID / Sample ID..." class="bg-surface-container-highest border border-outline-variant rounded-full pl-12 pr-6 py-2 text-[11px] font-bold text-on-surface w-64 focus:border-secondary outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant/30 text-[10px] font-black text-on-surface-variant uppercase tracking-widest pb-4">
                            <th class="text-left pb-4">ID & Batch</th>
                            <th class="text-left pb-4">Scientific Match</th>
                            <th class="text-left pb-4">Volume</th>
                            <th class="text-left pb-4">Destination</th>
                            <th class="text-right pb-4">Protocol Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @php
                            $trades = [
                                ['id' => 'TRD-4401', 'sample' => 'B-77401', 'mineral' => 'Lithium (99.5%)', 'weight' => '12.4t', 'dest' => 'Belgium (Port Antwerp)', 'status' => 'EXPORT CLEARED', 'col' => 'secondary'],
                                ['id' => 'TRD-4402', 'sample' => 'B-77402', 'mineral' => 'Gold Dore - 24ct', 'weight' => '42kg', 'dest' => 'United Arab Emirates', 'status' => 'LAB VERIFIED', 'col' => 'primary'],
                                ['id' => 'TRD-4403', 'sample' => 'B-77403', 'mineral' => 'Copper Cathode', 'weight' => '120t', 'dest' => 'Domestic (DSM Hub)', 'status' => 'COMPLIANCE PENDING', 'col' => 'on-surface-variant'],
                            ];
                        @endphp
                        @foreach($trades as $t)
                        <tr class="group/row hover:bg-white/5 transition-colors">
                            <td class="py-6">
                                <div>
                                    <div class="text-[14px] font-black text-on-background uppercase tracking-tight">{{ $t['id'] }}</div>
                                    <div class="text-[10px] text-primary font-bold tracking-widest">MINER: NORTH STAR MINING</div>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-secondary text-lg">verified</span>
                                    <div>
                                         <div class="text-[11px] font-black text-on-background uppercase">{{ $t['sample'] }}</div>
                                         <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-60">{{ $t['mineral'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-[12px] font-black text-on-background font-data-tabular uppercase tracking-tight">{{ $t['weight'] }}</td>
                            <td class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest opacity-80">{{ $t['dest'] }}</td>
                            <td class="text-right">
                                <span class="bg-{{ $t['col'] }}/10 text-{{ $t['col'] }} text-[9px] font-black px-4 py-1.5 rounded-full border border-{{ $t['col'] }}/20 tracking-[0.15em] uppercase">{{ $t['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button class="w-full mt-10 py-4 bg-surface-container-highest border border-outline-variant rounded-2xl text-[11px] font-black uppercase tracking-[0.3em] text-on-surface hover:text-secondary transition-all">
                Access Full Regulatory Ledger
            </button>
        </div>

        <!-- Real-Time Price Monitoring & Intelligence -->
        <div class="card-premium p-10 rounded-[48px] relative overflow-hidden group/pricing">
             <div class="absolute -top-12 -right-12 w-48 h-48 bg-secondary/5 rounded-full blur-3xl group-hover/pricing:bg-secondary/10 transition-all duration-700"></div>
             
             <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-10 flex items-center gap-4">
                <span class="material-symbols-outlined text-secondary">trending_up</span>
                Global Price Observatory
             </h2>
             
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $prices = [
                        ['mineral' => 'GOLD (24K)', 'price' => '162,400', 'unit' => 'Tsh/g', 'delta' => '+1.2%', 'col' => 'secondary'],
                        ['mineral' => 'LITHIUM', 'price' => '14,280', 'unit' => 'USD/t', 'delta' => '-0.4%', 'col' => 'error'],
                        ['mineral' => 'COPPER CRT', 'price' => '9,201', 'unit' => 'USD/t', 'delta' => '+0.8%', 'col' => 'secondary'],
                    ];
                @endphp
                @foreach($prices as $p)
                <div class="p-8 bg-surface-container-low border border-outline-variant rounded-[32px] relative group/price overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-5 group-hover/price:opacity-20 transition-opacity">
                         <span class="material-symbols-outlined text-4xl">payments</span>
                    </div>
                    <div class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest mb-2 opacity-50">{{ $p['mineral'] }}</div>
                    <div class="flex items-end gap-2 mb-4">
                        <div class="text-2xl font-black text-on-background font-data-tabular">{{ $p['price'] }}</div>
                        <div class="text-[11px] font-bold text-on-surface-variant mb-1 uppercase opacity-60">{{ $p['unit'] }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-{{ $p['col'] }}"></span>
                        <span class="text-[10px] font-black text-{{ $p['col'] }} uppercase tracking-widest font-data-tabular">{{ $p['delta'] }} 24HR</span>
                    </div>
                </div>
                @endforeach
             </div>
        </div>
    </div>

    <!-- Right Regulatory Column -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Export Control & Authorization Module -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[48px] relative overflow-hidden">
             <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full border-b border-l border-outline-variant/30"></div>
             <h3 class="text-label-caps font-black text-on-surface-variant mb-10 tracking-[0.3em] uppercase opacity-60">Compliance Gateway</h3>
             
             <div class="space-y-6">
                @php
                    $checks = [
                        ['label' => 'Cert. Lab Verified', 'active' => true],
                        ['label' => 'Mining Lic. Confirmed', 'active' => true],
                        ['label' => 'Env. Clearance Active', 'active' => true],
                        ['label' => 'Customs Ref Synced', 'active' => false],
                    ];
                @endphp
                @foreach($checks as $chk)
                <div class="flex items-center justify-between p-4 bg-surface-container-high border border-outline-variant rounded-2xl group">
                    <span class="text-[11px] font-black text-on-surface uppercase tracking-widest opacity-80 group-hover:opacity-100 transition-opacity">{{ $chk['label'] }}</span>
                    <div class="w-6 h-6 rounded-lg {{ $chk['active'] ? 'bg-secondary/10 text-secondary border border-secondary/20' : 'bg-surface-container-highest text-on-surface-variant border border-outline-variant' }} flex items-center justify-center transition-all">
                        <span class="material-symbols-outlined text-[16px]">{{ $chk['active'] ? 'check' : 'pending' }}</span>
                    </div>
                </div>
                @endforeach

                <div class="pt-6">
                    <div class="p-6 bg-primary rounded-[32px] text-on-primary-container relative overflow-hidden group/auth cursor-pointer">
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover/auth:bg-white/20 transition-all"></div>
                        <div class="flex items-center justify-between relative z-10">
                            <div>
                                <div class="text-[10px] font-black uppercase tracking-widest mb-1">Authorization Status</div>
                                <div class="text-lg font-black uppercase tracking-tighter">Issue Export Permit</div>
                            </div>
                            <span class="material-symbols-outlined text-4xl opacity-30">verified_user</span>
                        </div>
                    </div>
                </div>
             </div>
        </div>

        <!-- Trade Analytics & Forecast Intelligence -->
        <div class="card-premium p-8 rounded-[40px] border border-secondary/20 bg-secondary-[2%]">
             <h3 class="text-label-caps font-black text-secondary mb-8 tracking-[0.2em] uppercase">Trade Forecast Hub</h3>
             <div class="space-y-10">
                 <div class="space-y-2">
                    <div class="flex justify-between text-[11px] font-black uppercase tracking-widest">
                        <span class="text-on-surface-variant">Production Trend</span>
                        <span class="text-secondary font-data-tabular">+24.2%</span>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-secondary" style="width: 72%"></div>
                    </div>
                </div>

                <div class="space-y-4">
                    @php
                        $entities = [
                            ['name' => 'AngloGold T. Ltd', 'score' => '9.8', 'status' => 'LEADER'],
                            ['name' => 'Geita Gold Mine', 'score' => '9.4', 'status' => 'RELIANT'],
                            ['name' => 'Mineral X Pro', 'score' => '4.2', 'status' => 'WATCHLIST'],
                        ];
                    @endphp
                    @foreach($entities as $e)
                    <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant rounded-2xl group hover:border-secondary transition-all">
                        <div>
                             <div class="text-[11px] font-black text-on-surface uppercase">{{ $e['name'] }}</div>
                             <div class="text-[9px] font-black {{ $e['status'] == 'WATCHLIST' ? 'text-error' : 'text-secondary' }} uppercase tracking-widest opacity-60">{{ $e['status'] }}</div>
                        </div>
                        <div class="text-right">
                             <div class="text-sm font-black text-on-background font-data-tabular">{{ $e['score'] }}</div>
                             <div class="text-[8px] font-bold text-on-surface-variant">REP SCORE</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="w-full py-4 bg-surface-container-highest border border-outline-variant rounded-2xl text-[9px] font-black uppercase tracking-[0.3em] text-on-surface hover:text-secondary transition-all">
                    Full Entity Intelligence
                </button>
             </div>
        </div>

        <!-- Fraud & Integrity Monitor -->
        <div class="p-6 bg-error/5 border border-error/20 rounded-[32px]">
            <div class="flex items-center gap-3 text-error mb-4">
                 <span class="material-symbols-outlined text-lg">gavel</span>
                 <span class="text-[10px] font-black uppercase tracking-widest">Pricing Integrity Monitor</span>
            </div>
            <p class="text-[9px] font-bold text-on-surface-variant leading-relaxed opacity-60 uppercase">
                Detecting unusual price deviations... No over-invoicing anomalies detected in current batch. Verification ongoing.
            </p>
        </div>
    </div>
</div>

<script>
    // Market Simulation Heartbeat
    setInterval(() => {
        const deltas = document.querySelectorAll('.group\/price span[class*="font-data-tabular"]');
        deltas.forEach(delta => {
            const currentVal = parseFloat(delta.textContent);
            const move = (Math.random() - 0.5) * 0.1;
            const newVal = (currentVal + move).toFixed(1);
            delta.textContent = (newVal > 0 ? '+' : '') + newVal + '%';
        });
    }, 2000);
</script>
@endsection
