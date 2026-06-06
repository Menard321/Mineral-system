@extends('layouts.executive')

@section('title', 'GMITE | Initiate Export Application')

@section('content')
<style>
    .form-card { background: linear-gradient(145deg, rgba(15, 16, 18, 0.95), rgba(30, 31, 35, 0.98)); backdrop-filter: blur(40px); border: 1px solid rgba(255, 255, 255, 0.05); }
    .input-field { background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.08); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .input-field:focus { border-color: #adc6ff; box-shadow: 0 0 15px rgba(173,198,255,0.1); outline: none; }
    .stat-badge { background: rgba(173,198,255,0.05); border: 1px solid rgba(173,198,255,0.1); padding: 4px 10px; border-radius: 6px; font-size: 8px; font-weight: 900; letter-spacing: 0.1em; color: #adc6ff; }
</style>

<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-6 mb-12">
        <a href="{{ route('user.trades.index') }}" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-white/10 transition-all">
            <span class="material-symbols-outlined text-white/40">arrow_back</span>
        </a>
        <div>
            <h1 class="text-3xl font-black text-white tracking-tighter uppercase leading-none mb-1">Initiate Export Application</h1>
            <p class="text-[10px] text-on-surface-variant uppercase tracking-[0.5em] font-bold opacity-50">Sovereign Mineral Governance Layer 4</p>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-error/10 border border-error/20 p-6 rounded-3xl mb-8 flex items-center gap-4 text-error animate-pulse">
            <span class="material-symbols-outlined">warning</span>
            <p class="text-[11px] font-black uppercase tracking-widest">{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('user.trades.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        @csrf
        
        <div class="lg:col-span-2 space-y-8">
            <div class="form-card p-10 rounded-[48px] space-y-8">
                <div>
                     <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mb-4 block">Select Verified Specimen Certificate</label>
                     <select name="certificate_id" class="w-full p-5 rounded-2xl input-field text-white text-[13px] font-bold appearance-none">
                         <option value="" disabled selected>— Identification of Source Asset —</option>
                         @foreach($certificates as $cert)
                            <option value="{{ $cert->id }}">{{ $cert->cert_id }} ({{ $cert->mineral_type }} - {{ number_format($cert->quantity_kg, 2) }} KG)</option>
                         @endforeach
                     </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
                    <div>
                         <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mb-4 block">Calculated Net Weight (KG)</label>
                         <input type="number" step="0.0001" name="quantity_kg" placeholder="0.0000" class="w-full p-5 rounded-2xl input-field text-white text-[13px] font-bold font-mono">
                    </div>
                    <div>
                         <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mb-4 block">Declared Valuation (USD)</label>
                         <input type="number" step="0.01" name="value_usd" placeholder="0.00" class="w-full p-5 rounded-2xl input-field text-white text-[13px] font-bold font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
                    <div>
                         <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mb-4 block">Official Consignee / Buyer</label>
                         <input type="text" name="buyer_name" placeholder="Legal Entity Name" class="w-full p-5 rounded-2xl input-field text-white text-[13px] font-bold">
                    </div>
                    <div>
                         <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mb-4 block">Destination Jurisdiction</label>
                         <input type="text" name="buyer_country" placeholder="Country" class="w-full p-5 rounded-2xl input-field text-white text-[13px] font-bold">
                    </div>
                </div>

                <div class="mt-10">
                     <label class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] mb-4 block">Port of Entry / Destination Port</label>
                     <input type="text" name="destination_port" placeholder="Name of International Port" class="w-full p-5 rounded-2xl input-field text-white text-[13px] font-bold">
                </div>
            </div>

            <div class="p-8 bg-error/5 border border-error/10 rounded-[32px] flex items-start gap-6">
                <span class="material-symbols-outlined text-error text-2xl mt-1">gpp_maybe</span>
                <div>
                    <h4 class="text-[10px] font-black text-error uppercase tracking-widest mb-2">Revenue Integrity Acknowledgment</h4>
                    <p class="text-[10px] text-white/40 font-bold leading-relaxed">By submitting this application, I acknowledge that the GMITE Revenue Assurance Engine will perform a real-time audit comparing declared value against laboratory grade and global market indices. Mismatches exceeding 10% will trigger an institutional audit and may lead to export suspension.</p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="form-card p-10 rounded-[40px]">
                <h3 class="text-[11px] font-black text-white uppercase tracking-[.3em] mb-8">Export Summary</h3>
                <div class="space-y-6">
                     <div class="flex justify-between items-center py-3 border-b border-white/5">
                        <span class="text-[9px] text-white/30 uppercase font-bold">Trade Type</span>
                        <span class="text-[10px] font-black text-white uppercase">Sovereign Export</span>
                     </div>
                     <div class="flex justify-between items-center py-3 border-b border-white/5">
                        <span class="text-[9px] text-white/30 uppercase font-bold">Sync Level</span>
                        <span class="stat-badge">REAL-TIME</span>
                     </div>
                     <div class="flex justify-between items-center py-3 border-b border-white/5">
                        <span class="text-[9px] text-white/30 uppercase font-bold">Gov Audit</span>
                        <span class="stat-badge">MANDATORY</span>
                     </div>
                </div>

                <button type="submit" class="w-full mt-10 py-5 bg-primary text-black text-[11px] font-black uppercase tracking-widest rounded-2xl hover:brightness-110 active:scale-95 transition-all shadow-2xl shadow-primary/20">
                    Apply for Export Clearance
                </button>
                <div class="mt-6 text-center">
                    <span class="text-[8px] text-white/20 uppercase font-black tracking-widest">Protocol Version: 2026.04.A</span>
                </div>
            </div>

            <!-- Intelligence Map Placeholder -->
            <div class="bg-white/5 border border-white/10 rounded-[40px] p-8 overflow-hidden relative group">
                <div class="relative z-10">
                    <h4 class="text-[9px] font-black text-white uppercase tracking-[.3em] mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[14px]">public</span> Global Logistics Insight
                    </h4>
                    <p class="text-[9px] text-white/30 font-bold leading-relaxed mb-6">Real-time surveillance of international mineral trade routes is currently active.</p>
                    <div class="w-full h-32 bg-black/40 rounded-2xl border border-white/5 flex items-center justify-center">
                         <span class="material-symbols-outlined text-white/10 text-4xl animate-pulse">radar</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
