@extends('layouts.executive')

@section('title', 'GMITE - Global Analytics Intelligence')

@section('content')
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div>
        <h1 class="text-display-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-primary tracking-tighter">Global Analytics Dashboard</h1>
        <p class="text-body-md text-on-surface-variant flex items-center gap-2">
            AI-Driven Mineral Intelligence & Forecasting Network
            <span class="px-2 py-0.5 bg-primary/10 text-primary rounded text-[9px] font-bold border border-primary/20 uppercase tracking-widest">Enterprise Mode</span>
        </p>
    </div>
    <div class="flex flex-wrap gap-3">
        <button class="bg-surface-container-high px-4 py-2 rounded-lg border border-outline-variant text-[11px] font-bold hover:bg-surface-container-highest transition-all flex items-center gap-2 uppercase tracking-wide">
            <span class="material-symbols-outlined text-sm">compare_arrows</span>
            Compare Countries
        </button>
        <button class="bg-surface-container-high px-4 py-2 rounded-lg border border-outline-variant text-[11px] font-bold hover:bg-surface-container-highest transition-all flex items-center gap-2 uppercase tracking-wide">
            <span class="material-symbols-outlined text-sm">refresh</span>
            Refresh Intelligence
        </button>
        <button class="btn-primary flex items-center gap-2 px-6">
            <span class="material-symbols-outlined text-sm text-on-primary">monitoring</span>
            View AI Forecast
        </button>
    </div>
</div>

<!-- Primary Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card-premium p-6 rounded-2xl relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-lg"><span class="material-symbols-outlined text-primary">universal_currency_alt</span></div>
            <div class="text-[10px] font-data-tabular text-secondary">+14.2% YoY</div>
        </div>
        <div class="text-[10px] font-bold text-on-surface-variant uppercase mb-1">Global Market Value</div>
        <div class="text-3xl font-bold text-on-background">$2.84 Trillion</div>
        <div class="h-12 mt-4 flex items-end gap-1 px-1">
             @foreach(range(1,15) as $i)
             <div class="flex-1 bg-primary/20 rounded-t group-hover:bg-primary/40 transition-all" style="height: {{ rand(30, 100) }}%"></div>
             @endforeach
        </div>
    </div>

    <div class="card-premium p-6 rounded-2xl relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-secondary/10 rounded-lg"><span class="material-symbols-outlined text-secondary">precision_manufacturing</span></div>
            <div class="text-[10px] font-data-tabular text-secondary">+2.4% MoM</div>
        </div>
        <div class="text-[10px] font-bold text-on-surface-variant uppercase mb-1">Extracted Volume (24h)</div>
        <div class="text-3xl font-bold text-on-background">842.1K MT</div>
        <div class="h-12 mt-4 flex items-end gap-1 px-1">
             @foreach(range(1,15) as $i)
             <div class="flex-1 bg-secondary/20 rounded-t group-hover:bg-secondary/40 transition-all" style="height: {{ rand(30, 100) }}%"></div>
             @endforeach
        </div>
    </div>

    <div class="card-premium p-6 rounded-2xl relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-tertiary/10 rounded-lg"><span class="material-symbols-outlined text-tertiary">swap_calls</span></div>
            <div class="text-[10px] font-data-tabular text-tertiary">-1.8% vs Expected</div>
        </div>
        <div class="text-[10px] font-bold text-on-surface-variant uppercase mb-1">Active Trade Routes</div>
        <div class="text-3xl font-bold text-on-background">1,402</div>
        <div class="h-12 mt-4 flex items-end gap-1 px-1">
             @foreach(range(1,15) as $i)
             <div class="flex-1 bg-tertiary/20 rounded-t group-hover:bg-tertiary/40 transition-all" style="height: {{ rand(30, 100) }}%"></div>
             @endforeach
        </div>
    </div>

    <div class="card-premium p-6 rounded-2xl relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-lg"><span class="material-symbols-outlined text-primary">data_exploration</span></div>
            <div class="text-[10px] font-data-tabular text-primary">AI CONFIDENCE 98%</div>
        </div>
        <div class="text-[10px] font-bold text-on-surface-variant uppercase mb-1">Forecasting Horizon</div>
        <div class="text-3xl font-bold text-on-background">Q3 - 2027</div>
        <div class="h-12 mt-4 flex items-end gap-1 px-1">
             @foreach(range(1,15) as $i)
             <div class="flex-1 bg-primary/10 rounded-t group-hover:bg-primary/20 transition-all" style="height: {{ rand(30, 100) }}%"></div>
             @endforeach
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
    <!-- Production Trends Chart Area -->
    <div class="lg:col-span-2 card-premium p-8 rounded-3xl relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary/5 rounded-full blur-[80px]"></div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                 <h2 class="text-headline-sm font-bold text-on-background">Global Mineral Production Trends</h2>
                 <p class="text-[11px] text-on-surface-variant">Comparative analysis across critical mineral categories (Rolling 12 Month)</p>
            </div>
            <div class="flex gap-2">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-highest rounded-full border border-primary/20 text-[10px] font-bold text-primary">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span> LITHIUM
                </span>
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-highest rounded-full border border-secondary/20 text-[10px] font-bold text-secondary opacity-50">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span> COPPER
                </span>
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-highest rounded-full border border-tertiary/20 text-[10px] font-bold text-tertiary opacity-50">
                    <span class="w-1.5 h-1.5 rounded-full bg-tertiary"></span> COBALT
                </span>
            </div>
        </div>

        <div class="h-80 w-full flex items-end justify-between px-2 group">
            <!-- Stylized CSS Chart Placeholder -->
            @php $points = [42, 38, 45, 52, 48, 55, 62, 70, 68, 75, 82, 90]; @endphp
            @foreach($points as $idx => $p)
                <div class="flex flex-col items-center gap-3 w-full group/bar">
                    <div class="w-2/3 max-w-[40px] bg-primary/10 border-t border-x border-primary/40 rounded-t-lg transition-all duration-700 relative group-hover/bar:bg-primary/30 group-hover/bar:border-primary" style="height: {{ $p*3 }}px">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface-container text-white px-2 py-1 rounded text-[10px] font-bold opacity-0 group-hover/bar:opacity-100 transition-opacity border border-outline-variant pointer-events-none">
                            {{ $p }}%
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-between mt-6 px-4 text-[10px] font-bold text-on-surface-variant/60 tracking-widest uppercase">
            <span>MAY 2025</span>
            <span>AUG</span>
            <span>NOV</span>
            <span>FEB</span>
            <span>MAY 2026</span>
        </div>
    </div>

    <!-- AI Distribution Insights -->
    <div class="space-y-6">
        <div class="card-premium p-6 rounded-3xl border border-secondary/20 bg-secondary/5">
             <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined">auto_graph</span>
                </div>
                <h3 class="font-bold text-on-background uppercase tracking-wider text-xs">AI Market Intelligence</h3>
             </div>
             
             <div class="space-y-6">
                <div class="relative pl-6 border-l-2 border-secondary/30">
                    <div class="text-[11px] font-bold text-on-background mb-1">SUPPLY PINCH DETECTED</div>
                    <p class="text-[10px] text-on-surface-variant">Lithium LCE supply is trending -12% below demand capacity for Q4. Action: Strategic stockpiling advised for Level 05 parties.</p>
                </div>
                <div class="relative pl-6 border-l-2 border-secondary/30 opacity-70">
                    <div class="text-[11px] font-bold text-on-background mb-1">EMERGING NICKEL HUB</div>
                    <p class="text-[10px] text-on-surface-variant">Greenfield mining activity in Indonesian Sulawesi sector is outperforming AI baseline by 42%.</p>
                </div>
             </div>

             <button class="mt-8 w-full py-2 bg-secondary text-on-secondary text-[11px] font-bold rounded uppercase tracking-widest hover:opacity-90">Generate AI Summary</button>
        </div>

        <div class="card-premium p-6 rounded-3xl">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase tracking-widest text-center">Revenue Heat Distribution</h3>
            <div class="space-y-4">
                 @php
                    $revenues = [
                        ['c' => 'China', 'r' => '$840M', 'p' => 70, 'col' => 'primary'],
                        ['c' => 'USA', 'r' => '$420M', 'p' => 45, 'col' => 'secondary'],
                        ['c' => 'EU Central', 'r' => '$310M', 'p' => 30, 'col' => 'tertiary'],
                        ['c' => 'India', 'r' => '$190M', 'p' => 15, 'col' => 'primary'],
                    ];
                @endphp
                @foreach($revenues as $rev)
                <div class="space-y-1.5">
                    <div class="flex justify-between text-[11px] font-bold">
                        <span class="text-on-background">{{ $rev['c'] }}</span>
                        <span class="text-primary">{{ $rev['r'] }}</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-1 rounded-full overflow-hidden">
                        <div class="h-full bg-{{ $rev['col'] }}" style="width: {{ $rev['p'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="mt-6 w-full text-center text-[10px] font-bold text-on-surface-variant hover:text-primary transition-colors cursor-pointer uppercase tracking-widest">View Detailed Financials</button>
        </div>
    </div>
</div>

<!-- Comparison Table Section -->
<div class="grid grid-cols-1 gap-8 pb-12">
    <div class="card-premium p-6 rounded-3xl overflow-hidden min-h-[400px]">
        <div class="flex justify-between items-center mb-8 px-2">
            <h2 class="text-headline-sm font-bold text-on-background">Cross-Country Extraction Performance</h2>
            <div class="flex gap-4">
                <div class="flex items-center gap-2 bg-surface-container-high px-3 py-1 rounded border border-outline-variant text-[11px] font-bold">
                    <span class="material-symbols-outlined text-sm text-on-surface-variant">calendar_today</span>
                    LAST 30 DAYS
                </div>
                 <div class="flex items-center gap-2 bg-surface-container-high px-3 py-1 rounded border border-outline-variant text-[11px] font-bold cursor-pointer hover:border-primary transition-all">
                    <span class="material-symbols-outlined text-sm">filter_alt</span>
                    FILTERS
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
             <table class="w-full text-left border-collapse">
                <thead class="text-[10px] font-bold text-on-surface-variant/60 uppercase tracking-widest border-b border-outline-variant/30">
                    <tr>
                        <th class="px-6 py-4">Territory</th>
                        <th class="px-6 py-4">Primary Mineral</th>
                        <th class="px-6 py-4 text-right">Production (MT)</th>
                        <th class="px-6 py-4 text-right">Revenue Cont.</th>
                        <th class="px-6 py-4 text-center">ESG Compliance</th>
                        <th class="px-6 py-4 text-right">Performance Δ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10 text-[11px]">
                    @php
                        $data = [
                            ['country' => 'Tanzania', 'min' => 'Gold', 'prod' => '84,200', 'rev' => '$4.2B', 'esg' => 'A+', 'delta' => '+12.4%'],
                            ['country' => 'Australia', 'min' => 'Lithium', 'prod' => '150,000', 'rev' => '$2.1B', 'esg' => 'A', 'delta' => '+8.2%'],
                            ['country' => 'DRC', 'min' => 'Cobalt', 'prod' => '45,800', 'rev' => '$1.9B', 'esg' => 'B-', 'delta' => '-2.1%'],
                            ['country' => 'Chile', 'min' => 'Copper', 'prod' => '210,400', 'rev' => '$5.8B', 'esg' => 'A-', 'delta' => '+4.5%'],
                            ['country' => 'Canada', 'min' => 'Potash', 'prod' => '320,000', 'rev' => '$1.4B', 'esg' => 'A+', 'delta' => '+1.1%'],
                        ];
                    @endphp
                    @foreach($data as $row)
                    <tr class="hover:bg-primary/5 transition-colors group cursor-pointer">
                        <td class="px-6 py-5 font-bold text-on-background">{{ $row['country'] }}</td>
                        <td class="px-6 py-5">
                             <div class="px-2 py-0.5 bg-surface-container-highest rounded border border-outline-variant inline-block text-[10px]">{{ $row['min'] }}</div>
                        </td>
                        <td class="px-6 py-5 text-right font-data-tabular">{{ $row['prod'] }}</td>
                        <td class="px-6 py-5 text-right font-data-tabular font-bold text-primary">{{ $row['rev'] }}</td>
                        <td class="px-6 py-5 text-center">
                            <span class="px-3 py-1 rounded-full {{ str_starts_with($row['esg'], 'A') ? 'bg-secondary/10 text-secondary border-secondary/20' : 'bg-tertiary/10 text-tertiary border-tertiary/20' }} border text-[10px] font-bold">
                                {{ $row['esg'] }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right font-bold {{ str_contains($row['delta'], '+') ? 'text-secondary' : 'text-error' }}">
                            {{ $row['delta'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
             </table>
        </div>
    </div>
</div>
@endsection