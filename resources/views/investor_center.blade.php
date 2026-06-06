@extends('layouts.executive')

@section('title', 'GMITE - Investor Intelligence Hub')

@section('content')
{{-- ─── HEADER ─────────────────────────────────────────────────────────── --}}
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative">
            <div class="absolute inset-0 bg-secondary/20 rounded-2xl blur-3xl animate-pulse"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-secondary/40 rounded-[28px] flex items-center justify-center text-secondary shadow-2xl">
                <span class="material-symbols-outlined text-4xl">trending_up</span>
            </div>
        </div>
        <div>
            <div class="flex items-center gap-4 mb-1">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Investor Intelligence</h1>
                <span class="bg-secondary/10 text-secondary text-[10px] font-black px-3 py-1 rounded-full border border-secondary/20 tracking-[0.2em] uppercase">Market Access</span>
            </div>
            <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase opacity-60 font-data-tabular">National Investment Marketplace & Portfolio Hub [GMITE-INV]</p>
        </div>
    </div>
    <div class="flex flex-wrap gap-4">
        <button onclick="openModal('profileModal')" class="px-8 py-4 bg-secondary text-black rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all flex items-center gap-3 shadow-2xl shadow-secondary/20">
            <span class="material-symbols-outlined text-xl">person_pin_circle</span>
            Investor Profile
        </button>
        <button onclick="openModal('partnerModal')" class="px-8 py-4 bg-surface-container-low text-on-surface rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] border border-outline-variant hover:border-secondary transition-all flex items-center gap-3">
            <span class="material-symbols-outlined text-xl">handshake</span>
            Propose JV
        </button>
    </div>
</div>

{{-- ─── PORTFOLIO KPIs ─────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-10">
    @php $iStats = [
        ['label'=>'Active Investments','val'=>str_pad($stats['investments'] ?? 0, 2, '0', STR_PAD_LEFT),'sub'=>'Portfolio Entities','col'=>'secondary','icon'=>'account_balance'],
        ['label'=>'Total Invested','val'=>$stats['total'] ?? '$0M','sub'=>'Capital Deployed','col'=>'primary','icon'=>'payments'],
        ['label'=>'Opportunities','val'=>str_pad($stats['opps'] ?? 0, 2, '0', STR_PAD_LEFT),'sub'=>'Available Blocks','col'=>'secondary','icon'=>'diamond'],
        ['label'=>'JV Partnerships','val'=>str_pad($stats['jvs'] ?? 0, 2, '0', STR_PAD_LEFT),'sub'=>'Active Ventures','col'=>'primary','icon'=>'handshake'],
    ]; @endphp
    @foreach($iStats as $s)
    <div class="bg-surface-container-low border border-outline-variant/30 p-6 rounded-[32px] group hover:border-{{ $s['col'] }}/40 transition-all">
        <span class="material-symbols-outlined text-{{ $s['col'] }} text-2xl mb-4 block">{{ $s['icon'] }}</span>
        <div class="text-3xl font-black text-on-background font-data-tabular mb-1">{{ $s['val'] }}</div>
        <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest opacity-60">{{ $s['sub'] }}</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- ─── LEFT: OPPORTUNITIES + PORTFOLIO ─── --}}
    <div class="lg:col-span-8 space-y-8">

        <div class="card-premium p-10 rounded-[48px]">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-headline-sm font-black uppercase tracking-tight flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-secondary rounded-full"></span>
                    Investment Opportunities Marketplace
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(isset($opportunities) && count($opportunities) > 0)
                    @foreach($opportunities as $o)
                    <div class="p-8 bg-surface-container-low border border-outline-variant/30 rounded-[32px] group hover:border-secondary/50 transition-all cursor-pointer relative overflow-hidden">
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-secondary/5 rounded-full blur-3xl group-hover:bg-secondary/10 transition-all duration-700"></div>
                        <div class="flex justify-between items-start mb-5">
                            <span class="bg-secondary/10 text-secondary border border-secondary/20 text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest">{{ $o->mineral_type }}</span>
                            <span class="text-[9px] font-bold text-on-surface-variant opacity-50 font-data-tabular">OP-{{ $o->id }}</span>
                        </div>
                        <h3 class="text-[15px] font-black text-on-background uppercase tracking-tight leading-tight mb-3">{{ $o->title }}</h3>
                        <div class="grid grid-cols-2 gap-3 text-[9px] font-bold text-on-surface-variant uppercase mb-6">
                            <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[14px]">location_on</span>{{ $o->location }}</div>
                            <div class="flex items-center gap-2 text-secondary"><span class="material-symbols-outlined text-[14px]">payments</span>${{ number_format($o->estimated_value / 1000000, 1) }}M</div>
                        </div>
                        <div class="flex items-center justify-between pt-5 border-t border-outline-variant/20">
                            <span class="text-[9px] font-bold text-on-surface-variant opacity-40 uppercase">Status: {{ $o->status }}</span>
                            <button class="px-5 py-2.5 bg-secondary/10 text-secondary border border-secondary/20 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-secondary hover:text-black transition-all">Apply Now</button>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-2 py-20 text-center opacity-20 border border-dashed border-outline-variant rounded-[40px]">
                        <p class="text-[10px] font-black uppercase tracking-[.3em]">No Open Opportunities</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Joint Ventures & Partnerships --}}
        <div class="card-premium p-10 rounded-[48px]">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-headline-sm font-black uppercase tracking-tight flex items-center gap-3">
                    <span class="w-1.5 h-8 bg-primary rounded-full"></span>
                    Joint Venture & Partnership Registry
                </h2>
                <button onclick="openModal('partnerModal')" class="px-5 py-2.5 bg-surface-container-highest border border-outline-variant rounded-xl text-[9px] font-black uppercase tracking-widest hover:text-primary transition-all">+ New Proposal</button>
            </div>

            {{-- JV Workflow --}}
            @php $jvStages = ['Proposal Submitted','Partner Review','Gov. Verification','Legal Assessment','Approved','JV Registered'];
            $jvDone = 3; @endphp
            <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8">
                @foreach($jvStages as $i => $stage)
                <div class="flex flex-col items-center gap-2 flex-shrink-0">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 {{ $i < $jvDone ? 'bg-primary border-primary text-black' : 'bg-surface-container-highest border-outline-variant text-on-surface-variant' }}">
                        <span class="material-symbols-outlined text-[18px]">{{ $i < $jvDone ? 'check' : 'radio_button_unchecked' }}</span>
                    </div>
                    <div class="text-[7px] font-black uppercase text-center {{ $i < $jvDone ? 'text-primary' : 'text-on-surface-variant opacity-40' }} max-w-[55px] leading-tight">{{ $stage }}</div>
                </div>
                @if($i < count($jvStages)-1)
                <div class="flex-1 h-px {{ $i < $jvDone-1 ? 'bg-primary' : 'bg-outline-variant/30' }} min-w-[16px]"></div>
                @endif
                @endforeach
            </div>

            <div class="space-y-5">
                @if(isset($applications) && count($applications) > 0)
                    @foreach($applications as $app)
                    <div class="flex items-center justify-between p-6 bg-surface-container-low border border-outline-variant/30 rounded-3xl group hover:border-secondary/40 transition-all">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-surface-container-highest border border-outline-variant rounded-2xl flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
                            </div>
                            <div>
                                <div class="text-[13px] font-black text-on-background uppercase">{{ $app->opportunity->title ?? 'Strategic Project' }}</div>
                                <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-60 mt-1">Application ID: APP-{{ $app->id }}</div>
                            </div>
                        </div>
                        <span class="bg-secondary/10 text-secondary border border-secondary/20 text-[9px] font-black px-4 py-1.5 rounded-full">{{ strtoupper($app->status) }}</span>
                    </div>
                    @endforeach
                @endif

                @if(isset($jvs) && count($jvs) > 0)
                    @foreach($jvs as $jv)
                    <div class="flex items-center justify-between p-6 bg-surface-container-low border border-outline-variant/30 rounded-3xl group hover:border-primary/40 transition-all">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-surface-container-highest border border-outline-variant rounded-2xl flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-2xl">handshake</span>
                            </div>
                            <div>
                                <div class="text-[13px] font-black text-on-background uppercase">{{ $jv->venture_name }}</div>
                                <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-60 mt-1">JV Entity ID: TZ-JV-{{ $jv->id }}</div>
                            </div>
                        </div>
                        <span class="bg-primary/10 text-primary border border-primary/20 text-[9px] font-black px-4 py-1.5 rounded-full">{{ strtoupper(str_replace('_', ' ', $jv->status)) }}</span>
                    </div>
                    @endforeach
                @endif

                @if((!isset($applications) || count($applications) == 0) && (!isset($jvs) || count($jvs) == 0))
                    <div class="p-10 border border-dashed border-outline-variant rounded-3xl text-center opacity-30">
                        <p class="text-[10px] font-black uppercase tracking-widest">No active ventures found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ─── RIGHT: PORTFOLIO + ALERTS ─── --}}
    <div class="lg:col-span-4 space-y-8">

        {{-- Investment Portfolio Performance --}}
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[48px] space-y-8">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">Portfolio Performance</h3>
            <div class="space-y-6">
                @php $portfolio = [
                    ['name'=>'Geita Gold Block','alloc'=>68,'col'=>'secondary','return'=>'+22%'],
                    ['name'=>'Mwanza Lithium Plant','alloc'=>22,'col'=>'primary','return'=>'+18%'],
                    ['name'=>'Copper Export Rights','alloc'=>10,'col'=>'on-surface-variant','return'=>'+8%'],
                ]; @endphp
                @foreach($portfolio as $p)
                <div class="space-y-2">
                    <div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
                        <span class="text-on-surface">{{ $p['name'] }}</span>
                        <span class="text-{{ $p['col'] }} font-data-tabular">{{ $p['alloc'] }}%</span>
                    </div>
                    <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                        <div class="h-full bg-{{ $p['col'] }} transition-all duration-[2000ms]" style="width:{{ $p['alloc'] }}%"></div>
                    </div>
                    <div class="text-[9px] font-bold text-{{ $p['col'] }} uppercase tracking-widest">{{ $p['return'] }} est. return</div>
                </div>
                @endforeach
            </div>

            <div class="p-6 bg-surface-container-highest rounded-[32px] border border-white/5">
                <div class="text-[9px] font-black text-on-surface-variant uppercase tracking-widest opacity-50 mb-2">Total Portfolio ROI</div>
                <div class="text-4xl font-black text-secondary font-data-tabular">+19.4%</div>
                <div class="text-[9px] font-bold text-on-surface-variant uppercase mt-2 opacity-40">Across all active investments</div>
            </div>
        </div>

        {{-- Investor Alerts --}}
        <div class="card-premium p-8 rounded-[40px] border border-secondary/20 space-y-6">
            <h3 class="text-label-caps font-black text-secondary tracking-[0.2em] uppercase flex items-center gap-3">
                <span class="material-symbols-outlined text-lg">campaign</span>
                Investment Alerts
            </h3>
            @php $iAlerts = [
                ['msg'=>'New Government Auction Block available in Dodoma Region.','type'=>'OPPORTUNITY'],
                ['msg'=>'Partnership request from Vance Mining Group awaiting response.','type'=>'JV REQUEST'],
                ['msg'=>'Gov. incentive: 3-year tax holiday for Rare Earth investors.','type'=>'INCENTIVE'],
            ]; @endphp
            @foreach($iAlerts as $a)
            <div class="p-5 bg-surface-container-low border border-outline-variant/20 rounded-2xl group cursor-pointer hover:border-secondary transition-all">
                <div class="text-[8px] font-black text-secondary uppercase tracking-widest mb-2">{{ $a['type'] }}</div>
                <p class="text-[11px] font-bold text-on-surface uppercase leading-tight">{{ $a['msg'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Gov. Incentives Panel --}}
        <div class="p-8 bg-primary/5 border border-primary/20 rounded-[40px] space-y-5">
            <h3 class="text-label-caps font-black text-primary tracking-[0.3em] uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">savings</span>
                Government Incentives
            </h3>
            @foreach(['3-Year Tax Holiday (Rare Earth)','Customs Duty Waiver on Machinery','Guaranteed Repatriation of Profits'] as $inc)
            <div class="flex items-center gap-4 p-4 bg-surface-container-low border border-primary/10 rounded-2xl">
                <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                <span class="text-[11px] font-black text-on-surface uppercase">{{ $inc }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ─── INVESTOR PROFILE MODAL ─── --}}
<div id="profileModal" class="fixed inset-0 z-[200] hidden items-center justify-center p-6 bg-black/80 backdrop-blur-2xl">
    <div class="w-full max-w-lg bg-[#0C0D10] border border-white/10 rounded-[48px] shadow-2xl relative animate-in zoom-in duration-300">
        <div class="p-10 space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-on-background uppercase tracking-tighter">Investor Profile</h3>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60 mt-1">GMITE Investment Registry</p>
                </div>
                <button onclick="closeModal('profileModal')" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-error/20 hover:text-error transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
            <div class="space-y-4">
                @php $iFields = [['Investor Full Name','person'],['Nationality','flag'],['Organization / Fund','business'],['Capital Available (USD)','payments'],['Preferred Minerals','diamond'],['Preferred Regions','location_on']]; @endphp
                @foreach($iFields as [$label, $icon])
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">{{ $label }}</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-white/20 text-lg">{{ $icon }}</span>
                        <input type="text" class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-5 py-4 text-sm font-bold text-on-background focus:border-secondary outline-none transition-all">
                    </div>
                </div>
                @endforeach
                <button class="w-full py-5 bg-secondary text-black rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all shadow-secondary/20 shadow-2xl mt-4">
                    Register as Sovereign Investor
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ─── JV PARTNER PROPOSAL MODAL ─── --}}
<div id="partnerModal" class="fixed inset-0 z-[200] hidden items-center justify-center p-6 bg-black/80 backdrop-blur-2xl">
    <div class="w-full max-w-lg bg-[#0C0D10] border border-white/10 rounded-[48px] shadow-2xl relative animate-in zoom-in duration-300">
        <div class="p-10 space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-on-background uppercase tracking-tighter">JV Partnership Proposal</h3>
                    <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60 mt-1">Sovereign Joint Venture Registry</p>
                </div>
                <button onclick="closeModal('partnerModal')" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-error/20 hover:text-error transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
            <div class="space-y-4">
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Venture Name</label>
                    <input type="text" placeholder="e.g. Tanzania Gold Extraction JV" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none placeholder:text-white/20">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Your Equity %</label>
                        <input type="number" placeholder="51" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none placeholder:text-white/20">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Partner Equity %</label>
                        <input type="number" placeholder="49" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none placeholder:text-white/20">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Partner Company / Investor Name</label>
                    <input type="text" placeholder="Proposed JV Partner" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none placeholder:text-white/20">
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Investment Objective</label>
                    <textarea rows="3" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-on-background focus:border-primary outline-none resize-none placeholder:text-white/20" placeholder="Describe the operational and investment intent..."></textarea>
                </div>
                <button class="w-full py-5 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all shadow-primary/20 shadow-2xl">
                    Submit for Government Approval
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
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }
    document.querySelectorAll('[id$="Modal"]').forEach(m => {
        m.addEventListener('click', e => { if (e.target === m) closeModal(m.id); });
    });
</script>
@endsection
