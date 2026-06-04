@extends('layouts.executive')

@section('title', 'GMITE - Global Mineral Intelligence Atlas')

@section('content')
<!-- TOP HEADER (GLOBAL CONTROL BAR) -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="w-16 h-16 bg-primary/10 border border-primary/20 rounded-2xl flex items-center justify-center glow-secondary">
             <span class="material-symbols-outlined text-primary text-4xl animate-pulse">public</span>
        </div>
        <div>
            <h1 class="text-[32px] font-black tracking-tighter text-white uppercase">Global Mineral Intelligence Atlas</h1>
            <div class="flex items-center gap-4 text-[10px] font-bold text-white/40 tracking-[0.2em] mt-1">
                <span id="atlas-clock" class="text-secondary font-data-tabular">19:57:51 GMT+3</span>
                <span class="w-1 h-1 bg-white/20 rounded-full"></span>
                <span class="uppercase">Region: <span class="text-white" id="selected-region-label">GLOBAL (ALL)</span></span>
                <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                <span class="text-secondary flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_5px_#4edea3]"></span>
                    REAL-TIME SYNC
                </span>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <div class="flex bg-white/5 p-1 rounded-xl border border-white/10">
            <button onclick="toggleView('map')" id="btn-map-view" class="px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all bg-primary text-black">Map View</button>
            <button onclick="toggleView('table')" id="btn-table-view" class="px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all text-white/60 hover:text-white">Table View</button>
        </div>
        <button class="px-5 py-2 bg-white/5 border border-white/10 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:border-primary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">filter_alt</span> Mineral Filter
        </button>
        <button class="px-5 py-2 bg-primary text-black rounded-xl text-[10px] font-bold uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-2 shadow-[0_4px_20px_rgba(173,198,255,0.3)]">
            <span class="material-symbols-outlined text-sm">description</span> Global Report
        </button>
        <div class="flex items-center gap-2 ml-4">
             <div class="relative group">
                 <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-white/30 group-focus-within:text-primary transition-colors">search</span>
                 <input type="text" id="global-country-search" placeholder="Search Country Intelligence..." 
                        class="bg-[#0D1525] border border-white/10 rounded-xl pl-12 pr-4 py-2 text-[11px] text-white outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 w-72 transition-all"
                        onkeyup="if(event.key === 'Enter') handleGlobalSearch()">
             </div>
        </div>
    </div>
</div>

<!-- ANALYTICS MINI DASHBOARD -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
     @php
        $stats = [
            ['label' => 'Total Countries', 'val' => '195', 'col' => 'white', 'icon' => 'flag'],
            ['label' => 'Active Mining Hubs', 'val' => '142', 'col' => 'secondary', 'icon' => 'precision_manufacturing'],
            ['label' => 'Global Market Cap', 'val' => '$8.4 Trillion', 'col' => 'primary', 'icon' => 'currency_exchange'],
            ['label' => 'Compliance Rate', 'val' => '92.4%', 'col' => 'secondary', 'icon' => 'verified'],
        ];
     @endphp
     @foreach($stats as $s)
     <div class="bg-[#0D1525] border border-white/5 p-5 rounded-2xl relative overflow-hidden group hover:border-{{ $s['col'] }}/30 transition-all">
         <div class="flex items-center gap-4">
             <div class="w-10 h-10 rounded-lg bg-{{ $s['col'] }}/10 flex items-center justify-center">
                 <span class="material-symbols-outlined text-{{ $s['col'] }} text-xl">{{ $s['icon'] }}</span>
             </div>
             <div>
                 <div class="text-[9px] font-bold text-white/30 uppercase tracking-widest">{{ $s['label'] }}</div>
                 <div class="text-xl font-black text-white font-data-tabular">{{ $s['val'] }}</div>
             </div>
         </div>
         <div class="absolute bottom-0 left-0 h-0.5 bg-{{ $s['col'] }} w-full opacity-20"></div>
     </div>
     @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 h-[650px]">
    
    <!-- MAIN VISUALIZATION AREA -->
    <div class="lg:col-span-9 relative bg-[#0D1525] border border-white/5 rounded-3xl overflow-hidden shadow-2xl">
        
        <!-- WORLD MAP VIEW -->
        <div id="map-container" class="absolute inset-0 transition-opacity duration-500">
             <!-- Pure SVG Stylized MAP Visual -->
             <div id="atlas-map" class="w-full h-full p-10 flex items-center justify-center opacity-60">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg" class="w-full h-full object-contain filter invert opacity-20 grayscale brightness-200" alt="World Map">
                 
                 <!-- Interaction Layer (Floating hotspots) -->
                 <button onclick="inspectCountry('Tanzania')" class="absolute top-1/2 left-[58%] w-4 h-4 bg-secondary rounded-full animate-ping pointer-events-auto cursor-pointer"></button>
                 <button onclick="inspectCountry('Tanzania')" class="absolute top-1/2 left-[58%] w-3 h-3 bg-secondary rounded-full border border-black shadow-[0_0_10px_#4edea3] cursor-pointer group">
                     <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-40 glass-executive p-3 rounded-xl opacity-0 group-hover:opacity-100 transition-all pointer-events-none z-50 border border-secondary/30 scale-90 group-hover:scale-100">
                         <div class="flex justify-between items-center mb-1">
                            <span class="text-[10px] font-bold">🇹🇿 TANZANIA</span>
                            <span class="text-[8px] bg-secondary/20 text-secondary px-1.5 py-0.5 rounded uppercase">Verified</span>
                         </div>
                         <div class="text-[9px] text-white/60 mb-2">Gold • Nickel • Diamonds</div>
                         <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                             <div class="h-full bg-secondary w-[85%]"></div>
                         </div>
                     </div>
                 </button>

                 <button onclick="inspectCountry('Australia')" class="absolute top-[65%] left-[82%] w-3 h-3 bg-primary rounded-full border border-black shadow-[0_0_10px_#adc6ff] cursor-pointer group">
                     <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-40 glass-executive p-3 rounded-xl opacity-0 group-hover:opacity-100 transition-all pointer-events-none z-50 border border-primary/30 scale-90 group-hover:scale-100">
                         <div class="flex justify-between items-center mb-1">
                            <span class="text-[10px] font-bold">🇦🇺 AUSTRALIA</span>
                            <span class="text-[8px] bg-primary/20 text-primary px-1.5 py-0.5 rounded uppercase">Leader</span>
                         </div>
                         <div class="text-[9px] text-white/60 mb-2">Iron • Coal • Uranium</div>
                         <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                             <div class="h-full bg-primary w-[95%]"></div>
                         </div>
                     </div>
                 </button>

                 <button onclick="inspectCountry('Brazil')" class="absolute top-[60%] left-[32%] w-3 h-3 bg-error rounded-full border border-black shadow-[0_0_10px_#ffb4ab] cursor-pointer group">
                     <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-40 glass-executive p-3 rounded-xl opacity-0 group-hover:opacity-100 transition-all pointer-events-none z-50 border border-error/30 scale-90 group-hover:scale-100">
                         <div class="flex justify-between items-center mb-1">
                            <span class="text-[10px] font-bold">🇧🇷 BRAZIL</span>
                            <span class="text-[8px] bg-error/20 text-error px-1.5 py-0.5 rounded uppercase font-black">Anomaly</span>
                         </div>
                         <div class="text-[9px] text-white/60 mb-2">Iron • Niobium • Bauxite</div>
                         <div class="h-1 bg-white/10 rounded-full overflow-hidden">
                             <div class="h-full bg-error w-[40%]"></div>
                         </div>
                     </div>
                 </button>
             </div>

             <!-- Floating Map Controls -->
             <div class="absolute bottom-8 left-8 flex flex-col gap-2">
                 <button class="w-10 h-10 bg-white/5 border border-white/10 rounded-full flex items-center justify-center hover:bg-primary hover:text-black transition-all">
                     <span class="material-symbols-outlined text-lg">add</span>
                 </button>
                 <button class="w-10 h-10 bg-white/5 border border-white/10 rounded-full flex items-center justify-center hover:bg-primary hover:text-black transition-all">
                     <span class="material-symbols-outlined text-lg">remove</span>
                 </button>
             </div>
             
             <div class="absolute top-8 right-8 flex gap-2">
                <div class="flex items-center gap-4 bg-black/40 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10">
                     <div class="flex items-center gap-2">
                         <span class="w-2h-2 w-2 h-2 rounded-full bg-secondary"></span>
                         <span class="text-[9px] font-bold uppercase tracking-widest text-white/60">Compliance High</span>
                     </div>
                     <div class="flex items-center gap-2">
                         <span class="w-2h-2 w-2 h-2 rounded-full bg-primary"></span>
                         <span class="text-[9px] font-bold uppercase tracking-widest text-white/60">Mass Export</span>
                     </div>
                     <div class="flex items-center gap-2">
                         <span class="w-2h-2 w-2 h-2 rounded-full bg-error"></span>
                         <span class="text-[9px] font-bold uppercase tracking-widest text-white/60">Audit Warning</span>
                     </div>
                </div>
             </div>
        </div>

        <!-- TABLE VIEW (HIDDEN BY DEFAULT) -->
        <div id="table-container" class="absolute inset-0 opacity-0 pointer-events-none transition-opacity duration-500 bg-[#0D1525] p-8 overflow-y-auto">
             <div class="flex justify-between items-center mb-8">
                <h3 class="text-lg font-bold text-white uppercase tracking-tighter">Global Mineral Registry</h3>
                <div class="flex gap-2">
                     <input type="text" placeholder="Search Country..." class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-[11px] outline-none focus:border-primary w-64">
                     <button class="px-4 py-2 bg-white/10 border border-white/10 rounded-lg text-[10px] font-bold uppercase tracking-widest">Export Excel</button>
                </div>
             </div>
             <table class="w-full text-left border-collapse">
                 <thead>
                     <tr class="border-b border-white/5 text-[10px] text-white/30 uppercase tracking-[0.2em] font-black">
                         <th class="py-4 px-4 font-black">Country</th>
                         <th class="py-4 px-4 font-black">Top Minerals</th>
                         <th class="py-4 px-4 font-black text-right font-black">Production</th>
                         <th class="py-4 px-4 font-black text-right font-black">Export Value</th>
                         <th class="py-4 px-4 font-black text-center font-black">Compliance</th>
                         <th class="py-4 px-4 font-black text-center font-black">Risk</th>
                     </tr>
                 </thead>
                 <tbody class="text-[12px] font-bold text-white/80">
                     @php
                        $rows = [
                            ['country' => 'Tanzania', 'flag' => '🇹🇿', 'min' => 'Gold, Diamonds', 'prod' => '84.2k Tons', 'val' => '$3.4B', 'comp' => '94%', 'risk' => 'LOW'],
                            ['country' => 'Australia', 'flag' => '🇦🇺', 'min' => 'Iron, Lithium', 'prod' => '240.1k Tons', 'val' => '$12.8B', 'comp' => '98%', 'risk' => 'LOW'],
                            ['country' => 'DR Congo', 'flag' => '🇨🇩', 'min' => 'Cobalt, Copper', 'prod' => '42.8k Tons', 'val' => '$1.2B', 'comp' => '42%', 'risk' => 'HIGH'],
                            ['country' => 'Brazil', 'flag' => '🇧🇷', 'min' => 'Iron, Niobium', 'prod' => '115.4k Tons', 'val' => '$5.6B', 'comp' => '78%', 'risk' => 'MED'],
                        ];
                     @endphp
                     @foreach($rows as $r)
                     <tr class="border-b border-white/5 hover:bg-white/5 cursor-pointer transition-colors" onclick="inspectCountry('{{$r['country']}}')">
                         <td class="py-4 px-4 flex items-center gap-3">
                             <span class="text-lg">{{$r['flag']}}</span>
                             <span class="font-black">{{$r['country']}}</span>
                         </td>
                         <td class="py-4 px-4 text-white/50">{{$r['min']}}</td>
                         <td class="py-4 px-4 text-right font-data-tabular">{{$r['prod']}}</td>
                         <td class="py-4 px-4 text-right font-data-tabular text-secondary">{{$r['val']}}</td>
                         <td class="py-4 px-4 text-center">
                             <div class="inline-flex items-center gap-2">
                                 <div class="w-16 h-1.5 bg-white/5 rounded-full overflow-hidden">
                                     <div class="h-full bg-secondary" style="width: {{$r['comp']}}"></div>
                                 </div>
                                 <span class="text-9 px-1.5 py-0.5">{{$r['comp']}}</span>
                             </div>
                         </td>
                         <td class="py-4 px-4 text-center">
                             <span class="text-[9px] px-2 py-1 rounded {{ $r['risk'] == 'HIGH' ? 'bg-error/20 text-error' : ($r['risk'] == 'LOW' ? 'bg-secondary/20 text-secondary' : 'bg-primary/20 text-primary') }} uppercase">
                                 {{$r['risk']}}
                             </span>
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
        </div>
    </div>

    <!-- ALERT & GLOBAL FILTER SYSTEM -->
    <div class="lg:col-span-3 space-y-6 flex flex-col pb-10">
        
        <!-- GLOBAL FILTER SYSTEM -->
        <div class="bg-[#0D1525] border border-white/5 p-6 rounded-3xl">
             <h3 class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">tune</span> Global Filter System
             </h3>
             <div class="space-y-4">
                 <div>
                    <label class="text-[9px] font-bold text-white/40 uppercase mb-2 block">Mineral Classification</label>
                    <select class="w-full bg-[#1A2235] border border-white/10 rounded-xl px-4 py-2.5 text-[11px] text-white outline-none focus:border-primary">
                        <option>All Minerals</option>
                        <option>Strategic (Gold, Lithium)</option>
                        <option>Industrial (Copper, Iron)</option>
                        <option>Energy (Uranium, Coal)</option>
                    </select>
                 </div>
                 <div>
                    <label class="text-[9px] font-bold text-white/40 uppercase mb-2 block">Risk Tolerance</label>
                    <div class="flex gap-2">
                        <button class="flex-1 py-2 bg-secondary/10 border border-secondary/30 rounded-lg text-[9px] font-bold text-secondary uppercase">Low</button>
                        <button class="flex-1 py-2 bg-white/5 border border-white/10 rounded-lg text-[9px] font-bold text-white/60 uppercase">Med</button>
                        <button class="flex-1 py-2 bg-error/10 border border-error/30 rounded-lg text-[9px] font-bold text-error uppercase">High</button>
                    </div>
                 </div>
             </div>
        </div>

        <!-- ALERT SYSTEM (GLOBAL VIEW) -->
        <div class="bg-[#0D1525] border border-white/5 p-6 rounded-3xl flex-1">
             <h3 class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-error animate-pulse">crisis_alert</span> Live Atlas Alerts
             </h3>
             <div class="space-y-4 pr-1 overflow-y-auto custom-scrollbar">
                 @php
                    $alerts = [
                        ['title' => 'Congo Anomaly', 'msg' => 'Suspicious cobalt volume in Sector 4', 'level' => 'HIGH'],
                        ['title' => 'Price Shock', 'msg' => 'Lithium surge +42% in Latin America', 'level' => 'MED'],
                        ['title' => 'License Expired', 'msg' => '14 Active mines in Ghana reporting violations', 'level' => 'MED'],
                    ];
                 @endphp
                 @foreach($alerts as $a)
                 <div class="p-4 bg-white/5 border-l-2 {{ $a['level'] == 'HIGH' ? 'border-error' : 'border-primary' }} rounded-r-xl group cursor-pointer hover:bg-white/10 transition-all">
                     <div class="text-[11px] font-bold text-white group-hover:text-primary transition-colors uppercase">{{ $a['title'] }}</div>
                     <p class="text-[9px] text-white/40 mt-1 leading-relaxed">{{ $a['msg'] }}</p>
                     <div class="flex gap-2 mt-3">
                         <button class="text-[8px] font-black text-secondary uppercase tracking-tight underline">Investigate</button>
                         <button class="text-[8px] font-black text-error uppercase tracking-tight underline ml-2">Block trade</button>
                     </div>
                 </div>
                 @endforeach
             </div>
        </div>
    </div>
</div>

<!-- COUNTRY DETAIL PANEL (DRILL DOWN SLIDE-OUT) -->
<div id="country-panel" class="fixed top-0 right-0 h-full w-[450px] bg-[#0A101E]/95 backdrop-blur-2xl border-l border-white/10 z-[100] translate-x-full transition-transform duration-500 shadow-2xl flex flex-col">
    <div class="p-8 border-b border-white/5 flex justify-between items-center">
         <div class="flex items-center gap-4">
             <span class="text-3xl" id="panel-flag">🇹🇿</span>
             <div>
                <h2 class="text-2xl font-black text-white tracking-tighter" id="panel-country">Tanzania</h2>
                <div class="text-[9px] font-bold text-white/30 uppercase tracking-[0.2em]">National Intelligence Report</div>
             </div>
         </div>
         <button onclick="closePanel()" class="w-10 h-10 bg-white/5 hover:bg-error rounded-full flex items-center justify-center transition-all group">
             <span class="material-symbols-outlined text-white/40 group-hover:text-white">close</span>
         </button>
    </div>
    <div class="flex-1 overflow-y-auto p-8 space-y-8 custom-scrollbar">
        <!-- Overview -->
        <div class="grid grid-cols-2 gap-4">
             <div class="p-4 bg-white/5 rounded-2xl border border-white/5 text-center">
                 <div class="text-[9px] font-bold text-white/30 uppercase mb-1">GDP Contribution</div>
                 <div class="text-xl font-black text-secondary">24.2%</div>
             </div>
             <div class="p-4 bg-white/5 rounded-2xl border border-white/5 text-center">
                 <div class="text-[9px] font-bold text-white/30 uppercase mb-1">Reserves Value</div>
                 <div class="text-xl font-black text-primary">$412B</div>
             </div>
        </div>

        <!-- Mineral Breakdown -->
        <div>
             <h4 class="text-[10px] font-bold text-white/30 uppercase tracking-widest mb-4">Mineral Wealth Distribution</h4>
             <div class="space-y-4">
                 @php $mins = [['n'=>'Gold', 'p' => 45, 'c'=>'secondary'], ['n'=>'Nickel', 'p' => 30, 'c'=>'primary'], ['n'=>'Diamonds', 'p' => 15, 'c'=>'white'], ['n'=>'Others', 'p' => 10, 'c'=>'white/20']]; @endphp
                 @foreach($mins as $m)
                 <div class="flex items-center gap-4">
                     <span class="text-[11px] font-bold text-white/80 w-16">{{$m['n']}}</span>
                     <div class="flex-1 h-2 bg-white/5 rounded-full overflow-hidden">
                         <div class="h-full bg-{{$m['c']}}" style="width: {{$m['p']}}%"></div>
                     </div>
                     <span class="text-[11px] font-bold text-white/40 w-10 text-right">{{$m['p']}}%</span>
                 </div>
                 @endforeach
             </div>
        </div>

        <!-- Compliance & Licensing -->
        <div class="p-6 bg-white/5 border border-white/10 rounded-3xl">
             <h4 class="text-[10px] font-bold text-white/30 uppercase tracking-widest mb-6">Compliance Integrity</h4>
             <div class="space-y-4 text-[11px] font-bold uppercase">
                 <div class="flex justify-between">
                     <span class="text-white/40">Active Approved Licenses</span>
                     <span class="text-secondary">1,242</span>
                 </div>
                 <div class="flex justify-between border-t border-white/5 pt-4">
                     <span class="text-white/40">Open Violations</span>
                     <span class="text-error">04</span>
                 </div>
                 <div class="flex justify-between border-t border-white/5 pt-4">
                     <span class="text-white/40">Environmental Score</span>
                     <span class="text-primary text-sm font-black">AAA+</span>
                 </div>
             </div>
        </div>
    </div>
    <div class="p-8 border-t border-white/5 flex flex-col gap-3">
         <button id="download-btn" onclick="downloadDossier()" class="w-full py-4 bg-primary text-black font-black text-[11px] uppercase tracking-widest rounded-2xl hover:brightness-110 transition-all flex items-center justify-center gap-3 active:scale-95">
             <span id="download-icon" class="material-symbols-outlined text-lg">download</span>
             <span id="download-text">Download dossier (PDF)</span>
         </button>
         <a href="/intelligence-map" class="w-full py-4 bg-white/5 border border-white/10 text-white font-black text-[11px] uppercase tracking-widest rounded-2xl hover:border-secondary transition-all flex items-center justify-center gap-3">
             <span class="material-symbols-outlined text-lg">public</span> Open GIS Mining Map
         </a>
    </div>
</div>

<script>
    function updateAtlasTime() {
        const now = new Date();
        document.getElementById('atlas-clock').textContent = now.toLocaleTimeString('en-GB') + ' GMT+3';
    }
    setInterval(updateAtlasTime, 1000);
    updateAtlasTime();

    // Country Database Simulation for Search
    const countryMinerals = {
        'tanzania': { name: 'Tanzania', flag: '🇹🇿', minerals: ['Gold', 'Nickel', 'Diamonds'], breakdown: [45, 30, 15] },
        'australia': { name: 'Australia', flag: '🇦🇺', minerals: ['Iron Ore', 'Lithium', 'Coal'], breakdown: [60, 25, 10] },
        'brazil': { name: 'Brazil', flag: '🇧🇷', minerals: ['Iron', 'Niobium', 'Bauxite'], breakdown: [50, 20, 20] },
        'congo': { name: 'DR Congo', flag: '🇨🇩', minerals: ['Cobalt', 'Copper', 'Diamonds'], breakdown: [40, 40, 15] },
        'south africa': { name: 'South Africa', flag: '🇿🇦', minerals: ['Platinum', 'Gold', 'Coal'], breakdown: [35, 30, 25] }
    };

    function handleGlobalSearch() {
        const query = document.getElementById('global-country-search').value.toLowerCase().trim();
        if (countryMinerals[query]) {
            inspectCountryFromData(countryMinerals[query]);
        } else {
            alert('Intelligence node for "' + query + '" not found in current sector.');
        }
    }

    function inspectCountryFromData(data) {
        document.getElementById('panel-country').textContent = data.name;
        document.getElementById('panel-flag').textContent = data.flag;
        
        // Update minerals display (simulating dynamic content)
        const detailContainer = document.querySelector('#country-panel .space-y-4');
        detailContainer.innerHTML = '';
        
        data.minerals.forEach((min, i) => {
            const perc = data.breakdown[i] || 5;
            detailContainer.innerHTML += `
                 <div class="flex items-center gap-4">
                     <span class="text-[11px] font-bold text-white/80 w-16 uppercase">${min}</span>
                     <div class="flex-1 h-2 bg-white/5 rounded-full overflow-hidden">
                         <div class="h-full bg-${i === 0 ? 'secondary' : 'primary'}" style="width: ${perc}%"></div>
                     </div>
                     <span class="text-[11px] font-bold text-white/40 w-10 text-right font-data-tabular">${perc}%</span>
                 </div>
            `;
        });

        document.getElementById('country-panel').classList.remove('translate-x-full');
    }

    function inspectCountry(name) {
        const key = name.toLowerCase();
        if (countryMinerals[key]) {
            inspectCountryFromData(countryMinerals[key]);
        } else {
            // Fallback for names from table hardcoding
            document.getElementById('panel-country').textContent = name;
            document.getElementById('country-panel').classList.remove('translate-x-full');
        }
    }

    function closePanel() {
        document.getElementById('country-panel').classList.add('translate-x-full');
    }

    function downloadDossier() {
        const btn = document.getElementById('download-btn');
        const text = document.getElementById('download-text');
        const icon = document.getElementById('download-icon');
        const country = document.getElementById('panel-country').textContent;

        // Visual simulation of compiling data
        btn.classList.add('brightness-50', 'pointer-events-none');
        text.textContent = 'Compiling AI Dossier...';
        icon.textContent = 'sync';
        icon.classList.add('animate-spin');

        setTimeout(() => {
            text.textContent = 'Generating Secure PDF...';
            
            setTimeout(() => {
                text.textContent = 'Dossier Ready';
                icon.textContent = 'check_circle';
                icon.classList.remove('animate-spin');
                
                // Trigger an actual file download (demo text file used as proxy for PDF)
                const blob = new Blob([`GMITE NATIONAL INTELLIGENCE REPORT\nCOUNTRY: ${country}\nDATE: ${new Date().toLocaleString()}\n\nThis is a generated executive intelligence dossier for internal use only.`], { type: 'text/plain' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = `GMITE_Intelligence_Report_${country}.pdf`;
                document.body.appendChild(a);
                a.click();
                
                setTimeout(() => {
                    text.textContent = 'Download dossier (PDF)';
                    icon.textContent = 'download';
                    btn.classList.remove('brightness-50', 'pointer-events-none');
                }, 2000);
            }, 1000);
        }, 1200);
    }

    function toggleView(mode) {
        const map = document.getElementById('map-container');
        const table = document.getElementById('table-container');
        const btnMap = document.getElementById('btn-map-view');
        const btnTable = document.getElementById('btn-table-view');

        if(mode == 'table') {
            map.classList.add('opacity-0', 'pointer-events-none');
            table.classList.remove('opacity-0', 'pointer-events-none');
            btnTable.classList.add('bg-primary', 'text-black');
            btnTable.classList.remove('text-white/60');
            btnMap.classList.remove('bg-primary', 'text-black');
            btnMap.classList.add('text-white/60');
        } else {
            table.classList.add('opacity-0', 'pointer-events-none');
            map.classList.remove('opacity-0', 'pointer-events-none');
            btnMap.classList.add('bg-primary', 'text-black');
            btnMap.classList.remove('text-white/60');
            btnTable.classList.remove('bg-primary', 'text-black');
            btnTable.classList.add('text-white/60');
        }
    }
</script>

<style>
    .glass-executive {
        background: rgba(13, 21, 37, 0.85);
        backdrop-filter: blur(20px);
    }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #1A263B; border-radius: 4px; }
    .glow-secondary { box-shadow: 0 0 30px rgba(173, 198, 255, 0.15); }
    
    #atlas-map {
        background: radial-gradient(circle at center, #111B30 0%, #0B1220 100%);
    }
</style>
@endsection
