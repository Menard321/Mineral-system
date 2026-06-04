@extends('layouts.executive')

@section('title', 'GMITE - Mineral Governance')

@section('content')
<div class="flex justify-between items-end mb-6">
    <div>
        <div class="text-label-caps text-primary font-bold mb-1">REGULATORY AUTHORITY</div>
        <h1 class="text-display-lg font-bold text-on-background">Mineral Governance</h1>
    </div>
    <div class="flex gap-3">
        <button class="bg-surface-container-high px-4 py-2 rounded border border-outline-variant text-[11px] font-bold hover:border-primary transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">location_on</span>
            VALIDATE ALL LOCATIONS
        </button>
        <button class="btn-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">ios_share</span>
            EXPORT REGISTRY
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Registry Approval Queue -->
    <div class="lg:col-span-2 space-y-6">
        <div class="card-premium p-6 rounded-xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-headline-sm font-bold flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">approval_delegation</span>
                    Registry Approval Queue
                </h2>
                <span class="bg-tertiary/10 text-tertiary px-3 py-1 rounded-full text-[10px] font-bold border border-tertiary/20">14 PENDING ENTRIES</span>
            </div>

            <div class="space-y-4">
                @php
                    $entries = [
                        ['id' => 'MIN-9281', 'mineral' => 'Spodumene (Lithium)', 'qty' => '1,200 MT', 'location' => 'Wodgina, Australia', 'reported_by' => 'Albemarle Corp'],
                        ['id' => 'MIN-9282', 'mineral' => 'Copper Concentrate', 'qty' => '4,500 MT', 'location' => 'Escondida, Chile', 'reported_by' => 'BHP Group'],
                        ['id' => 'MIN-9283', 'mineral' => 'Refined Gold Bullion', 'qty' => '450 KG', 'location' => 'Geita, Tanzania', 'reported_by' => 'AngloGold Ashanti'],
                    ];
                @endphp
                @foreach($entries as $entry)
                <div class="p-5 bg-surface-container-high border border-outline-variant rounded-xl group hover:border-primary transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-lg bg-surface-container-low border border-outline-variant flex items-center justify-center group-hover:bg-primary/5">
                                <span class="material-symbols-outlined text-primary">diamond</span>
                            </div>
                            <div>
                                <div class="text-[10px] text-primary font-bold">{{ $entry['id'] }}</div>
                                <div class="text-headline-sm font-bold text-on-background">{{ $entry['mineral'] }}</div>
                                <div class="text-[11px] text-on-surface-variant flex items-center gap-1 mt-1">
                                    <span class="material-symbols-outlined text-sm">person</span> Reported by: {{ $entry['reported_by'] }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-headline-sm font-data-tabular font-bold text-on-background">{{ $entry['qty'] }}</div>
                            <div class="text-[11px] text-on-surface-variant">{{ $entry['location'] }}</div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t border-outline-variant/30">
                        <button class="px-4 py-1.5 text-[11px] font-bold text-on-surface-variant hover:text-on-surface flex items-center gap-2">
                             <span class="material-symbols-outlined text-sm">edit</span>
                             EDIT DATA
                        </button>
                         <button class="px-4 py-1.5 text-[11px] font-bold text-error hover:bg-error/10 rounded flex items-center gap-2">
                             <span class="material-symbols-outlined text-sm">close</span>
                             REJECT
                        </button>
                        <button class="px-4 py-1.5 bg-secondary text-on-secondary font-bold text-[11px] rounded flex items-center gap-2 hover:opacity-90">
                             <span class="material-symbols-outlined text-sm">check_circle</span>
                             APPROVE ENTRY
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Extraction monitoring chart area -->
        <div class="card-premium p-6 rounded-xl">
             <h2 class="text-headline-sm font-bold mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">monitor_heart</span>
                Real-Time Extraction Monitoring (Global)
            </h2>
            <div class="h-64 flex items-end gap-2 overflow-hidden px-2 border-b border-l border-outline-variant">
                @for($i=1; $i<=20; $i++)
                    @php $h = rand(20, 100); @endphp
                    <div class="flex-1 bg-primary/20 hover:bg-primary transition-all rounded-t relative group cursor-pointer" style="height: {{ $h }}%">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-surface-container-highest text-[9px] font-bold px-2 py-1 rounded border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                            {{ format_bytes($h * 1000) }} MT
                        </div>
                    </div>
                @endfor
            </div>
            <div class="flex justify-between mt-4 text-[10px] text-on-surface-variant font-bold uppercase">
                <span>00:00 UTC</span>
                <span>Extraction Flow Rate (24h)</span>
                <span>23:59 UTC</span>
            </div>
        </div>
    </div>

    <!-- Right Column: Verification System -->
    <div class="space-y-6">
        <!-- Classification Verification -->
        <div class="bg-surface-container-high border border-outline-variant p-6 rounded-xl">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-4">MINERAL CLASSIFICATION</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-surface-container-low rounded border border-outline-variant">
                    <div class="text-[11px]">
                        <div class="font-bold">UNS-712 (Nickel)</div>
                        <div class="text-secondary">99.8% Purity Verified</div>
                    </div>
                    <span class="material-symbols-outlined text-secondary">verified</span>
                </div>
                <div class="flex items-center justify-between p-3 bg-surface-container-low rounded border border-outline-variant">
                    <div class="text-[11px]">
                        <div class="font-bold">FE-99 (Iron Ore)</div>
                        <div class="text-tertiary">Awaiting Lab Result</div>
                    </div>
                    <span class="material-symbols-outlined text-tertiary">science</span>
                </div>
                 <div class="flex items-center justify-between p-3 bg-surface-container-low rounded border border-outline-variant">
                    <div class="text-[11px]">
                        <div class="font-bold">AU-1K (Gold Slag)</div>
                        <div class="text-error font-bold">DISCREPANCY DETECTED</div>
                    </div>
                    <span class="material-symbols-outlined text-error animate-pulse">priority_high</span>
                </div>
            </div>
            <button class="mt-6 w-full py-2 bg-primary/10 text-primary border border-primary/20 rounded font-bold text-[11px] hover:bg-primary hover:text-on-primary-container transition-colors">RUN RE-CLASSIFICATION AI</button>
        </div>

        <!-- Governance Stats -->
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-xl">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase tracking-widest text-center">Governance Integrity</h3>
            
            <div class="flex justify-center mb-6">
                <!-- Circular Progress SVG -->
                <div class="relative w-32 h-32">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-surface-container-highest"/>
                        <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-secondary" stroke-dasharray="364" stroke-dashoffset="36.4"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center flex-col">
                        <span class="text-2xl font-bold text-on-background">91%</span>
                        <span class="text-[8px] text-on-surface-variant">ACCURACY</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between text-[11px]">
                    <span class="text-on-surface-variant">Validated Mines</span>
                    <span class="font-bold">412 / 456</span>
                </div>
                <div class="flex justify-between text-[11px]">
                    <span class="text-on-surface-variant">Daily Audits</span>
                    <span class="font-bold text-secondary">COMPLETE</span>
                </div>
                <div class="flex justify-between text-[11px]">
                    <span class="text-on-surface-variant">Global Sync Lag</span>
                    <span class="font-bold text-primary">0.04 ms</span>
                </div>
            </div>
        </div>

        <!-- Recent Audit Log -->
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-xl h-64 overflow-hidden relative">
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-4 uppercase">Registry Audit Log</h3>
            <div class="space-y-3 blur-[0.5px] group-hover:blur-none transition-all">
                @foreach(range(1,5) as $i)
                <div class="text-[10px] border-l-2 border-primary pl-3 py-1">
                    <div class="text-on-surface font-bold">SYSTEM: Periodic Sync Success</div>
                    <div class="text-on-surface-variant">Hash: 0x{{ substr(md5($i), 0, 8) }} — 2 mins ago</div>
                </div>
                @endforeach
            </div>
            <div class="absolute bottom-4 left-6 right-6">
                <button class="w-full py-1.5 bg-surface-container-high rounded border border-outline-variant text-[10px] font-bold">FULL AUDIT TRAIL</button>
            </div>
        </div>
    </div>
</div>

@php
    function format_bytes($val) {
        return number_format($val);
    }
@endphp
@endsection