@extends('layouts.admin')

@section('title', 'GMITE - System Configuration')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div class="flex items-center gap-5">
        <div class="w-14 h-14 bg-surface-container-high border border-outline-variant rounded-2xl flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-3xl">settings_suggest</span>
        </div>
        <div>
            <h1 class="text-display-lg font-bold text-on-background tracking-tighter">System Configuration</h1>
            <p class="text-body-md text-on-surface-variant uppercase tracking-widest text-[10px] font-bold">Root Environment Control Console</p>
        </div>
    </div>
    <div class="flex gap-3">
         <button class="bg-surface-container-high px-6 py-2.5 rounded-xl border border-outline-variant text-[11px] font-bold hover:bg-surface-container-highest transition-all uppercase tracking-widest flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">history</span>
            Config History
        </button>
        <button class="btn-primary flex items-center gap-2 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-sm">save</span>
            Save All Changes
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-20">
    <div class="lg:col-span-2 space-y-8">
        <!-- API & Integration -->
        <div class="card-premium p-8 rounded-3xl">
            <h2 class="text-headline-sm font-bold mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">api</span>
                API & External Integrations
            </h2>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Gateway Endpoint</label>
                        <input type="text" value="https://api.gmite-ecosystem.gov/v4/secure" class="w-full bg-surface-container-high border border-outline-variant rounded-lg p-3 text-xs font-data-tabular text-primary outline-none focus:border-primary transition-all"/>
                    </div>
                     <div class="space-y-2">
                        <label class="text-[10px] font-bold text-on-surface-variant uppercase tracking-wider">Authentication Protocol</label>
                        <select class="w-full bg-surface-container-high border border-outline-variant rounded-lg p-3 text-xs font-bold text-on-surface outline-none">
                            <option>mTLS (Government Grade)</option>
                            <option>OAuth 2.1 + PKCE</option>
                            <option>LDAP / Active Directory</option>
                        </select>
                    </div>
                </div>

                <div class="p-4 bg-surface-container-low border border-outline-variant/30 rounded-xl flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded bg-secondary/10 flex items-center justify-center text-secondary border border-secondary/20 font-bold text-[10px]">UP</div>
                        <div>
                            <div class="text-[11px] font-bold text-on-background uppercase">World Bank Data Sync</div>
                            <div class="text-[10px] text-on-surface-variant">Last successful heartbeat: 42s ago</div>
                        </div>
                    </div>
                    <button class="text-[10px] font-bold text-primary px-3 py-1 hover:bg-primary/10 rounded">RE-SYNC</button>
                </div>
            </div>
        </div>

        <!-- Security Policies -->
        <div class="card-premium p-8 rounded-3xl relative overflow-hidden">
            <div class="absolute right-0 top-0 p-8">
                 <span class="material-symbols-outlined text-error opacity-10 text-6xl">verified_user</span>
            </div>
            <h2 class="text-headline-sm font-bold mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-error">admin_panel_settings</span>
                Security Enforcement Policies
            </h2>

            <div class="space-y-6">
                <div class="flex items-center justify-between group">
                    <div class="flex-1">
                        <div class="text-[13px] font-bold text-on-background">Multi-Level Institutional Approval</div>
                        <p class="text-[11px] text-on-surface-variant">Require dual-key signature for mineral registry entry approval levels 04 and above.</p>
                    </div>
                    <div class="w-12 h-6 bg-secondary/20 rounded-full relative border border-secondary/30 cursor-pointer">
                         <div class="absolute right-1 top-1 w-4 h-4 bg-secondary rounded-full shadow-[0_0_8px_#4edea3]"></div>
                    </div>
                </div>

                <div class="h-px bg-outline-variant/20"></div>

                <div class="flex items-center justify-between group">
                    <div class="flex-1">
                        <div class="text-[13px] font-bold text-on-background">Global Trade Firewall</div>
                        <p class="text-[11px] text-on-surface-variant">Automatically pause trades exceeding $50M value until manual Level 05 review.</p>
                    </div>
                    <div class="w-12 h-6 bg-secondary/20 rounded-full relative border border-secondary/30 cursor-pointer">
                         <div class="absolute right-1 top-1 w-4 h-4 bg-secondary rounded-full"></div>
                    </div>
                </div>

                <div class="h-px bg-outline-variant/20"></div>

                <div class="flex items-center justify-between group">
                    <div class="flex-1">
                        <div class="text-[13px] font-bold text-on-background text-error">Intrusion Auto-Lockdown</div>
                        <p class="text-[11px] text-on-surface-variant">Revoke all active tokens if brute force threshold is breached in the 0.01% range.</p>
                    </div>
                    <div class="w-12 h-6 bg-error/20 rounded-full relative border border-error/30 cursor-pointer">
                         <div class="absolute right-1 top-1 w-4 h-4 bg-error rounded-full"></div>
                    </div>
                </div>
            </div>
            
            <button class="mt-8 px-6 py-2 bg-error/10 text-error border border-error/20 rounded text-[11px] font-bold uppercase tracking-widest hover:bg-error hover:text-on-error transition-all">Update Security Rules</button>
        </div>
    </div>

    <!-- Maintenance & Database -->
    <div class="space-y-6">
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-3xl">
             <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">database</span>
                Database & Redundancy
             </h3>
             
             <div class="space-y-6">
                <div class="p-4 bg-surface-container-high rounded-2xl border border-outline-variant">
                    <div class="flex justify-between items-center mb-2">
                         <span class="text-[10px] font-bold text-primary uppercase">Postgres Cluster</span>
                         <span class="text-[9px] font-bold text-secondary">ACTIVE</span>
                    </div>
                     <div class="text-lg font-bold text-on-background font-data-tabular">2.4 TB / 10 TB</div>
                     <div class="w-full bg-surface-container-lowest h-1 mt-3 rounded-full overflow-hidden">
                        <div class="h-full bg-primary" style="width: 24%"></div>
                     </div>
                </div>

                 <div class="grid grid-cols-2 gap-3">
                    <button class="py-3 bg-surface-container-highest rounded-xl border border-outline-variant flex flex-col items-center gap-2 group hover:border-primary transition-all">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">backup</span>
                        <span class="text-[9px] font-bold uppercase">Backup Now</span>
                    </button>
                     <button class="py-3 bg-surface-container-highest rounded-xl border border-outline-variant flex flex-col items-center gap-2 group hover:border-tertiary transition-all">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-tertiary transition-colors">restore</span>
                        <span class="text-[9px] font-bold uppercase">Restore</span>
                    </button>
                </div>
             </div>
        </div>

        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-3xl border-l-4 border-l-tertiary">
             <h3 class="text-label-caps font-bold text-tertiary mb-6 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">emergency_home</span>
                Critical System Reset
             </h3>
             <p class="text-[10px] text-on-surface-variant mb-6 leading-relaxed">Resetting the system environment will wipe all temporary caches and re-initialize API handshakes. Use only during major updates.</p>
             <button class="w-full py-2 border border-tertiary/30 text-tertiary rounded text-[10px] font-bold uppercase tracking-widest hover:bg-tertiary hover:text-on-tertiary-container transition-all">Reset System Environment</button>
        </div>

        <div class="card-premium p-6 rounded-3xl flex flex-col items-center text-center">
             <div class="w-16 h-16 rounded-full bg-surface-container-highest flex items-center justify-center mb-4 border border-outline-variant">
                  <span class="material-symbols-outlined text-on-surface-variant">terminal</span>
             </div>
             <div class="text-[11px] font-bold text-on-background uppercase mb-1">Console Access</div>
             <p class="text-[10px] text-on-surface-variant px-4">Remote SSH access is currently locked to approved static IPs only.</p>
             <button class="mt-6 text-[10px] font-bold text-primary hover:underline uppercase">Manage Static IPs</button>
        </div>
    </div>
</div>
@endsection
