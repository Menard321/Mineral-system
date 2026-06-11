@extends('layouts.admin')

@section('title', 'GMITE - Alert & Security Center')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div class="flex items-center gap-5">
        <div class="w-14 h-14 bg-error/10 border border-error/20 rounded-2xl flex items-center justify-center relative">
             <span class="material-symbols-outlined text-error text-3xl">security</span>
             <span class="absolute -top-1 -right-1 w-4 h-4 bg-error text-on-error text-[8px] font-bold rounded-full flex items-center justify-center animate-bounce">12</span>
        </div>
        <div>
            <h1 class="text-display-lg font-bold text-on-background tracking-tighter">Security Center</h1>
            <p class="text-body-md text-on-surface-variant">Global threat monitoring & fraud detection engine.</p>
        </div>
    </div>
    <button class="bg-surface-container-high px-6 py-2.5 rounded border border-outline-variant text-[11px] font-bold hover:border-error transition-all uppercase tracking-widest flex items-center gap-2 text-error">
        <span class="material-symbols-outlined text-sm">emergency</span>
        LOCKDOWN SYSTEM
    </button>
</div>

<!-- Threat Level & Stats -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
     <div class="card-premium p-6 rounded-2xl flex items-center gap-6">
        <div class="relative w-20 h-20 shrink-0">
             <svg class="w-full h-full transform -rotate-90">
                <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="transparent" class="text-surface-container-highest"/>
                <circle cx="40" cy="40" r="36" stroke="currentColor" stroke-width="6" fill="transparent" class="text-error" stroke-dasharray="226" stroke-dashoffset="150"/>
            </svg>
            <div class="absolute inset-0 flex items-center justify-center flex-col">
                <span class="text-xs font-bold text-error">HIGH</span>
            </div>
        </div>
        <div>
            <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1">Current Threat Level</div>
            <div class="text-headline-sm font-bold text-on-background uppercase">Bravo-Six</div>
            <div class="text-[9px] text-on-surface-variant mt-1">Global monitoring active across all trade corridors.</div>
        </div>
     </div>

     <div class="card-premium p-6 rounded-2xl">
        <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-4">Unauthorized Access Attempts</div>
        <div class="flex items-end gap-2 font-data-tabular">
            <span class="text-4xl font-bold text-on-background">1,242</span>
            <span class="text-xs text-error font-bold pb-1 flex items-center gap-1">
                 <span class="material-symbols-outlined text-xs">trending_up</span> +24%
            </span>
        </div>
        <div class="text-[9px] text-on-surface-variant mt-2 uppercase tracking-wide">Last 24 hours — mostly proxy redirections.</div>
     </div>

     <div class="card-premium p-6 rounded-2xl">
        <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-4">ML Fraud Probabilities</div>
        <div class="flex items-end gap-2 font-data-tabular">
            <span class="text-4xl font-bold text-on-background">0.04%</span>
            <span class="text-xs text-secondary font-bold pb-1">NOMINAL</span>
        </div>
        <div class="text-[9px] text-on-surface-variant mt-2 uppercase tracking-wide">Detection engine operating at peak efficiency.</div>
     </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
     <!-- Critical Security Alerts -->
     <div class="card-premium p-6 rounded-2xl border-l-4 border-l-error">
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-outline-variant/30">
            <h2 class="text-headline-sm font-bold text-on-background">System Anomalies & Alerts</h2>
             <button class="text-xs font-bold text-primary hover:underline uppercase">View Full Log</button>
        </div>

        <div class="space-y-4">
             @php
                $alerts = [
                    ['title' => 'Suspicious Mineral Weight Discrepancy', 'id' => 'SEC-4921', 'party' => 'Central African Trade Hub', 'risk' => 'CRITICAL', 'time' => '14m ago'],
                    ['title' => 'Brute Force Attempt: Admin API', 'id' => 'SEC-4918', 'party' => 'IP: 142.12.8.2xx', 'risk' => 'HIGH', 'time' => '1h ago'],
                    ['title' => 'Vessel AIS Signal Masking', 'id' => 'SEC-4902', 'party' => 'MV Oceanic Titan', 'risk' => 'MEDIUM', 'time' => '3h ago'],
                ];
            @endphp
            @foreach($alerts as $alert)
            <div class="p-5 bg-surface-container-high border border-outline-variant rounded-xl group hover:border-error transition-all relative overflow-hidden">
                <div class="absolute right-0 top-0 h-full w-1 bg-{{ $alert['risk'] == 'CRITICAL' ? 'error' : ($alert['risk'] == 'HIGH' ? 'tertiary' : 'warning') }} transition-all opacity-30 group-hover:opacity-100"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-4">
                         <div class="w-10 h-10 rounded bg-error/10 flex items-center justify-center text-error border border-error/20">
                            <span class="material-symbols-outlined text-sm">warning</span>
                        </div>
                        <div>
                             <div class="text-[9px] font-bold text-error uppercase tracking-widest">{{ $alert['risk'] }} DETECTION</div>
                             <div class="text-lg font-bold text-on-background">{{ $alert['title'] }}</div>
                             <div class="text-[10px] text-on-surface-variant flex items-center gap-1 mt-1 uppercase">
                                ID: {{ $alert['id'] }} • {{ $alert['party'] }}
                             </div>
                        </div>
                    </div>
                    <div class="text-[10px] font-bold text-on-surface-variant whitespace-nowrap">{{ $alert['time'] }}</div>
                </div>
                <div class="flex gap-2 pt-4 border-t border-outline-variant/30">
                     <button class="flex-1 py-1.5 bg-error text-on-error rounded text-[10px] font-bold uppercase tracking-widest hover:opacity-90">Investigate Alert</button>
                     <button class="flex-1 py-1.5 bg-surface-container-lowest border border-error/30 text-error rounded text-[10px] font-bold uppercase tracking-widest hover:bg-error/10">Block Activity</button>
                     <button class="px-3 py-1.5 bg-surface-container-lowest border border-outline-variant rounded text-[10px] font-bold uppercase tracking-widest">Mark Safe</button>
                </div>
            </div>
            @endforeach
        </div>
     </div>

     <!-- Security Infrastructure & Logs -->
     <div class="space-y-8">
         <div class="bg-surface-container-low border border-outline-variant p-6 rounded-2xl">
              <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 flex items-center gap-2 uppercase">
                <span class="material-symbols-outlined text-sm text-primary">terminal</span>
                Infrastructure Integrity Log
             </h3>
             <div class="bg-surface-container-lowest rounded-lg border border-outline-variant p-4 font-data-tabular text-[10px] text-on-surface-variant space-y-2 h-72 overflow-y-auto custom-scrollbar">
                 @foreach(range(1,20) as $i)
                    @php $ip = rand(10,255).".".rand(10,255).".".rand(10,255).".".rand(10,255); @endphp
                    <div class="flex gap-3 hover:text-on-surface transition-colors cursor-default">
                        <span class="text-secondary opacity-60">[{{ date('H:i:s') }}]</span>
                        <span>[INFRA] Connection established from {{ $ip }} (Port {{ rand(1000, 9999) }})</span>
                    </div>
                    <div class="flex gap-3 hover:text-on-surface transition-colors cursor-default">
                         <span class="text-{{ rand(0,5) == 0 ? 'error' : 'primary' }} opacity-60">[{{ date('H:i:s', strtotime('-2 seconds')) }}]</span>
                         <span>[{{ rand(0,5) == 0 ? 'AUTH_FAIL' : 'AUTH_SUCCESS' }}] User Root Access Token Validated - Level 05</span>
                    </div>
                 @endforeach
             </div>
             <button class="mt-4 w-full text-center text-[10px] font-bold text-primary uppercase hover:underline">Download System Security Audit (PDF)</button>
         </div>

         <div class="bg-surface-container-low border border-outline-variant p-6 rounded-2xl relative overflow-hidden">
             <div class="absolute -right-10 -bottom-10 opacity-5 pointer-events-none">
                 <span class="material-symbols-outlined text-[200px]">lock_person</span>
             </div>
             <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase">Escalation Protocols</h3>
             <div class="space-y-4">
                 <div class="flex items-center justify-between p-3 bg-surface-container-high border-l-4 border-error rounded">
                      <div>
                        <div class="text-[11px] font-bold text-on-background">LEVEL 05 ESCALATION</div>
                        <div class="text-[9px] text-on-surface-variant">Notify Interior Ministry & UN Oversight</div>
                      </div>
                      <button class="p-1 px-3 bg-error text-on-error rounded text-[9px] font-bold uppercase">Escalate</button>
                 </div>
                 <div class="flex items-center justify-between p-3 bg-surface-container-high rounded opacity-60">
                      <div>
                        <div class="text-[11px] font-bold text-on-background">Interpol Red Notice Sync</div>
                        <div class="text-[9px] text-on-surface-variant">Automated pattern matching with global watchlists</div>
                      </div>
                      <span class="material-symbols-outlined text-secondary text-sm">sync</span>
                 </div>
             </div>
         </div>
     </div>
</div>

{{-- custom-scrollbar styles are in public/css/dashboard/shared.css --}}
@endsection
