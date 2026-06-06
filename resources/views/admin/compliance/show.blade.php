@extends('layouts.admin')

@section('title', 'NMCE-CC | Case Detail ' . $case->case_id)

@section('content')
<style>
    .evidence-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); transition: all 0.3s; }
    .evidence-card:hover { border-color: rgba(173,198,255,0.2); background: rgba(255,255,255,0.04); }
    .action-btn { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
    .action-btn:hover { filter: brightness(1.2); transform: translateY(-2px); }
</style>

<div class="max-w-7xl mx-auto space-y-10 pb-20">
    <!-- Case Header -->
    <div class="flex items-center gap-8 justify-between border-b border-white/5 pb-10">
        <div class="flex items-center gap-8">
            <a href="{{ route('admin.compliance') }}" class="w-14 h-14 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition-all group">
                <span class="material-symbols-outlined text-white/40 group-hover:text-white">arrow_back</span>
            </a>
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <span class="text-[10px] font-black text-primary uppercase tracking-[.4em]">{{ $case->case_id }}</span>
                    <span class="bg-{{ $case->risk_color }}/10 text-{{ $case->risk_color }} text-[9px] font-black px-3 py-1 rounded-full border border-{{ $case->risk_color }}/30 uppercase tracking-widest">RISK: {{ $case->risk_level }} ({{ number_format($case->risk_score, 0) }}%)</span>
                </div>
                <h1 class="text-4xl font-black text-white tracking-tighter uppercase leading-none">{{ $case->company->name }} Investigation</h1>
            </div>
        </div>
        <div class="text-right">
             <div class="text-[11px] font-black text-white uppercase tracking-widest mb-1">{{ $case->status }}</div>
             <p class="text-[9px] text-white/20 font-bold uppercase tracking-[0.2em]">Lifecycle Stage: 0{{ array_search($case->status, ['OPEN', 'INVESTIGATION', 'REVIEW', 'DECISION', 'CLOSED']) + 1 }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-6 bg-secondary/10 border border-secondary/20 rounded-3xl text-secondary text-[11px] font-black uppercase tracking-widest animate-in slide-in-from-top duration-500">
             {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main Case Data -->
        <div class="lg:col-span-8 space-y-12">
            
            <!-- 📁 2. VIEW CASE DETAILS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-8 bg-surface-container-high rounded-[40px] border border-white/5">
                    <h3 class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] mb-6">Subject Profile</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-white/5 pb-3">
                             <span class="text-[10px] font-bold text-white/40 uppercase">Reg Number</span>
                             <span class="text-[10px] font-black text-white">{{ $case->company->reg_number }}</span>
                        </div>
                        <div class="flex justify-between border-b border-white/5 pb-3">
                             <span class="text-[10px] font-bold text-white/40 uppercase">Category</span>
                             <span class="text-[10px] font-black text-white">{{ $case->company->category }}</span>
                        </div>
                        <div class="flex justify-between border-b border-white/5 pb-3">
                             <span class="text-[10px] font-bold text-white/40 uppercase">Assigned Officer</span>
                             <span class="text-[10px] font-black text-secondary">{{ $case->officer->full_name ?? 'PENDING' }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-surface-container-high rounded-[40px] border border-white/5">
                    <h3 class="text-[10px] font-black text-white/30 uppercase tracking-[.3em] mb-6">Timeline Analysis</h3>
                    <div class="space-y-4 text-[10px] font-bold uppercase tracking-widest leading-loose">
                        <div class="flex gap-4">
                             <span class="text-primary font-black">01</span> Case Initiated: {{ $case->opened_at->format('M d, Y H:i:s') }}
                        </div>
                        <div class="flex gap-4">
                             <span class="text-white/20 font-black">02</span> Last Risk Update: {{ $case->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🧪 3. VIEW EVIDENCE -->
            <div class="space-y-6">
                 <div class="flex justify-between items-center">
                    <h2 class="text-lg font-black text-white uppercase tracking-tight">Forensic Evidence Ledger</h2>
                    <button onclick="document.getElementById('evidence-modal').classList.remove('hidden')" class="px-6 py-2 bg-primary/10 text-primary border border-primary/20 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-black transition-all">
                        Attach Evidence
                    </button>
                 </div>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                     @forelse($case->evidence as $e)
                     <div class="evidence-card p-6 rounded-[32px] flex items-center gap-6">
                         <div class="w-12 h-12 bg-surface-container-highest rounded-xl flex items-center justify-center text-primary border border-white/5">
                             <span class="material-symbols-outlined">{{ $e->document_type == 'IMAGE' ? 'image' : 'description' }}</span>
                         </div>
                         <div class="flex-1 overflow-hidden">
                             <div class="text-[11px] font-black text-white uppercase truncate">{{ $e->document_type }} — {{ basename($e->file_path) }}</div>
                             <div class="text-[8px] font-bold text-white/20 uppercase tracking-widest mt-1">SIG: {{ substr($e->file_hash, 0, 16) }}...</div>
                         </div>
                         <a href="{{ Storage::url($e->file_path) }}" target="_blank" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white/40 hover:text-white transition-all">
                             <span class="material-symbols-outlined text-sm">visibility</span>
                         </a>
                     </div>
                     @empty
                     <div class="col-span-2 py-12 text-center border border-dashed border-white/5 rounded-[40px] opacity-20">
                         <p class="text-[10px] font-black uppercase tracking-[0.3em]">No forensic evidence documented</p>
                     </div>
                     @endforelse
                 </div>
            </div>

            <!-- Violation History -->
            <div class="card-premium p-10 rounded-[48px]">
                 <h2 class="text-lg font-black text-white uppercase tracking-tight mb-8">Violation Registry</h2>
                 <div class="space-y-4">
                     @foreach($case->violations as $v)
                     <div class="p-6 bg-surface-container-low border border-white/5 rounded-3xl flex justify-between items-center group">
                         <div class="flex items-center gap-6">
                             <span class="material-symbols-outlined text-{{ $v->severity == 'CRITICAL' ? 'error animate-pulse' : 'primary' }}">report_problem</span>
                             <div>
                                 <div class="text-[11px] font-black text-white uppercase mb-1">{{ $v->violation_type }}</div>
                                 <div class="text-[9px] font-bold text-white/30 uppercase leading-relaxed">{{ $v->description }}</div>
                             </div>
                         </div>
                         <span class="bg-{{ $v->severity == 'CRITICAL' ? 'error' : 'primary' }}/10 text-[9px] font-black px-4 py-2 border border-white/10 rounded-xl uppercase tracking-widest text-{{ $v->severity == 'CRITICAL' ? 'error' : 'primary' }}">{{ $v->severity }}</span>
                     </div>
                     @endforeach
                 </div>
            </div>
        </div>

        <!-- Enforcement Action Panel -->
        <div class="lg:col-span-4 space-y-8">
            <div class="p-10 bg-error/5 border border-error/10 rounded-[48px] h-fit">
                <h3 class="text-[10px] font-black text-error uppercase tracking-[.4em] mb-12 flex items-center gap-3">
                    <span class="material-symbols-outlined text-[16px]">security</span> Enforcement Control
                </h3>
                
                <div class="grid grid-cols-1 gap-4">
                    <!-- 4. ISSUE WARNING -->
                    <form action="{{ route('admin.compliance.action', $case->id) }}" method="POST">
                        @csrf <input type="hidden" name="action_type" value="ISSUE_WARNING">
                        <button class="action-btn w-full p-6 bg-surface-container-high border border-white/10 rounded-3xl flex items-center justify-between group hover:border-blue-400">
                             <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-blue-400">warning</span>
                                <span class="text-[11px] font-black text-white uppercase tracking-widest">Issue Warning</span>
                             </div>
                             <span class="material-symbols-outlined text-white/10 group-hover:text-white">chevron_right</span>
                        </button>
                    </form>

                    <!-- 5. RESTRICT ACTIVITY -->
                    <form action="{{ route('admin.compliance.action', $case->id) }}" method="POST">
                        @csrf <input type="hidden" name="action_type" value="RESTRICT_ACTIVITY">
                        <button class="action-btn w-full p-6 bg-surface-container-high border border-white/10 rounded-3xl flex items-center justify-between group hover:border-orange-400">
                             <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-orange-400">block</span>
                                <span class="text-[11px] font-black text-white uppercase tracking-widest">Restrict Activity</span>
                             </div>
                             <span class="material-symbols-outlined text-white/10 group-hover:text-white">chevron_right</span>
                        </button>
                    </form>

                    <!-- 6. SUSPEND LICENSE -->
                    <form action="{{ route('admin.compliance.action', $case->id) }}" method="POST">
                        @csrf <input type="hidden" name="action_type" value="SUSPEND_LICENSE">
                        <button class="action-btn w-full p-6 bg-error/10 border border-error/20 rounded-3xl flex items-center justify-between group hover:bg-error hover:text-black">
                             <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined">gpp_maybe</span>
                                <span class="text-[11px] font-black uppercase tracking-widest">Suspend License</span>
                             </div>
                             <span class="material-symbols-outlined text-white/10 group-hover:text-black">chevron_right</span>
                        </button>
                    </form>

                    <!-- 7. BLOCK EXPORT -->
                    <form action="{{ route('admin.compliance.action', $case->id) }}" method="POST">
                        @csrf <input type="hidden" name="action_type" value="BLOCK_EXPORT">
                        <button class="action-btn w-full p-6 bg-error text-black rounded-3xl flex items-center justify-between shadow-2xl shadow-error/20">
                             <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined">ship</span>
                                <span class="text-[11px] font-black uppercase tracking-widest">Block Export</span>
                             </div>
                             <span class="material-symbols-outlined">lock</span>
                        </button>
                    </form>

                    <div class="h-px bg-white/5 my-6"></div>

                    <!-- 8. ESCALATE TO MOCC -->
                    <form action="{{ route('admin.compliance.action', $case->id) }}" method="POST">
                        @csrf <input type="hidden" name="action_type" value="ESCALATE_TO_MOCC">
                        <button class="action-btn w-full py-5 bg-white/5 border border-white/10 rounded-2xl text-[10px] font-black text-white uppercase tracking-widest hover:bg-secondary hover:text-black">
                             Escalate to National Oversight (MOCC)
                        </button>
                    </form>

                    <!-- 12. CLOSE CASE -->
                    <form action="{{ route('admin.compliance.action', $case->id) }}" method="POST">
                        @csrf <input type="hidden" name="action_type" value="CLOSE_CASE">
                        <button class="action-btn w-full py-5 text-white/40 text-[10px] font-black uppercase tracking-widest hover:text-white">
                             Close Investigation Archive
                        </button>
                    </form>
                </div>

                <div class="mt-12 p-6 bg-black/40 border border-white/5 rounded-3xl">
                     <div class="flex items-center gap-4 mb-3">
                         <span class="material-symbols-outlined text-primary text-sm">psychology</span>
                         <span class="text-[9px] font-black text-primary uppercase tracking-widest">Decision engine</span>
                     </div>
                     <p class="text-[9px] text-white/40 font-bold leading-relaxed uppercase tracking-wider">
                         Compliance score is below threshold ({{ number_format($case->risk_score, 1) }}%). System recommending manual license suspension and MOCC escalation.
                     </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Evidence Modal -->
<div id="evidence-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-2xl flex items-center justify-center p-6">
    <div class="w-full max-w-lg card-premium p-10 rounded-[48px] animate-in zoom-in duration-300">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-xl font-black text-white uppercase tracking-tight">Attach Forensic Evidence</h3>
            <button onclick="document.getElementById('evidence-modal').classList.add('hidden')" class="w-10 h-10 rounded-full bg-white/5 border border-white/10 text-white/40 flex items-center justify-center hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form action="{{ route('admin.compliance.evidence', $case->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                 <label class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-4 block">Evidence Type</label>
                 <select name="document_type" class="w-full bg-black/40 border border-white/10 rounded-2xl p-5 text-[12px] text-white focus:border-primary outline-none">
                     <option value="LAB_REPORT">Lab Forensic Report</option>
                     <option value="EXPORT_DOC">Trade Document</option>
                     <option value="IMAGE">Site Image / GPS Data</option>
                     <option value="INSPECTOR_REPORT">Official Inspector Memo</option>
                 </select>
            </div>
            <div>
                 <label class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-4 block">Select File</label>
                 <input type="file" name="evidence_file" class="w-full bg-black/40 border border-white/10 rounded-2xl p-5 text-[12px] text-white outline-none">
            </div>
            <div>
                 <label class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-4 block">Legal Description</label>
                 <textarea name="description" rows="3" class="w-full bg-black/40 border border-white/10 rounded-2xl p-5 text-[12px] text-white focus:border-primary outline-none" placeholder="Provide context for this evidence record..."></textarea>
            </div>
            <button type="submit" class="w-full py-5 bg-primary text-black font-black text-[11px] uppercase tracking-widest rounded-2xl hover:brightness-110 active:scale-95 transition-all shadow-2xl shadow-primary/20">
                Lock Evidence Entry
            </button>
        </form>
    </div>
</div>
@endsection
