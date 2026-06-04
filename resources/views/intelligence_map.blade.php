@extends('layouts.executive')

@section('title', 'GMITE - Intelligence Map')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-display-lg font-bold text-on-background tracking-tighter">Global Intelligence Map</h1>
        <p class="text-body-md text-on-surface-variant">Real-time GIS monitoring of mining hotspots, trade routes, and illegal extractions.</p>
    </div>
    <div class="flex gap-3">
        <button class="bg-surface-container-high px-4 py-2 rounded-lg border border-outline-variant text-[11px] font-bold hover:border-primary transition-all flex items-center gap-2 uppercase tracking-wide">
            <span class="material-symbols-outlined text-sm">public</span>
            Switch Country
        </button>
        <button class="btn-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add_location</span>
            Add monitoring zone
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 h-[700px]">
    <!-- GIS Map Area -->
    <div class="lg:col-span-3 card-premium rounded-3xl relative overflow-hidden bg-[#0A0C0F]">
        <!-- Map Overlay UI - Left -->
        <div class="absolute top-6 left-6 z-20 space-y-4">
             <div class="glass p-4 rounded-2xl w-56 border border-outline-variant/30">
                <div class="text-[10px] font-bold text-on-surface-variant uppercase mb-3 tracking-widest leading-none">Map Layers</div>
                <div class="space-y-2">
                    <label class="flex items-center justify-between group cursor-pointer">
                        <span class="text-[11px] font-bold text-on-surface group-hover:text-primary transition-colors uppercase">Active Mines</span>
                        <div class="w-8 h-4 bg-primary/20 rounded-full relative border border-primary/30">
                            <div class="absolute right-0.5 top-0.5 w-2.5 h-2.5 bg-primary rounded-full"></div>
                        </div>
                    </label>
                    <label class="flex items-center justify-between group cursor-pointer opacity-70">
                         <span class="text-[11px] font-bold text-on-surface group-hover:text-primary transition-colors uppercase">Trade Routes</span>
                         <div class="w-8 h-4 bg-surface-container-highest rounded-full relative border border-outline-variant">
                            <div class="absolute left-0.5 top-0.5 w-2.5 h-2.5 bg-on-surface-variant rounded-full"></div>
                        </div>
                    </label>
                    <label class="flex items-center justify-between group cursor-pointer">
                        <span class="text-[11px] font-bold text-on-surface group-hover:text-error transition-colors uppercase">Illegal Hotspots</span>
                        <div class="w-8 h-4 bg-error/20 rounded-full relative border border-error/30">
                             <div class="absolute right-0.5 top-0.5 w-2.5 h-2.5 bg-error rounded-full animate-pulse"></div>
                        </div>
                    </label>
                    <label class="flex items-center justify-between group cursor-pointer opacity-70">
                        <span class="text-[11px] font-bold text-on-surface group-hover:text-secondary transition-colors uppercase">Sustainability</span>
                        <div class="w-8 h-4 bg-surface-container-highest rounded-full relative border border-outline-variant">
                            <div class="absolute left-0.5 top-0.5 w-2.5 h-2.5 bg-on-surface-variant rounded-full"></div>
                        </div>
                    </label>
                </div>
             </div>

             <div class="glass p-4 rounded-2xl w-56 border border-outline-variant/30">
                <div class="text-[10px] font-bold text-on-surface-variant uppercase mb-3 tracking-widest leading-none">Mineral Filter</div>
                <div class="flex flex-wrap gap-1.5">
                    <span class="px-2 py-1 bg-surface-container-highest text-[9px] font-bold rounded border border-primary/20 text-primary uppercase">Gold</span>
                    <span class="px-2 py-1 bg-surface-container-highest text-[9px] font-bold rounded border border-outline-variant text-on-surface-variant uppercase">Lithium</span>
                    <span class="px-2 py-1 bg-surface-container-highest text-[9px] font-bold rounded border border-outline-variant text-on-surface-variant uppercase">Copper</span>
                    <span class="px-2 py-1 bg-surface-container-highest text-[9px] font-bold rounded border border-outline-variant text-on-surface-variant uppercase">Cobalt</span>
                    <span class="px-2 py-1 bg-surface-container-highest text-[9px] font-bold rounded border border-outline-variant text-on-surface-variant uppercase">Diamond</span>
                </div>
             </div>
        </div>

        <!-- Map Overlay UI - Right -->
        <div class="absolute top-6 right-6 z-20 space-y-2">
            <button class="w-10 h-10 glass rounded-full flex items-center justify-center text-on-surface hover:text-primary transition-all shadow-xl">
                 <span class="material-symbols-outlined">zoom_in</span>
            </button>
            <button class="w-10 h-10 glass rounded-full flex items-center justify-center text-on-surface hover:text-primary transition-all shadow-xl">
                 <span class="material-symbols-outlined">zoom_out</span>
            </button>
             <button class="w-10 h-10 glass rounded-full flex items-center justify-center text-on-surface hover:text-primary transition-all shadow-xl">
                 <span class="material-symbols-outlined">my_location</span>
            </button>
        </div>

        <!-- GIS World Map Visual -->
        <div class="w-full h-full relative cursor-crosshair">
            <!-- Simulated GIS Data Visualization -->
            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCW90abDocMFLahoah8XqlR4CP2tDYK0mEW6pYLO5JOaijJav46laf8zxtKGoV4e7qtVy4GbjbKlgNKKO19G0OJJ2CMPtcgadFR2XsIMIH7ks1qqG7X7BaoJJzj7Fw8co-REHOAkorV70VdGobr2JKj8UF5xYb2OT-8TdC5IdF2m0qKp6INkm5Agf-wS5W20mwnnWHEVTSVOXn7nP5hDQi5YEKRV-1pyiLbIcAhsbrJC6dMfkifQf9HQj6Ppg3b6u-EOZrW-XysJbs" class="w-full h-full object-cover opacity-60 grayscale hover:opacity-80 transition-opacity duration-1000"/>
            
            <!-- Floating Hotspots -->
            <div class="absolute top-1/4 left-1/3 w-3 h-3 bg-error rounded-full animate-ping"></div>
            <div class="absolute top-1/4 left-1/3 w-2 h-2 bg-error rounded-full shadow-[0_0_10px_#ffb4ab]"></div>
            
            <div class="absolute bottom-1/3 right-1/4 w-3 h-3 bg-secondary rounded-full animate-pulse shadow-[0_0_15px_#4edea3]"></div>
            <div class="absolute top-1/2 right-1/2 w-2 h-2 bg-primary rounded-full animate-pulse shadow-[0_0_10px_#adc6ff]"></div>

            <!-- Legend Overlay -->
            <div class="absolute bottom-6 left-6 glass px-6 py-4 rounded-2xl border border-outline-variant/30 flex items-center gap-8">
                 <div class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Industrial Sectors</span>
                 </div>
                 <div class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 bg-secondary rounded-full"></div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Low Emission Zone</span>
                 </div>
                 <div class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 bg-error rounded-full"></div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Sanction Risk</span>
                 </div>
            </div>
        </div>
    </div>

    <!-- Map Info Panel -->
    <div class="space-y-6">
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-3xl h-full flex flex-col">
            <div class="flex justify-between items-start mb-6">
                 <h2 class="text-headline-sm font-bold text-on-background">Region Intelligence</h2>
                 <button class="material-symbols-outlined text-sm text-on-surface-variant hover:text-primary">info</button>
            </div>

            <div class="flex-1 space-y-6">
                <!-- Selected Hub View -->
                <div class="space-y-4">
                    <div class="p-4 bg-surface-container-high rounded-xl border border-outline-variant">
                         <div class="text-[10px] font-bold text-primary uppercase tracking-widest mb-1">SELECTED SECTOR</div>
                         <div class="text-lg font-bold text-on-background">Kolwezi Mining Hub</div>
                         <div class="text-[10px] text-on-surface-variant flex items-center gap-1 mt-1 font-data-tabular">
                            <span class="material-symbols-outlined text-[12px]">location_on</span> 10.7187° S, 25.4731° E
                         </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-surface-container-high p-3 rounded-xl border border-outline-variant">
                             <div class="text-[9px] font-bold text-on-surface-variant uppercase mb-1 leading-none">Activity</div>
                             <div class="text-xs font-bold text-secondary uppercase">HIGH_VOLUME</div>
                        </div>
                        <div class="bg-surface-container-high p-3 rounded-xl border border-outline-variant">
                             <div class="text-[9px] font-bold text-on-surface-variant uppercase mb-1 leading-none">Compliance</div>
                             <div class="text-xs font-bold text-on-background">92.4%</div>
                        </div>
                    </div>
                </div>

                <!-- Recent Alerts in Area -->
                <div class="space-y-3">
                     <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest border-b border-outline-variant/30 pb-2">Area Intelligence</div>
                     @php
                        $area_alerts = [
                            ['msg' => 'Truck Conveyor v2 Active', 'time' => '12m ago', 'col' => 'secondary'],
                            ['msg' => 'Lab Verification Success', 'time' => '1h ago', 'col' => 'primary'],
                            ['msg' => 'Anomalous Drill Signal', 'time' => '3h ago', 'col' => 'error'],
                        ];
                    @endphp
                    @foreach($area_alerts as $aa)
                    <div class="flex items-start gap-3 p-2 hover:bg-surface-container-highest rounded transition-colors cursor-pointer group">
                        <div class="w-1 h-8 rounded-full bg-{{ $aa['col'] }} shrink-0"></div>
                        <div>
                            <div class="text-[11px] font-bold text-on-background group-hover:text-{{ $aa['col'] }} transition-colors">{{ $aa['msg'] }}</div>
                            <div class="text-[9px] text-on-surface-variant">{{ $aa['time'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-6 border-t border-outline-variant/30">
                 <button class="w-full py-3 bg-primary text-on-primary-container text-xs font-bold rounded-xl uppercase tracking-widest hover:opacity-90 shadow-lg shadow-primary/10">View Region Analytics</button>
                 <button class="w-full py-3 mt-2 text-on-surface-variant text-[10px] font-bold tracking-widest uppercase hover:text-primary transition-colors">Export GIS Map Data</button>
            </div>
        </div>
    </div>
</div>
@endsection
