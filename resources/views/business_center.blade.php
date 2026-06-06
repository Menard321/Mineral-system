@extends('layouts.executive')

@section('title', 'GMITE - Business & Licensing Gateway')

@section('content')
{{-- ─── HEADER ─────────────────────────────────────────────────────────── --}}
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative">
            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-3xl animate-pulse"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-primary/40 rounded-[28px] flex items-center justify-center text-primary shadow-2xl">
                <span class="material-symbols-outlined text-4xl">corporate_fare</span>
            </div>
        </div>
        <div>
            <div class="flex items-center gap-4 mb-1">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Business Gateway</h1>
                <span class="bg-primary/10 text-primary text-[10px] font-black px-3 py-1 rounded-full border border-primary/20 tracking-[0.2em] uppercase">National Registry</span>
            </div>
            <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase opacity-60 font-data-tabular">Mining Business Registration & Licensing Authority [GMITE-BIZ]</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="openModal('registerModal')" class="px-8 py-4 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all flex items-center gap-3 shadow-2xl shadow-primary/20">
            <span class="material-symbols-outlined text-xl">add_business</span>
            Register Company
        </button>
        <button onclick="openModal('licenseModal')" class="px-8 py-4 bg-surface-container-low text-on-surface rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] border border-outline-variant hover:border-primary transition-all flex items-center gap-3">
            <span class="material-symbols-outlined text-xl">badge</span>
            Apply for License
        </button>
    </div>
</div>

{{-- ─── QUICK STATS ─────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-10">
    @php $bStats = [
        ['label'=>'My Companies','val'=>str_pad($stats['companies'] ?? 0, 2, '0', STR_PAD_LEFT),'sub'=>'Active Entities','col'=>'primary','icon'=>'business'],
        ['label'=>'Active Licenses','val'=>str_pad($stats['licenses'] ?? 0, 2, '0', STR_PAD_LEFT),'sub'=>'Valid & Compliant','col'=>'secondary','icon'=>'badge'],
        ['label'=>'Pending Apps','val'=>str_pad($stats['pending'] ?? 0, 2, '0', STR_PAD_LEFT),'sub'=>'Under Review','col'=>'primary','icon'=>'pending_actions'],
        ['label'=>'Compliance','val'=>$stats['compliance'] ?? '0.0','sub'=>'Score /10','col'=>'secondary','icon'=>'fact_check'],
    ]; @endphp
    @foreach($bStats as $s)
    <div class="bg-surface-container-low border border-outline-variant/30 p-6 rounded-[32px] group hover:border-{{ $s['col'] }}/40 transition-all">
        <span class="material-symbols-outlined text-{{ $s['col'] }} text-2xl mb-4 block">{{ $s['icon'] }}</span>
        <div class="text-3xl font-black text-on-background font-data-tabular mb-1">{{ $s['val'] }}</div>
        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest opacity-60">{{ $s['sub'] }}</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- ─── LEFT: COMPANIES + LICENSES ─── --}}
    <div class="lg:col-span-8 space-y-8">

        {{-- My Registered Companies --}}
        <div class="card-premium p-10 rounded-[48px]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-headline-sm font-black uppercase tracking-tight flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-primary rounded-full"></span>
                    Registered Entities
                </h2>
                <button onclick="openModal('registerModal')" class="px-5 py-2.5 bg-surface-container-highest border border-outline-variant rounded-xl text-[9px] font-black uppercase tracking-widest hover:text-primary transition-all">+ New Entity</button>
            </div>
            <div class="space-y-5">
                @if(isset($companies) && count($companies) > 0)
                    @foreach($companies as $c)
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between p-6 bg-surface-container-low border border-outline-variant/30 rounded-3xl group hover:border-{{ $c->status_color }}/40 transition-all gap-6">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 bg-surface-container-highest rounded-2xl border border-outline-variant flex items-center justify-center text-{{ $c->status_color }} group-hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined text-3xl">apartment</span>
                            </div>
                            <div>
                                <div class="text-[14px] font-black text-on-background uppercase tracking-tight">{{ $c->name }}</div>
                                <div class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60 mt-1">REG: {{ $c->reg_number }} &bull; {{ $c->category }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="bg-{{ $c->status_color }}/10 text-{{ $c->status_color }} border border-{{ $c->status_color }}/20 text-[9px] font-black px-4 py-1.5 rounded-full tracking-widest uppercase">{{ strtoupper(str_replace('_', ' ', $c->status)) }}</span>
                            <button class="w-10 h-10 bg-surface-container-highest rounded-xl border border-outline-variant flex items-center justify-center hover:text-primary transition-all">
                                <span class="material-symbols-outlined text-lg">open_in_new</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="p-10 border border-dashed border-outline-variant rounded-3xl text-center opacity-30">
                        <p class="text-[10px] font-black uppercase tracking-widest">No registered companies found</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Licensing Management --}}
        <div class="card-premium p-10 rounded-[48px]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-headline-sm font-black uppercase tracking-tight flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-secondary rounded-full"></span>
                    Licensing Portfolio
                </h2>
                <button onclick="openModal('licenseModal')" class="px-5 py-2.5 bg-surface-container-highest border border-outline-variant rounded-xl text-[9px] font-black uppercase tracking-widest hover:text-secondary transition-all">+ New License</button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-outline-variant/20 text-[10px] font-black text-on-surface-variant uppercase tracking-widest">
                            <th class="text-left pb-4">License</th>
                            <th class="text-left pb-4">Type</th>
                            <th class="text-left pb-4">Expiry</th>
                            <th class="text-right pb-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @if(isset($licenses) && count($licenses) > 0)
                            @foreach($licenses as $l)
                            <tr class="group/row hover:bg-white/5 transition-colors">
                                <td class="py-5">
                                    <div class="text-[12px] font-black text-on-background uppercase">{{ $l->name }}</div>
                                    <div class="text-[9px] font-bold text-on-surface-variant opacity-50 font-data-tabular">{{ $l->license_id }}</div>
                                </td>
                                <td><span class="text-[10px] font-bold text-on-surface-variant uppercase">GOVERNMENT ISSUED</span></td>
                                <td><span class="text-[11px] font-black text-on-background font-data-tabular {{ $l->status == 'expired' ? 'text-error' : '' }}">{{ $l->expires_at ? $l->expires_at->format('M Y') : 'N/A' }}</span></td>
                                <td class="text-right">
                                    <span class="bg-{{ $l->status_color }}/10 text-{{ $l->status_color }} border border-{{ $l->status_color }}/20 text-[9px] font-black px-4 py-1.5 rounded-full">{{ strtoupper(str_replace('_', ' ', $l->status)) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="py-10 text-center opacity-30 text-[10px] font-black uppercase tracking-widest">No licenses found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Registration Workflow Tracker --}}
        <div class="card-premium p-10 rounded-[48px]">
            <h2 class="text-headline-sm font-black uppercase tracking-tight mb-10 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary text-3xl">account_tree</span>
                Pending Application Workflow
            </h2>
            @php $stages = [
                ['label'=>'Submitted','done'=>true], ['label'=>'Identity Verify','done'=>true],
                ['label'=>'Doc Review','done'=>true], ['label'=>'Gov. Review','done'=>false],
                ['label'=>'Compliance','done'=>false], ['label'=>'Approval','done'=>false],
                ['label'=>'Certificate','done'=>false],
            ]; @endphp
            <div class="flex items-center justify-between gap-1 overflow-x-auto pb-4">
                @foreach($stages as $i => $stage)
                    <div class="flex flex-col items-center gap-3 flex-shrink-0">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 {{ $stage['done'] ? 'bg-secondary border-secondary text-black' : 'bg-surface-container-highest border-outline-variant text-on-surface-variant' }} transition-all">
                            <span class="material-symbols-outlined text-[18px]">{{ $stage['done'] ? 'check' : 'radio_button_unchecked' }}</span>
                        </div>
                        <div class="text-[8px] font-black uppercase tracking-widest text-center {{ $stage['done'] ? 'text-secondary' : 'text-on-surface-variant opacity-40' }} max-w-[60px] leading-tight">{{ $stage['label'] }}</div>
                    </div>
                    @if($i < count($stages)-1)
                    <div class="flex-1 h-px {{ $stage['done'] ? 'bg-secondary' : 'bg-outline-variant/30' }} min-w-[20px]"></div>
                    @endif
                @endforeach
            </div>
            <div class="mt-8 p-6 bg-primary/5 border border-primary/20 rounded-3xl flex items-center justify-between">
                <div>
                    <div class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">Action Required</div>
                    <p class="text-[12px] font-bold text-on-surface uppercase">Application APP-20141 is currently under Government Review. Expected: 3–5 business days.</p>
                </div>
                <button class="px-6 py-3 bg-primary text-on-primary-container rounded-xl text-[9px] font-black uppercase tracking-widest hover:brightness-110">Track Status</button>
            </div>
        </div>
    </div>

    {{-- ─── RIGHT SIDEBAR ─── --}}
    <div class="lg:col-span-4 space-y-8">

        {{-- Compliance Score --}}
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[48px] text-center space-y-8">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">National Compliance Score</h3>
            <div class="relative inline-flex items-center justify-center">
                <svg class="w-36 h-36 transform -rotate-90">
                    <circle cx="72" cy="72" r="64" stroke="currentColor" stroke-width="10" fill="transparent" class="text-surface-container-highest"/>
                    <circle cx="72" cy="72" r="64" stroke="currentColor" stroke-width="10" fill="transparent" stroke-dasharray="402.1" stroke-dashoffset="24.1" class="text-secondary transition-all duration-2000"/>
                </svg>
                <div class="absolute text-center">
                    <div class="text-4xl font-black text-on-background font-data-tabular">94</div>
                    <div class="text-[9px] font-black text-secondary uppercase tracking-widest">Certified</div>
                </div>
            </div>
            <div class="space-y-3 text-left">
                @foreach(['Legal Compliance'=>'100%','Environmental'=>'88%','Operational'=>'92%'] as $k=>$v)
                <div class="space-y-1">
                    <div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
                        <span class="text-on-surface-variant">{{ $k }}</span>
                        <span class="text-secondary font-data-tabular">{{ $v }}</span>
                    </div>
                    <div class="h-1 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-secondary" style="width:{{ $v }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] space-y-4">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">Quick Actions</h3>
            @php $qActions = [
                ['label'=>'Upload Doc','icon'=>'upload_file','fn'=>'uploadDoc'],
                ['label'=>'Renew License','icon'=>'autorenew','fn'=>'renewLicense'],
                ['label'=>'View Gov Notices','icon'=>'campaign','fn'=>'govNotices'],
                ['label'=>'Download Certificate','icon'=>'workspace_premium','fn'=>'downloadCert'],
            ]; @endphp
            @foreach($qActions as $qa)
            <button onclick="{{ $qa['fn'] }}()" class="w-full flex items-center gap-4 p-5 bg-surface-container-high border border-outline-variant/30 rounded-2xl group hover:border-primary transition-all">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center border border-primary/20 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">{{ $qa['icon'] }}</span>
                </div>
                <span class="text-[11px] font-black uppercase tracking-widest text-on-surface opacity-80 group-hover:opacity-100">{{ $qa['label'] }}</span>
                <span class="material-symbols-outlined text-lg text-on-surface-variant ml-auto group-hover:text-primary transition-colors">chevron_right</span>
            </button>
            @endforeach
        </div>

        {{-- Expiry Alerts --}}
        <div class="p-8 bg-error/5 border border-error/20 rounded-[40px] space-y-5">
            <h3 class="text-label-caps font-black text-error tracking-[0.3em] uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-lg animate-pulse">notification_important</span>
                Expiry Alerts
            </h3>
            @foreach(['Prospecting License — EXPIRED 31 Dec 2025','Env. Clearance — Expires 30 Jun 2026'] as $alert)
            <div class="p-4 bg-surface-container-low border border-error/10 rounded-2xl">
                <p class="text-[11px] font-black text-on-surface uppercase leading-tight">{{ $alert }}</p>
                <button class="text-[9px] font-black text-error uppercase tracking-widest mt-3">Renew Now →</button>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ─── REGISTER COMPANY MODAL ─── --}}
<div id="registerModal" class="fixed inset-0 z-[200] hidden items-center justify-center p-6 bg-black/80 backdrop-blur-2xl">
    <div class="w-full max-w-2xl bg-[#0C0D10] border border-white/10 rounded-[48px] shadow-2xl relative overflow-y-auto max-h-[90vh] animate-in zoom-in duration-300">
        <div class="p-10 space-y-8">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-on-background uppercase tracking-tighter">Register New Entity</h3>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60 mt-1">Government Mineral Business Registry</p>
                </div>
                <button onclick="closeModal('registerModal')" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-error/20 hover:text-error transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Company Name</label>
                        <input type="text" placeholder="e.g. AngloGold Mining Tanzania Ltd" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Business Category</label>
                        <select class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all">
                            <option>Large Scale Mining</option>
                            <option>Exploration Company</option>
                            <option>Mineral Trading Co.</option>
                            <option>Refinery Company</option>
                            <option>Geological Consultancy</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Business Reg. Number</label>
                        <input type="text" placeholder="TZN-BN-XXXXXX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Tax ID (TIN)</label>
                        <input type="text" placeholder="TIN-XXXXXXXXX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                    </div>
                    <div class="space-y-2 col-span-2">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Official Company Address</label>
                        <input type="text" placeholder="Dar es Salaam, Tanzania" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                    </div>
                </div>

                <div class="p-6 bg-primary/5 border border-primary/20 rounded-3xl">
                    <div class="text-[10px] font-black text-primary uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">upload_file</span>
                        Required Legal Documents
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(['Certificate of Incorporation','Tax Registration Cert.','Business License','Director ID Docs'] as $doc)
                        <label class="flex items-center gap-3 p-4 bg-white/5 rounded-2xl border border-white/10 cursor-pointer hover:border-primary transition-all group">
                            <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary text-xl">attach_file</span>
                            <span class="text-[10px] font-black text-on-surface uppercase">{{ $doc }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button class="w-full py-5 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all shadow-2xl shadow-primary/20">
                    Submit for Government Review
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ─── LICENSE APPLICATION MODAL ─── --}}
<div id="licenseModal" class="fixed inset-0 z-[200] hidden items-center justify-center p-6 bg-black/80 backdrop-blur-2xl">
    <div class="w-full max-w-lg bg-[#0C0D10] border border-white/10 rounded-[48px] shadow-2xl relative animate-in zoom-in duration-300">
        <div class="p-10 space-y-8">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-on-background uppercase tracking-tighter">New License Application</h3>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60 mt-1">Sovereign Licensing Authority</p>
                </div>
                <button onclick="closeModal('licenseModal')" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-error/20 hover:text-error transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">License Type</label>
                    <select class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all">
                        <option>Mining License</option>
                        <option>Prospecting License</option>
                        <option>Exploration License</option>
                        <option>Mineral Dealer License</option>
                        <option>Export Permit</option>
                        <option>Refinery License</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Linked Company</label>
                    <select class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all">
                        <option>AngloGold Mining Tanzania Ltd</option>
                        <option>North Star Exploration Co.</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Operating Region</label>
                    <input type="text" placeholder="e.g. Geita, Mwanza, Dodoma" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Justification / Purpose</label>
                    <textarea rows="3" placeholder="State the operational intent and scope..." class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all resize-none placeholder:text-white/20"></textarea>
                </div>
                <button class="w-full py-5 bg-secondary text-black rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all shadow-secondary/20 shadow-2xl">
                    Submit License Application
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const m = document.getElementById(id);
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function closeModal(id) {
        const m = document.getElementById(id);
        m.classList.add('hidden');
        m.classList.remove('flex');
    }
    // Close on backdrop click
    document.querySelectorAll('[id$="Modal"]').forEach(m => {
        m.addEventListener('click', function(e) {
            if (e.target === m) closeModal(m.id);
        });
    });
    function uploadDoc() { alert('Document Vault — Secure Upload Terminal Initializing...'); }
    function renewLicense() { openModal('licenseModal'); }
    function govNotices() { alert('Government Notices Portal Connecting...'); }
    function downloadCert() { alert('Certificate Download — Generating Cryptographic PDF...'); }
</script>
@endsection
