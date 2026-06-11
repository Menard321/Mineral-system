@extends('layouts.admin')

@section('title', 'NMCE-CC | Compliance Enforcement')

@section('content')
{{-- Styles: public/css/pages/compliance.css (loaded via admin layout) --}}

<div class="space-y-10">
    <!-- Header -->
    <div class="flex justify-between items-end">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="material-symbols-outlined text-primary">gavel</span>
                <span class="text-[10px] font-black text-primary uppercase tracking-[.4em]">NMCE-CC Control Center</span>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase leading-none">Compliance Enforcement</h1>
        </div>
        <div class="flex gap-4">
             <div class="bg-surface-container-high border border-outline-variant px-6 py-3 rounded-2xl">
                 <div class="text-[8px] font-black text-white/30 uppercase tracking-widest mb-1">Active Investigations</div>
                 <div class="text-xl font-black text-white font-data-tabular">{{ $stats['active'] }}</div>
             </div>
             <div class="bg-error/10 border border-error/20 px-6 py-3 rounded-2xl">
                 <div class="text-[8px] font-black text-error/60 uppercase tracking-widest mb-1">Critical Threats</div>
                 <div class="text-xl font-black text-error font-data-tabular">{{ $stats['critical'] }}</div>
             </div>
        </div>
    </div>

    <!-- Live Anomaly Radar & New Case -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 card-premium p-10 rounded-[48px] relative overflow-hidden">
             <div class="flex justify-between items-center mb-10">
                 <h2 class="text-xl font-black text-white uppercase tracking-tight">Active Enforcement Ledger</h2>
                 <div class="flex gap-4">
                      <button class="p-3 rounded-xl bg-white/5 border border-white/10 text-white/40 hover:text-white transition-all">
                          <span class="material-symbols-outlined">filter_list</span>
                      </button>
                      <button class="p-3 rounded-xl bg-white/5 border border-white/10 text-white/40 hover:text-white transition-all">
                          <span class="material-symbols-outlined">search</span>
                      </button>
                 </div>
             </div>

             <div class="space-y-4">
                 @forelse($cases as $case)
                 <div onclick="window.location='{{ route('admin.compliance.show', $case->id) }}'" class="case-card p-6 rounded-[32px] bg-black/20 flex flex-col md:flex-row justify-between items-center gap-8 cursor-pointer">
                     <div class="flex items-center gap-6">
                         <div class="w-14 h-14 rounded-2xl bg-surface-container-highest border border-outline-variant flex items-center justify-center">
                             <span class="material-symbols-outlined text-white/40 group-hover:text-primary transition-colors">folder_open</span>
                         </div>
                         <div>
                             <div class="flex items-center gap-3 mb-1">
                                 <span class="text-[9px] font-black text-primary-fixed uppercase tracking-widest">{{ $case->case_id }}</span>
                                 <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                                 <span class="risk-badge bg-{{ $case->risk_color }}/10 text-{{ $case->risk_color }}">RISK: {{ $case->risk_level }}</span>
                             </div>
                             <div class="text-[13px] font-black text-white uppercase">{{ $case->company->name }}</div>
                             <div class="text-[9px] font-bold text-white/30 uppercase mt-1">Assigned to: {{ $case->officer->full_name ?? 'Unassigned' }}</div>
                         </div>
                     </div>

                     <div class="flex items-center gap-10">
                         <div class="text-right">
                             <div class="text-[9px] font-black text-white uppercase mb-1 flex items-center justify-end">
                                 <span class="status-dot bg-{{ $case->status == 'CLOSED' ? 'secondary' : 'primary' }}"></span>
                                 {{ $case->status }}
                             </div>
                             <div class="text-[8px] font-bold text-white/20 uppercase tracking-widest">Last Updated: {{ $case->updated_at->diffForHumans() }}</div>
                         </div>
                         <span class="material-symbols-outlined text-white/10">chevron_right</span>
                     </div>
                 </div>
                 @empty
                 <div class="py-20 text-center border border-dashed border-white/5 rounded-[40px]">
                     <span class="material-symbols-outlined text-4xl text-white/10 mb-4">fact_check</span>
                     <p class="text-[10px] font-black text-white/20 uppercase tracking-widest">No active compliance cases found</p>
                 </div>
                 @endforelse
             </div>
        </div>

        <div class="space-y-8">
            <!-- Initiate New Case -->
            <div class="card-premium p-10 rounded-[48px] bg-primary/5 border-primary/20">
                <h3 class="text-lg font-black text-white uppercase mb-6">Initiate Case</h3>
                
                @if($errors->any())
                    <div class="mb-6 p-4 bg-error/10 border border-error/20 rounded-2xl">
                        @foreach($errors->all() as $error)
                            <p class="text-[9px] font-black text-error uppercase tracking-widest">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.compliance.create') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                         <label class="text-[9px] font-black text-white/30 uppercase tracking-[.2em] mb-3 block">Domestic Entity</label>
                         <select name="company_id" class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-[11px] text-white focus:border-primary outline-none">
                             <option value="" disabled selected>— Select Target Company —</option>
                             @foreach(\App\Models\Company::all() as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                             @endforeach
                         </select>
                    </div>
                    <button class="w-full py-5 bg-primary text-black font-black text-[10px] uppercase tracking-widest rounded-2xl hover:brightness-110 transition-all shadow-2xl shadow-primary/20">
                        Launch Investigation
                    </button>
                    <p class="text-[8px] text-white/30 font-bold leading-relaxed text-center uppercase tracking-wider">
                        Unauthorized investigations are strictly logged under Level 4 auditing.
                    </p>
                </form>
            </div>

            <!-- AI Radar -->
            <div class="bg-error/5 border border-error/10 p-8 rounded-[40px] relative overflow-hidden group">
                <div class="relative z-10">
                    <h4 class="text-[10px] font-black text-error uppercase tracking-[.3em] mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] animate-pulse">radar</span> Anomaly Monitor
                    </h4>
                    <div class="space-y-4">
                        <div class="p-4 bg-black/20 rounded-2xl border border-error/5">
                            <div class="text-[8px] font-black text-error uppercase mb-1">REVENUE GAP</div>
                            <p class="text-[9px] font-bold text-white/60 uppercase leading-tight">Valuation mismatch detected for AngloGold Export #821.</p>
                        </div>
                        <div class="p-4 bg-black/20 rounded-2xl border border-error/5">
                            <div class="text-[8px] font-black text-error uppercase mb-1">CERTIFICATE EXPIRED</div>
                            <p class="text-[9px] font-bold text-white/60 uppercase leading-tight">License L-2044 lacks valid environmental clearance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
