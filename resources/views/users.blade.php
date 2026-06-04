@extends('layouts.admin')

@section('title', 'GMITE - User Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-display-lg font-bold text-primary">Global User Management</h1>
        <p class="text-body-md text-on-surface-variant">Control access and roles across the GMITE ecosystem.</p>
    </div>
    <div class="flex gap-3">
        <button class="w-10 h-10 bg-surface-container-high border border-outline-variant rounded flex items-center justify-center hover:text-primary transition-colors">
            <span class="material-symbols-outlined">manage_search</span>
        </button>
        <button class="w-10 h-10 bg-surface-container-high border border-outline-variant rounded flex items-center justify-center hover:text-primary transition-colors">
            <span class="material-symbols-outlined">history</span>
        </button>
        <button class="btn-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">person_add</span>
            Create User
        </button>
    </div>
</div>

<!-- User Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-gutter mb-6">
    <div class="card-premium p-4 rounded-xl">
        <div class="text-label-caps text-on-surface-variant mb-1">TOTAL USERS</div>
        <div class="text-headline-md font-bold text-on-background">4,821</div>
    </div>
    <div class="card-premium p-4 rounded-xl">
        <div class="text-label-caps text-on-surface-variant mb-1">PENDING APPROVAL</div>
        <div class="text-headline-md font-bold text-secondary">24</div>
    </div>
    <div class="card-premium p-4 rounded-xl">
        <div class="text-label-caps text-on-surface-variant mb-1">ACTIVE INSPECTORS</div>
        <div class="text-headline-md font-bold text-primary">156</div>
    </div>
    <div class="card-premium p-4 rounded-xl">
        <div class="text-label-caps text-on-surface-variant mb-1">GLOBAL TRADERS</div>
        <div class="text-headline-md font-bold text-tertiary">2,104</div>
    </div>
</div>

<!-- User Directory -->
<div class="card-premium rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-outline-variant bg-surface-container-high flex justify-between items-center">
        <h2 class="text-headline-sm font-bold">User Directory</h2>
        <div class="flex items-center gap-4">
            <div class="bg-surface-container-lowest px-3 py-1 rounded border border-outline-variant flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-on-surface-variant">filter_alt</span>
                <span class="text-[11px] font-bold">ALL ROLES</span>
            </div>
            <div class="bg-surface-container-lowest px-3 py-1 rounded border border-outline-variant flex items-center gap-2 cursor-pointer hover:bg-surface-container-high transition-colors">
                 <span class="text-[11px] font-bold">EXPORT CSV</span>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container-low text-on-surface-variant text-[11px] font-bold uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Identity</th>
                    <th class="px-6 py-4">Assigned Role</th>
                    <th class="px-6 py-4">Auth Level</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Last Activity</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">
                @php
                    $users = [
                        ['name' => 'Dr. Elena Vance', 'email' => 'e.vance@mining-reg.gov', 'role' => 'Inspector', 'auth' => 'LEVEL_04', 'status' => 'ACTIVE', 'activity' => '2 mins ago'],
                        ['name' => 'Marcus Chen', 'email' => 'mchen@globalsolutions.com', 'role' => 'Trader', 'auth' => 'LEVEL_02', 'status' => 'ACTIVE', 'activity' => '1 hour ago'],
                        ['name' => 'Sarah Jenkins', 'email' => 's.jenkins@worldbank.aud', 'role' => 'Auditor', 'auth' => 'LEVEL_05', 'status' => 'PENDING', 'activity' => 'New'],
                        ['name' => 'Karl Schmidt', 'email' => 'kschmidt@minerallab.de', 'role' => 'Laboratory', 'auth' => 'LEVEL_03', 'status' => 'SUSPENDED', 'activity' => '12 days ago'],
                    ];
                @endphp
                @foreach($users as $user)
                <tr class="hover:bg-surface-container-highest transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-surface-container-highest flex items-center justify-center font-bold text-xs border border-outline-variant">
                                {{ substr($user['name'], 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-on-background">{{ $user['name'] }}</div>
                                <div class="text-[10px] text-on-surface-variant">{{ $user['email'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                         <span class="px-2 py-0.5 bg-primary/10 text-primary border border-primary/20 rounded text-[10px] font-bold">{{ $user['role'] }}</span>
                    </td>
                    <td class="px-6 py-4 font-data-tabular text-[11px]">{{ $user['auth'] }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full {{ $user['status'] == 'ACTIVE' ? 'bg-secondary' : ($user['status'] == 'PENDING' ? 'bg-tertiary shadow-[0_0_5px_#ffb3ad]' : 'bg-error') }}"></span>
                            <span class="text-[11px] font-bold {{ $user['status'] == 'ACTIVE' ? 'text-secondary' : ($user['status'] == 'PENDING' ? 'text-tertiary' : 'text-error') }}">
                                {{ $user['status'] }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-[11px] text-on-surface-variant">{{ $user['activity'] }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="w-8 h-8 rounded bg-surface-container-low border border-outline-variant flex items-center justify-center hover:text-primary" title="Edit Role">
                                <span class="material-symbols-outlined text-sm">edit_square</span>
                            </button>
                            @if($user['status'] == 'ACTIVE')
                            <button class="w-8 h-8 rounded bg-surface-container-low border border-outline-variant flex items-center justify-center hover:text-error" title="Suspend User">
                                <span class="material-symbols-outlined text-sm">block</span>
                            </button>
                            @else
                             <button class="w-8 h-8 rounded bg-surface-container-low border border-outline-variant flex items-center justify-center hover:text-secondary" title="Activate User">
                                <span class="material-symbols-outlined text-sm">how_to_reg</span>
                            </button>
                            @endif
                            <button class="w-8 h-8 rounded bg-surface-container-low border border-outline-variant flex items-center justify-center hover:text-primary" title="Activity Log">
                                <span class="material-symbols-outlined text-sm">list_alt</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 flex justify-between items-center text-[11px] text-on-surface-variant px-2">
    <div>Showing 4 of 4,821 enterprise accounts</div>
    <div class="flex gap-2">
        <button class="px-4 py-1 bg-surface-container-high rounded border border-outline-variant hover:bg-surface-container-highest">Previous</button>
        <button class="px-4 py-1 bg-surface-container-high rounded border border-outline-variant hover:bg-surface-container-highest">Next</button>
    </div>
</div>
@endsection
