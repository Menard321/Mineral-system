@extends('layouts.admin')

@section('title', 'GMITE - System Governance & Settings')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Governance Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-surface-container-low border border-primary/30 rounded-2xl flex items-center justify-center text-primary shadow-2xl relative overflow-hidden group">
                 <div class="absolute inset-0 bg-primary/5 animate-pulse"></div>
                 <span class="material-symbols-outlined text-4xl relative z-10 group-hover:rotate-90 transition-transform duration-700">settings</span>
            </div>
            <div>
                 <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">System Governance</h1>
                 <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase mt-2 opacity-60">National Configuration Engine [SID-880]</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
             <button onclick="triggerExecutiveAction('Cloud Backup Initiation')" class="px-6 py-3 bg-primary/10 text-primary border border-primary/30 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-all flex items-center gap-3">
                <span class="material-symbols-outlined text-sm">cloud_upload</span>
                Manual Backup
             </button>
             <button onclick="triggerExecutiveAction('High Security Commit')" class="px-6 py-3 bg-primary text-on-primary-container rounded-xl font-black text-[10px] uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all flex items-center gap-3 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-sm">save</span>
                Commit Changes
             </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Sidebar Settings Nav -->
        <div class="lg:col-span-3 space-y-2">
            @php
                $sections = [
                    ['id' => 'core', 'label' => 'Core Logistics', 'icon' => 'dynamic_form'],
                    ['id' => 'security', 'label' => 'Auth & Security', 'icon' => 'gpp_good'],
                    ['id' => 'integrations', 'label' => 'API Integrations', 'icon' => 'hub'],
                    ['id' => 'workflow', 'label' => 'Workflow Engine', 'icon' => 'schema'],
                    ['id' => 'modules', 'label' => 'Module Control', 'icon' => 'view_module'],
                    ['id' => 'backup', 'label' => 'Disaster Recovery', 'icon' => 'settings_backup_restore'],
                ];
            @endphp
            @foreach($sections as $s)
            <div class="flex items-center gap-4 px-6 py-4 rounded-2xl cursor-pointer transition-all {{ $s['id'] == 'core' ? 'bg-primary/10 text-primary border border-primary/20 shadow-lg' : 'text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface' }}" onclick="scrollToSection('{{ $s['id'] }}')">
                <span class="material-symbols-outlined text-xl">{{ $s['icon'] }}</span>
                <span class="text-[11px] font-black uppercase tracking-widest">{{ $s['label'] }}</span>
            </div>
            @endforeach
            
            <div class="pt-10 px-6">
                <div class="p-6 bg-error/5 border border-error/20 rounded-3xl">
                    <h4 class="text-[9px] font-black text-error uppercase tracking-widest mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[14px]">history_edu</span> Change Registry
                    </h4>
                    <p class="text-[8px] font-bold text-on-surface-variant leading-relaxed uppercase opacity-60">All modifications are cryptographically logged with SID-880 auth signature.</p>
                </div>
            </div>
        </div>

        <!-- Main Configuration Panel -->
        <div class="lg:col-span-9 space-y-12 pb-32 h-[800px] overflow-y-auto pr-6 custom-scrollbar scroll-smooth">
            
            <!-- CORE LOGISTICS -->
            <section id="core" class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                    <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase">Core System Logistics</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Government System Name</label>
                        <input type="text" class="form-input" value="GMITE Executive Terminal">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sovereign Organization</label>
                        <input type="text" class="form-input" value="Ministry of Minerals - Tanzania">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Base Economic Currency</label>
                        <select class="form-input">
                            <option>TSH (Tanzanian Shilling)</option>
                            <option>USD (United States Dollar)</option>
                            <option>EUR (Euro)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Regional System Timezone</label>
                        <select class="form-input">
                            <option>EAT (East Africa Time) - GMT+3</option>
                            <option>CAT (Central Africa Time)</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- AUTH & SECURITY -->
            <section id="security" class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-secondary rounded-full"></div>
                    <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase">Security Enforcement Policy</h2>
                </div>
                <div class="bg-surface-container-low p-8 rounded-[40px] border border-outline-variant/30 space-y-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black text-secondary uppercase tracking-[0.2em]">Authentication Protocols</h3>
                            <div class="space-y-4">
                                <label class="flex items-center justify-between p-4 bg-surface-container-high rounded-2xl transition-all cursor-pointer hover:bg-secondary/10 group">
                                    <span class="text-[11px] font-bold text-on-surface uppercase tracking-widest opacity-80 group-hover:opacity-100">Enforce Multi-Factor (MFA)</span>
                                    <div class="w-10 h-5 bg-secondary/20 rounded-full relative p-1"><div class="absolute right-1 top-1 w-3 h-3 bg-secondary rounded-full shadow-lg"></div></div>
                                </label>
                                <label class="flex items-center justify-between p-4 bg-surface-container-high rounded-2xl transition-all cursor-pointer hover:bg-secondary/10 group">
                                    <span class="text-[11px] font-bold text-on-surface uppercase tracking-widest opacity-80 group-hover:opacity-100">Zero-Trust IP Whitelisting</span>
                                    <div class="w-10 h-5 bg-secondary/20 rounded-full relative p-1"><div class="absolute right-1 top-1 w-3 h-3 bg-secondary rounded-full shadow-lg"></div></div>
                                </label>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <h3 class="text-[10px] font-black text-secondary uppercase tracking-[0.2em]">Session Governance</h3>
                            <div class="form-group">
                                <label class="form-label">Auto-Lock Session Timeout</label>
                                <select class="form-input">
                                    <option>15 Minutes (High Security)</option>
                                    <option>30 Minutes</option>
                                    <option>1 Hour</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- API INTEGRATIONS -->
            <section id="integrations" class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-primary rounded-full"></div>
                    <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase">Sovereign API Gateways</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $apis = [
                            ['name' => 'Lab-XRF Node', 'status' => 'CONNECTED', 'sync' => '2m ago', 'col' => 'secondary'],
                            ['name' => 'Customs-Link', 'status' => 'STANDBY', 'sync' => '1h ago', 'col' => 'primary'],
                            ['name' => 'Gov-Notify SMS', 'status' => 'ERROR', 'sync' => 'Check Logs', 'col' => 'error'],
                        ];
                    @endphp
                    @foreach($apis as $api)
                    <div class="p-6 bg-surface-container-low border border-outline-variant rounded-3xl group cursor-pointer hover:border-{{ $api['col'] }} transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <div class="w-10 h-10 bg-surface-container-highest rounded-xl flex items-center justify-center text-on-surface-variant group-hover:text-{{ $api['col'] }} transition-all">
                                <span class="material-symbols-outlined text-xl">hub</span>
                            </div>
                            <span class="bg-{{ $api['col'] }}/10 text-{{ $api['col'] }} text-[7px] font-black px-2 py-1 rounded border border-{{ $api['col'] }}/20">{{ $api['status'] }}</span>
                        </div>
                        <div class="text-[12px] font-black text-on-background uppercase mb-1">{{ $api['name'] }}</div>
                        <div class="text-[8px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60">Last Sync: {{ $api['sync'] }}</div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- MODULE CONTROL -->
            <section id="modules" class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-error rounded-full"></div>
                    <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase">System Module Governance</h2>
                </div>
                <div class="bg-surface-container-high p-8 rounded-[40px] border border-outline-variant/30">
                    <p class="text-[10px] font-black text-error uppercase tracking-[0.2em] mb-8 animate-pulse">CRITICAL: Toggling modules affects national operations.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(['Laboratory HUB', 'Trade Market', 'Intelligence Map', 'Compliance Center', 'Executive Dashboard', 'Audit Terminal'] as $module)
                        <label class="p-6 bg-surface-container-low border border-outline-variant rounded-3xl flex items-center justify-between cursor-pointer group hover:border-primary transition-all">
                             <span class="text-[11px] font-black text-on-surface uppercase tracking-widest">{{ $module }}</span>
                             <div class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-white/5 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-on-surface-variant/40 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-container peer-checked:after:bg-primary"></div>
                             </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- DISASTER RECOVERY -->
            <section id="backup" class="space-y-8 mb-20">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-secondary rounded-full"></div>
                    <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase">Sovereign Recovery & Backup</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-8 bg-surface-container-low border border-white/5 rounded-[40px] relative overflow-hidden group">
                        <div class="absolute inset-0 bg-secondary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <h3 class="text-lg font-black text-on-background uppercase tracking-tighter mb-4">Daily Backup Cycle</h3>
                        <div class="flex items-baseline gap-2 mb-6">
                            <div class="text-3xl font-black text-secondary font-data-tabular">24H</div>
                            <div class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Interval Active</div>
                        </div>
                        <p class="text-[10px] text-on-surface-variant font-bold leading-relaxed opacity-60 uppercase tracking-wide mb-8">
                            Automated synchronization with national mineral cloud storage. Next sync in 04:12:00.
                        </p>
                        <button class="px-8 py-3 bg-secondary text-on-secondary-container rounded-xl font-black text-[10px] uppercase tracking-widest hover:brightness-110 transition-all">Config Schedule</button>
                    </div>
                    <div class="p-8 bg-surface-container-low border border-white/5 rounded-[40px] space-y-6">
                        <h3 class="text-lg font-black text-on-background uppercase tracking-tighter">Disaster Recovery Mode</h3>
                        <div class="flex items-center gap-4 text-error">
                            <span class="material-symbols-outlined text-4xl animate-pulse">lock_person</span>
                            <div class="text-[10px] font-black uppercase tracking-widest leading-loose">
                                Activating this locks all external traffic and launches the system from the latest SID-Certified snapshot.
                            </div>
                        </div>
                        <button class="w-full py-4 border-2 border-dashed border-error/40 text-error rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-error hover:text-white transition-all">Launch Recovery Protocol</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

{{-- Form + scrollbar styles are in public/css/dashboard/admin.css --}}

<script>
    function scrollToSection(id) {
        document.getElementById(id).scrollIntoView({behavior: 'smooth'});
    }
</script>
@endsection
