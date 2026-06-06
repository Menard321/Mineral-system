@extends('layouts.admin')

@section('title', 'GMITE - Sovereign Sample Registration')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-primary/10 border border-primary/30 rounded-2xl flex items-center justify-center text-primary shadow-xl shadow-primary/5">
                <span class="material-symbols-outlined text-4xl">inventory</span>
            </div>
            <div>
                 <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase">Mineral Sample Intake</h1>
                 <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.2em] uppercase opacity-70">Section 42-B: Legally Traceable Government Registry</p>
            </div>
        </div>
        <div class="flex items-center gap-4 bg-surface-container-low px-6 py-3 rounded-2xl border border-outline-variant/30">
            <div class="text-right">
                <div class="text-[9px] font-black text-white/30 uppercase tracking-widest leading-none">System Status</div>
                <div class="text-[11px] font-black text-secondary uppercase mt-1">Ready for Encoding</div>
            </div>
            <div class="w-2 h-2 rounded-full bg-secondary animate-pulse shadow-[0_0_8px_#4edea3]"></div>
        </div>
    </div>

    <!-- Stepper Navigation -->
    <div class="grid grid-cols-6 gap-2 mb-12" id="stepper">
        @for($i=1; $i<=6; $i++)
        <div class="flex flex-col gap-2 group cursor-pointer" onclick="goToStep({{ $i }})" id="step-nav-{{ $i }}">
            <div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden relative">
                <div class="step-progress absolute inset-0 bg-primary transition-all duration-700 w-0"></div>
            </div>
            <div class="text-[9px] font-black uppercase tracking-widest text-on-surface-variant group-hover:text-primary transition-colors">Phase 0{{ $i }}</div>
        </div>
        @endfor
    </div>

    <!-- Multi-Step Registration Terminal -->
    <form id="registration-terminal" class="space-y-12 pb-32">
        @csrf
        
        <!-- PHASE 01: IDENTITY & LOGISTICS -->
        <div class="step-content animate-in slide-in-from-right-8 duration-700" id="step-1">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-1 space-y-6">
                    <div class="p-8 bg-surface-container-low border border-outline-variant/30 rounded-[32px] relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-24 h-24 bg-primary/5 rounded-full blur-2xl"></div>
                        <h2 class="text-xl font-black text-on-background uppercase tracking-tighter mb-4">Sample Identity</h2>
                        <p class="text-[11px] text-on-surface-variant font-bold leading-relaxed opacity-60 uppercase tracking-wider">
                            The system will automatically link this batch to the national blockchain for full traceability.
                        </p>
                        <div class="mt-8 p-4 bg-white/5 border border-white/10 rounded-xl">
                            <div class="text-[9px] font-black text-primary uppercase mb-1">Generated ID:</div>
                            <div class="text-lg font-black text-white font-data-tabular">GMITE-SMP-2026-{{ rand(100000, 999999) }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Laboratory Reference No.</label>
                        <input type="text" class="form-input" value="LRN-{{ date('Y') }}-XQ92" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Batch Number (Optional)</label>
                        <input type="text" class="form-input" placeholder="Enter batch grouping ID">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Mineral Priority Level</label>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach(['NORMAL', 'URGENT', 'EXPORT PRIORITY'] as $p)
                            <label class="relative flex items-center justify-center p-4 bg-surface-container-high border border-outline-variant rounded-xl cursor-pointer hover:border-primary transition-all overflow-hidden group">
                                <input type="radio" name="priority" value="{{ $p }}" class="hidden peer">
                                <div class="absolute inset-0 bg-primary/10 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                <span class="text-[10px] font-black uppercase tracking-widest relative z-10 group-hover:text-primary transition-colors">{{ $p }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PHASE 02: MINERAL SOURCE -->
        <div class="step-content hidden" id="step-2">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-4 space-y-6">
                    <div class="form-group">
                        <label class="form-label">Mineral Type</label>
                        <select class="form-input">
                            <option>Lithium ORE</option>
                            <option>Gold Dore Bar</option>
                            <option>Diamonds (Raw)</option>
                            <option>Copper Concentrates</option>
                            <option>Nickel Ingots</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mineral Category</label>
                         <select class="form-input">
                            <option>Concentrate</option>
                            <option>Refined</option>
                            <option>Raw Sample</option>
                            <option>Ore</option>
                        </select>
                    </div>
                </div>
                <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Mining Company Name</label>
                        <input type="text" class="form-input" placeholder="As registered in TGMA">
                    </div>
                    <div class="form-group">
                        <label class="form-label">License Number</label>
                        <input type="text" class="form-input" placeholder="TGMA-LIC-XXXX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Origin District / Site</label>
                        <input type="text" class="form-input" placeholder="Name of mine site">
                    </div>
                    <div class="form-group">
                        <label class="form-label">GPS Coordinates (Traceability)</label>
                        <input type="text" class="form-input" placeholder="-6.173, 35.741" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- PHASE 03: PHYSICAL PROPERTIES -->
        <div class="step-content hidden" id="step-3">
             <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="form-group">
                    <label class="form-label">Total Sample Weight</label>
                    <div class="flex">
                        <input type="number" class="form-input !rounded-r-none border-r-0" placeholder="0.00">
                        <select class="form-input !w-32 !rounded-l-none bg-surface-container-high">
                            <option>GRAMS</option>
                            <option>KG</option>
                            <option>TONNES</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Container Quantity</label>
                    <input type="number" class="form-input" placeholder="No. of units/bottles">
                </div>
                <div class="form-group">
                    <label class="form-label">Physical Form</label>
                    <select class="form-input">
                        <option>SOLID (ROCK)</option>
                        <option>POWDER (PULVERIZED)</option>
                        <option>LIQUID (SOLUTION)</option>
                        <option>SLURRY</option>
                    </select>
                </div>
                <div class="form-group md:col-span-3">
                    <label class="form-label">Condition on Arrival</label>
                    <div class="grid grid-cols-5 gap-4">
                        @foreach(['SEALED', 'UNSEALED', 'DAMAGED', 'CONTAMINATED', 'OPTIMAL'] as $c)
                        <label class="flex flex-col items-center p-3 bg-surface-container-high border border-outline-variant rounded-xl cursor-pointer hover:border-primary transition-all group">
                             <input type="radio" name="condition" value="{{ $c }}" class="hidden peer">
                             <div class="w-4 h-4 rounded-full border-2 border-outline-variant peer-checked:border-primary peer-checked:bg-primary transition-all mb-2"></div>
                             <span class="text-[9px] font-black uppercase tracking-widest text-on-surface-variant group-hover:text-primary transition-colors text-center">{{ $c }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
             </div>
        </div>

        <!-- PHASE 04: SCIENTIFIC SUITE -->
        <div class="step-content hidden" id="step-4">
             <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <h3 class="text-label-caps font-black text-primary tracking-[0.2em] mb-4 uppercase">Requested Analysis</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach(['Purity Verification', 'Chemical Composition', 'Density Analysis', 'Metal Concentration', 'Environmental Toxicity', 'Export Certification'] as $test)
                        <label class="flex items-center gap-4 p-4 bg-surface-container-low border border-outline-variant rounded-xl cursor-pointer hover:bg-primary/5 hover:border-primary transition-all group">
                             <input type="checkbox" class="w-5 h-5 rounded border-outline-variant bg-surface-container-high text-primary focus:ring-primary transition-all">
                             <span class="text-[11px] font-bold text-on-surface uppercase tracking-widest group-hover:text-primary transition-colors">{{ $test }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="form-group">
                        <label class="form-label">Testing Architecture Standard</label>
                        <select class="form-input">
                            <option>XRF (X-Ray Fluorescence)</option>
                            <option>Fire Assay (ISO Standard)</option>
                            <option>ICP-OES Spectrometry</option>
                            <option>Atomic Absorption</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Assigned Technician</label>
                        <select class="form-input">
                            <option>Dr. Menard J. (System Lead)</option>
                            <option>Eng. Vance K. (Senior Analyst)</option>
                            <option>Sarah L. (Compliance Auditor)</option>
                        </select>
                    </div>
                </div>
             </div>
        </div>

        <!-- PHASE 05: COMPLIANCE & ENTITIES -->
        <div class="step-content hidden" id="step-5">
             <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                 <div class="space-y-6">
                    <div class="form-group">
                         <label class="form-label">Requesting Entity Type</label>
                         <div class="flex gap-4">
                            @foreach(['COMPANY', 'GOVERNMENT', 'TRADER'] as $e)
                            <label class="flex-1 p-3 bg-surface-container-high border border-outline-variant rounded-xl cursor-pointer hover:border-primary text-center">
                                <input type="radio" name="entity" class="hidden peer">
                                <span class="text-[10px] font-black uppercase tracking-widest opacity-60 peer-checked:opacity-100 peer-checked:text-primary">{{ $e }}</span>
                            </label>
                            @endforeach
                         </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Requesting Officer / Contact</label>
                        <input type="text" class="form-input" placeholder="Full name of authorize personnel">
                    </div>
                 </div>
                 <div class="p-8 bg-error/5 border border-error/20 rounded-[32px] space-y-6">
                     <h3 class="flex items-center gap-3 text-error font-black uppercase tracking-widest text-[11px]">
                         <span class="material-symbols-outlined text-lg">gavel</span>
                         Legal Validation Gateway
                     </h3>
                     <div class="space-y-4">
                         <label class="flex items-center gap-3 cursor-pointer group">
                             <input type="checkbox" checked class="w-4 h-4 rounded border-error/50 bg-error/10 text-error focus:ring-error">
                             <span class="text-[10px] font-bold text-error uppercase tracking-widest opacity-80 group-hover:opacity-100">Mining License Verified by Authority</span>
                         </label>
                         <label class="flex items-center gap-3 cursor-pointer group">
                             <input type="checkbox" class="w-4 h-4 rounded border-error/50 bg-error/10 text-error focus:ring-error">
                             <span class="text-[10px] font-bold text-error uppercase tracking-widest opacity-80 group-hover:opacity-100">Export Authority Clearance Present</span>
                         </label>
                     </div>
                 </div>
             </div>
        </div>

        <!-- PHASE 06: ATTACHMENTS & SUBMISSION -->
        <div class="step-content hidden" id="step-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-10">
                    <div class="p-12 border-2 border-dashed border-outline-variant rounded-[40px] text-center hover:border-primary hover:bg-primary/5 transition-all cursor-pointer group">
                        <div class="w-20 h-20 bg-surface-container-highest rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant group-hover:text-primary">upload_file</span>
                        </div>
                        <h3 class="text-xl font-black text-on-background uppercase tracking-tighter mb-2">Upload Scientific Evidence</h3>
                        <p class="text-[11px] text-on-surface-variant font-bold uppercase tracking-widest opacity-60">Drag and drop sample imagery, site photos, or transport documentation</p>
                        <input type="file" class="hidden" multiple id="file_uploader">
                    </div>

                    <div class="p-8 bg-surface-container-low border border-outline-variant/30 rounded-[32px]">
                        <h3 class="text-label-caps font-black text-on-surface-variant mb-4 uppercase tracking-[0.2em] opacity-40">Internal Laboratory Notes (Restricted)</h3>
                        <textarea class="form-input min-h-[150px] !bg-transparent border-dashed border-white/10" placeholder="Initial physical anomalies or handling risks..."></textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="p-8 bg-primary rounded-[32px] text-on-primary-container relative overflow-hidden group/submit">
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover/submit:bg-white/20 transition-all"></div>
                        <h3 class="text-lg font-black uppercase tracking-tighter mb-2">Registry Finalization</h3>
                        <p class="text-[10px] font-bold uppercase opacity-70 leading-relaxed mb-6">By submitting, you certify this batch into the sovereign mineral inventory (ISO 17025).</p>
                        <button type="button" onclick="submitRegistration()" class="w-full py-4 bg-white text-primary rounded-2xl font-black text-[12px] uppercase tracking-[0.2em] hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl">
                            Authorize & Commit
                        </button>
                    </div>
                    <div class="p-6 bg-surface-container-high rounded-[32px] border border-outline-variant space-y-4">
                        <div class="flex items-center gap-3 text-secondary">
                             <span class="material-symbols-outlined text-lg">verified</span>
                             <span class="text-[10px] font-black uppercase tracking-widest">Tamper-Proof Tracking</span>
                        </div>
                        <p class="text-[9px] text-on-surface-variant font-bold leading-relaxed opacity-60 uppercase">
                            Once committed, the Sample ID will be immutable. An automated audit log entry will be generated for your ID: DR. MENARD J.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Controls -->
        <div class="fixed bottom-10 left-1/2 -translate-x-1/2 w-full max-w-2xl px-6 z-[100]">
             <div class="bg-surface/80 backdrop-blur-2xl p-4 rounded-3xl border border-white/10 shadow-2xl flex justify-between items-center">
                 <button type="button" id="prev-btn" onclick="prevStep()" class="px-8 py-3 bg-surface-container-highest text-on-surface rounded-xl font-black text-[10px] uppercase tracking-widest opacity-50 hover:opacity-100 transition-all flex items-center gap-3">
                     <span class="material-symbols-outlined text-sm">west</span> Back
                 </button>
                 <div class="flex-1 flex justify-center gap-1.5" id="dots">
                    @for($i=1; $i<=6; $i++)
                    <div class="w-1.5 h-1.5 rounded-full bg-white/10 dot transition-all duration-500" id="dot-{{ $i }}"></div>
                    @endfor
                 </div>
                 <button type="button" id="next-btn" onclick="nextStep()" class="px-8 py-3 bg-primary text-on-primary-container rounded-xl font-black text-[10px] uppercase tracking-widest hover:brightness-110 active:scale-95 transition-all flex items-center gap-3 shadow-lg shadow-primary/10">
                     <span>Continue</span> <span class="material-symbols-outlined text-sm">east</span>
                 </button>
             </div>
        </div>
    </form>
</div>

<style>
    .form-group { @apply space-y-2; }
    .form-label { @apply text-[10px] font-black text-on-surface-variant uppercase tracking-[0.2em] block ml-4; }
    .form-input { 
        @apply w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder:text-on-surface-variant/30; 
    }
    .step-content { @apply transition-all duration-700; }
    .step-active-dot { @apply w-8 bg-primary rounded-full; opacity: 1 !important; }
</style>

<script>
    let currentStep = 1;

    function updateStepper() {
        // Update Nav progress bars
        for(let i=1; i<=6; i++) {
            const bar = document.querySelector(`#step-nav-${i} .step-progress`);
            const dot = document.getElementById(`dot-${i}`);
            if(i <= currentStep) {
                bar.style.width = '100%';
                dot.classList.add('bg-primary', 'w-6');
                dot.classList.remove('bg-white/10', 'w-1.5');
            } else {
                bar.style.width = '0%';
                dot.classList.remove('bg-primary', 'w-6');
                dot.classList.add('bg-white/10', 'w-1.5');
            }
        }

        // Show/Hide Content
        document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
        document.getElementById(`step-${currentStep}`).classList.remove('hidden');

        // Update Prev Button
        const prevBtn = document.getElementById('prev-btn');
        if(currentStep === 1) {
            prevBtn.classList.add('pointer-events-none', 'opacity-20');
        } else {
            prevBtn.classList.remove('pointer-events-none', 'opacity-20');
        }

        // Update Next for final step
        const nextBtn = document.getElementById('next-btn');
        if(currentStep === 6) {
            nextBtn.classList.add('hidden');
        } else {
            nextBtn.classList.remove('hidden');
        }

        window.scrollTo({top: 0, behavior: 'smooth'});
    }

    function nextStep() {
        if(currentStep < 6) {
            currentStep++;
            updateStepper();
        }
    }

    function prevStep() {
        if(currentStep > 1) {
            currentStep--;
            updateStepper();
        }
    }

    function goToStep(s) {
        if(s < currentStep || validateCurrentStep()) { // Simple validation mock
            currentStep = s;
            updateStepper();
        }
    }

    function validateCurrentStep() {
        return true; // Mock validation
    }

    function submitRegistration() {
        // Professional Submission Simulation
        triggerExecutiveAction('Sample Legal Commit');
        setTimeout(() => {
            alert('REGISTRATION SUCCESSFUL: Batch Committed to National Registry. Redirecting to Lab Terminal...');
            window.location.href = "{{ route('admin.laboratory') }}";
        }, 2000);
    }

    // Reuse existing animation script if needed, or define here
    function triggerExecutiveAction(action) {
        const overlay = document.createElement('div');
        overlay.className = 'fixed inset-0 z-[1000] bg-black/60 backdrop-blur-md flex items-center justify-center animate-in fade-in duration-500';
        overlay.innerHTML = `
            <div class="glass-card p-10 rounded-[32px] border border-white/10 text-center max-w-sm mx-auto shadow-2xl scale-in-center">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl border border-primary/20 flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-primary text-3xl animate-spin">sync</span>
                </div>
                <h4 class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] mb-2">Sovereign Encryption</h4>
                <div class="text-lg font-black text-white uppercase tracking-tighter mb-4">${action} Initialization</div>
                <div class="h-1.5 w-full bg-white/5 rounded-full overflow-hidden mb-6">
                    <div class="h-full bg-primary animate-[progress_1.5s_ease-in-out_infinite]" style="width: 30%"></div>
                </div>
                <p class="text-[9px] font-bold text-white/40 uppercase tracking-widest leading-loose">Generating Tamper-Proof ID & Cryptographic Seal... ISO Certified.</p>
            </div>
        `;
        document.body.appendChild(overlay);
        setTimeout(() => {
            overlay.classList.add('fade-out');
            setTimeout(() => overlay.remove(), 500);
        }, 1500);
    }

    document.addEventListener('DOMContentLoaded', updateStepper);
</script>
@endsection
