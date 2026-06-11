@extends('layouts.admin')

@section('title', 'GMITE - Identity & Access Management')

@section('content')
<!-- IAM Executive Header -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-6 bg-surface-container-low p-6 rounded-3xl border border-outline-variant/30 shadow-2xl relative overflow-hidden">
    <div class="absolute -top-12 -left-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="flex items-center gap-6 relative z-10">
        <div class="w-16 h-16 bg-surface-container-highest border border-primary/30 rounded-2xl flex items-center justify-center text-primary shadow-xl">
             <span class="material-symbols-outlined text-4xl">fingerprint</span>
        </div>
        <div>
             <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase">Identity & Access Management</h1>
             <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.2em] uppercase mt-1 opacity-70">Sovereign Security Backbone [IAM v4.0]</p>
        </div>
    </div>
    <div class="flex gap-4 relative z-10">
        <button onclick="triggerExecutiveAction('Provision New User')" class="px-6 py-3 bg-primary text-on-primary-container rounded-xl font-black text-[11px] uppercase tracking-widest hover:brightness-110 transition-all flex items-center gap-3 shadow-lg shadow-primary/10">
            <span class="material-symbols-outlined text-lg">person_add</span>
            Provision Identity
        </button>
        <button onclick="triggerExecutiveAction('Global Security Audit')" class="px-6 py-3 bg-surface-container-highest text-on-surface rounded-xl font-black text-[11px] uppercase tracking-widest border border-outline-variant hover:border-primary transition-all flex items-center gap-3">
            <span class="material-symbols-outlined text-lg">policy</span>
            Security Audit
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- User Lifecycle Management -->
    <div class="lg:col-span-8 space-y-8">
        <div class="card-premium p-8 rounded-[40px] relative overflow-hidden group/users">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase flex items-center gap-4">
                    <span class="w-1.5 h-8 bg-primary rounded-full"></span>
                    Verified System Identities
                </h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-lg">search</span>
                        <input type="text" placeholder="Search identities..." class="bg-surface-container-highest border border-outline-variant rounded-full pl-12 pr-6 py-2 text-[11px] font-bold text-on-surface w-64 focus:border-primary outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant/30 text-[10px] font-black text-on-surface-variant uppercase tracking-widest pb-4">
                            <th class="text-left pb-4 font-black">Operator Profile</th>
                            <th class="text-left pb-4 font-black">Clearance Level</th>
                            <th class="text-left pb-4 font-black">Status</th>
                            <th class="text-left pb-4 font-black">Last Access</th>
                            <th class="text-right pb-4 font-black">Protocols</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @php
                            $users = [
                                ['name' => 'Dr. Menard Joseph', 'email' => 'gmiteadmin@gmail.com', 'role' => 'SUPER ADMIN', 'status' => 'ACTIVE', 'last' => '2m ago', 'dept' => 'Executive Office'],
                                ['name' => 'Eng. Vance K.', 'email' => 'vance@gmite.gov.tz', 'role' => 'LAB ANALYST', 'status' => 'ACTIVE', 'last' => '15m ago', 'dept' => 'Laboratory Unit'],
                                ['name' => 'Sarah L.', 'email' => 'sarah@gmite.gov.tz', 'role' => 'GOV INSPECTOR', 'status' => 'SUSPENDED', 'last' => '2d ago', 'dept' => 'Compliance Unit'],
                                ['name' => 'John D.', 'email' => 'john@tradelink.com', 'role' => 'TRADER', 'status' => 'ACTIVE', 'last' => '1h ago', 'dept' => 'Trade Sector'],
                            ];
                        @endphp
                        @foreach($users as $user)
                        <tr class="group/row hover:bg-white/5 transition-colors">
                            <td class="py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-surface-container-highest flex items-center justify-center text-on-surface font-black group-hover/row:bg-primary/20 group-hover/row:text-primary transition-all">
                                        {{ substr($user['name'], 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-black text-on-background uppercase tracking-tight">{{ $user['name'] }}</div>
                                        <div class="text-[10px] text-on-surface-variant font-medium opacity-60">{{ $user['email'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-[10px] font-black text-primary bg-primary/10 px-3 py-1 rounded-full border border-primary/20 tracking-widest uppercase">{{ $user['role'] }}</span>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $user['status'] == 'ACTIVE' ? 'bg-secondary' : 'bg-error' }}"></div>
                                    <span class="text-[10px] font-black {{ $user['status'] == 'ACTIVE' ? 'text-secondary' : 'text-error' }} uppercase">{{ $user['status'] }}</span>
                                </div>
                            </td>
                            <td class="text-[11px] font-bold text-on-surface-variant font-data-tabular">
                                {{ $user['last'] }}
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 hover:text-primary transition-colors"><span class="material-symbols-outlined text-lg">edit_note</span></button>
                                    <button class="p-2 hover:text-error transition-colors"><span class="material-symbols-outlined text-lg">lock_reset</span></button>
                                    <button class="p-2 hover:text-on-surface transition-colors"><span class="material-symbols-outlined text-lg">more_vert</span></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Role & Permission Architecture Matrix -->
        <div class="card-premium p-8 rounded-[40px]">
            <h2 class="text-headline-sm font-black tracking-tight text-on-background uppercase mb-8 flex items-center gap-4">
                <span class="material-symbols-outlined text-primary">security_update_good</span>
                Sovereign Permission Matrix
            </h2>

            <div class="space-y-10">
                @php
                    $modules = [
                        'Laboratory & Science' => ['Register Samples', 'View Results', 'Approve Certification', 'Lab Diagnostics'],
                        'Trade & Export' => ['Manage Market', 'Authorize Export', 'Revenue Oversight', 'Trader Verification'],
                        'System Authority' => ['Manage Identities', 'Modify Roles', 'Global Configuration', 'Audit Log Access'],
                    ];
                @endphp
                @foreach($modules as $module => $perms)
                <div>
                    <h3 class="text-label-caps font-black text-primary tracking-[0.2em] mb-6 uppercase flex items-center gap-3">
                         <span class="w-1 h-3 bg-primary rounded-full"></span>
                         {{ $module }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($perms as $perm)
                        <div class="flex items-center justify-between p-4 bg-surface-container-low border border-outline-variant/30 rounded-2xl group hover:border-primary/50 transition-all cursor-pointer">
                            <span class="text-[10px] font-black text-on-surface uppercase tracking-widest opacity-80 group-hover:opacity-100">{{ $perm }}</span>
                            <div class="w-10 h-5 bg-surface-container-highest rounded-full p-1 relative transition-all group-hover:bg-primary/20">
                                <div class="w-3 h-3 bg-on-surface-variant rounded-full absolute right-1 top-1"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right Sidebar Security Panel -->
    <div class="lg:col-span-4 space-y-8">
        
        <!-- Live Audit Terminal -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] relative overflow-hidden h-[500px] flex flex-col">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <span class="material-symbols-outlined text-6xl">history_edu</span>
            </div>
            <h3 class="text-label-caps font-black text-on-surface-variant mb-8 tracking-[0.3em] uppercase opacity-60">Live Sovereign Logs</h3>
            
            <div class="flex-1 overflow-y-auto space-y-6 custom-scrollbar pr-2">
                @php
                    $logs = [
                        ['user' => 'ADMIN: MENARD J.', 'action' => 'Elevated Role: Lab Tech B', 'time' => '1m ago', 'type' => 'SECURITY'],
                        ['user' => 'SYS: AUTOMATED', 'action' => 'Backup Synchronized - Node 0', 'time' => '5m ago', 'type' => 'CORE'],
                        ['user' => 'INSPECTOR: SARAH L.', 'action' => 'Identity Suspended: Anomaly Detected', 'time' => '1h ago', 'type' => 'ALERT'],
                        ['user' => 'ADMIN: MENARD J.', 'action' => 'Permission Matrix Updated', 'time' => '2h ago', 'type' => 'IAM'],
                        ['user' => 'TRADER: JOHN D.', 'action' => 'Export Authorization Requested', 'time' => '4h ago', 'type' => 'TRADE'],
                    ];
                @endphp
                @foreach($logs as $log)
                <div class="flex gap-4 group">
                    <div class="w-px h-12 bg-white/10 group-hover:bg-primary/50 transition-all relative flex items-center justify-center">
                        <div class="absolute w-2 h-2 rounded-full bg-surface-container-highest border border-white/20 group-hover:bg-primary group-hover:scale-125 transition-all"></div>
                    </div>
                    <div>
                        <div class="text-[7px] font-black text-white/30 uppercase tracking-widest mb-1">{{ $log['user'] }} — {{ $log['time'] }}</div>
                        <div class="text-[11px] font-black text-on-surface group-hover:text-primary transition-colors tracking-tight uppercase">{{ $log['action'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <button class="mt-8 w-full py-3 bg-surface-container-highest border border-outline-variant rounded-xl text-[9px] font-black uppercase tracking-widest text-on-surface hover:text-secondary transition-all">
                Export Immutable Log Archive
            </button>
        </div>

        <!-- Role Hierarchy Architecture -->
        <div class="card-premium p-8 rounded-[40px] border border-secondary/20">
             <h3 class="text-label-caps font-black text-secondary mb-8 tracking-widest uppercase">Institutional Hierarchy</h3>
             <div class="space-y-4">
                 @php
                    $hierarchy = [
                        ['level' => 'LVL 05', 'name' => 'SUPER ADMIN', 'users' => 1, 'col' => 'secondary'],
                        ['level' => 'LVL 04', 'name' => 'SYSTEM DIRECTOR', 'users' => 2, 'col' => 'primary'],
                        ['level' => 'LVL 03', 'name' => 'LABORATORY ANALYST', 'users' => 8, 'col' => 'primary'],
                        ['level' => 'LVL 02', 'name' => 'COMPLIANCE OFFICER', 'users' => 12, 'col' => 'on-surface'],
                        ['level' => 'LVL 01', 'name' => 'EXTERNAL TRADER', 'users' => 124, 'col' => 'on-surface-variant'],
                    ];
                 @endphp
                 @foreach($hierarchy as $h)
                 <div class="p-4 bg-surface-container-high rounded-2xl border border-outline-variant flex justify-between items-center group cursor-default">
                    <div class="flex items-center gap-4">
                        <div class="text-[9px] font-black text-white/30 bg-surface-container-highest px-2 py-1 rounded">{{ $h['level'] }}</div>
                        <div class="text-[10px] font-black text-{{ $h['col'] }} uppercase tracking-widest">{{ $h['name'] }}</div>
                    </div>
                    <div class="text-[10px] font-bold text-on-surface-variant/40 group-hover:text-on-surface-variant transition-colors">{{ $h['users'] }} ID</div>
                 </div>
                 @endforeach
             </div>
        </div>

        <!-- Security Enforcement -->
        <div class="p-6 bg-error/5 border border-error/20 rounded-[32px]">
            <div class="flex items-center gap-3 text-error mb-4">
                 <span class="material-symbols-outlined text-lg">verified_user</span>
                 <span class="text-[10px] font-black uppercase tracking-widest">Enforcement Protocol</span>
            </div>
            <p class="text-[9px] font-bold text-on-surface-variant leading-relaxed opacity-60 uppercase">
                Zero-Trust validation enabled. Permission overrides require dual-factor authorization from a Sovereign Director.
            </p>
        </div>
    </div>
</div>

{{-- custom-scrollbar styles are in public/css/dashboard/shared.css --}}
@endsection
