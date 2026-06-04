@extends('layouts.admin')

@section('title', 'GMITE - Report Generation Center')

@section('content')
<div class="flex justify-between items-center mb-10">
    <div class="flex items-center gap-6">
        <div class="w-16 h-16 bg-primary/10 border border-primary/20 rounded-2xl flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-4xl">folder_managed</span>
        </div>
        <div>
            <h1 class="text-display-lg font-bold text-on-background tracking-tighter">Report Generation Center</h1>
            <p class="text-body-md text-on-surface-variant flex items-center gap-2">
                Official documentation & economic output analysis for global stakeholders.
            </p>
        </div>
    </div>
    <button class="bg-surface-container-high px-6 py-2.5 rounded-xl border border-outline-variant text-xs font-bold hover:bg-surface-container-highest transition-all uppercase tracking-widest flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">schedule_send</span>
        Schedule Automated Reports
    </button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
    <!-- Quick Report Templates -->
    <div class="lg:col-span-2 space-y-6">
        <h2 class="text-label-caps font-bold text-on-surface-variant tracking-[0.2em] mb-4">EXECUTIVE TEMPLATES</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
             <div class="card-premium p-6 rounded-2xl group hover:border-primary transition-all cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">description</span>
                    </div>
                     <span class="text-[9px] font-bold text-secondary bg-secondary/10 px-2 py-0.5 rounded border border-secondary/20 uppercase">Official</span>
                </div>
                <h3 class="text-lg font-bold text-on-background mb-2">National Mining Output</h3>
                <p class="text-[11px] text-on-surface-variant line-clamp-2 mb-6">Detailed production metrics, site-by-site yields, and workforce efficiency across all national sectors.</p>
                <div class="flex gap-2">
                    <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                        <span class="material-symbols-outlined text-xs">picture_as_pdf</span> PDF
                    </button>
                     <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2 hover:bg-secondary hover:text-on-secondary hover:border-secondary transition-all">
                        <span class="material-symbols-outlined text-xs">table_view</span> EXCEL
                    </button>
                </div>
             </div>

             <div class="card-premium p-6 rounded-2xl group hover:border-primary transition-all cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">fact_check</span>
                    </div>
                     <span class="text-[9px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded border border-primary/20 uppercase">Compliance</span>
                </div>
                <h3 class="text-lg font-bold text-on-background mb-2">Global Compliance Audit</h3>
                <p class="text-[11px] text-on-surface-variant line-clamp-2 mb-6">Consolidated violation reports, AML/KYC sync status, and regulatory divergence analytics.</p>
                <div class="flex gap-2">
                    <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2 hover:bg-primary hover:text-on-primary-container transition-all">
                        <span class="material-symbols-outlined text-xs">picture_as_pdf</span> PDF
                    </button>
                     <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xs">table_view</span> EXCEL
                    </button>
                </div>
             </div>

             <div class="card-premium p-6 rounded-2xl group hover:border-primary transition-all cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">trending_up</span>
                    </div>
                     <span class="text-[9px] font-bold text-tertiary bg-tertiary/10 px-2 py-0.5 rounded border border-tertiary/20 uppercase">Finance</span>
                </div>
                <h3 class="text-lg font-bold text-on-background mb-2">Trade & Revenue Analysis</h3>
                <p class="text-[11px] text-on-surface-variant line-clamp-2 mb-6">Export/Import lifecycle data, royalty tracking, and tax contribution summaries per trade route.</p>
                <div class="flex gap-2">
                    <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xs">picture_as_pdf</span> PDF
                    </button>
                     <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xs">table_view</span> EXCEL
                    </button>
                </div>
             </div>

             <div class="card-premium p-6 rounded-2xl group hover:border-primary transition-all cursor-pointer">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center group-hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary">public</span>
                    </div>
                     <span class="text-[9px] font-bold text-on-surface-variant bg-surface-container-highest px-2 py-0.5 rounded border border-outline-variant uppercase">ESG</span>
                </div>
                <h3 class="text-lg font-bold text-on-background mb-2">Economic Contribution Report</h3>
                <p class="text-[11px] text-on-surface-variant line-clamp-2 mb-6">Measuring mining impact on national GDP, ESG indicators, and infrastructure development scores.</p>
                <div class="flex gap-2">
                    <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xs">picture_as_pdf</span> PDF
                    </button>
                     <button class="flex-1 py-2 bg-surface-container-highest rounded text-[10px] font-bold uppercase tracking-widest border border-outline-variant flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-xs">table_view</span> EXCEL
                    </button>
                </div>
             </div>
        </div>

        <!-- Custom Report Builder Section -->
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-3xl mt-8">
             <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
                <h2 class="text-headline-sm font-bold text-on-background">Advanced Executive Summary Builder</h2>
             </div>
             
             <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-on-surface-variant uppercase">Data Source</label>
                    <select class="w-full bg-surface-container-high border border-outline-variant rounded p-2 text-xs font-bold text-on-surface focus:ring-1 focus:ring-primary outline-none">
                        <option>All Mineral Segments</option>
                        <option>Strategic Reserves Only</option>
                        <option>Conflict-Zone Monitoring</option>
                    </select>
                </div>
                 <div class="space-y-2">
                    <label class="text-[10px] font-bold text-on-surface-variant uppercase">Temporal Scope</label>
                    <div class="flex gap-2">
                         <input type="date" class="flex-1 bg-surface-container-high border border-outline-variant rounded p-2 text-[10px] font-bold text-on-surface outline-none"/>
                         <input type="date" class="flex-1 bg-surface-container-high border border-outline-variant rounded p-2 text-[10px] font-bold text-on-surface outline-none"/>
                    </div>
                </div>
                <div class="space-y-2 flex flex-col justify-end">
                    <button class="w-full py-2 bg-primary text-on-primary-container rounded font-bold text-[11px] uppercase tracking-widest hover:opacity-90">Generate Custom Summary</button>
                </div>
             </div>
        </div>
    </div>

    <!-- Recent Generated Reports Sidebar -->
    <div class="space-y-6">
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-3xl">
             <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">history</span>
                Recently Generated
             </h3>
             <div class="space-y-4">
                 @php
                    $recs = [
                        ['n' => 'Global_Trade_Q1_2026.pdf', 't' => '12 mins ago', 's' => '2.4 MB'],
                        ['n' => 'Compliance_Audit_DRC.xlsx', 't' => '2 hours ago', 's' => '12.8 MB'],
                        ['n' => 'Fiscal_Impact_Summary.pdf', 't' => 'Yesterday', 's' => '1.1 MB'],
                        ['n' => 'Site_Inspection_Geita.pdf', 't' => '2 days ago', 's' => '4.2 MB'],
                    ];
                @endphp
                @foreach($recs as $rec)
                <div class="p-3 bg-surface-container-high border border-outline-variant/30 rounded-xl hover:border-primary transition-all group">
                     <div class="flex items-center gap-3">
                         <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">cloud_download</span>
                         <div class="flex-1 overflow-hidden">
                            <div class="text-[11px] font-bold text-on-background truncate">{{ $rec['n'] }}</div>
                            <div class="flex justify-between text-[9px] text-on-surface-variant mt-0.5">
                                <span>{{ $rec['t'] }}</span>
                                <span>{{ $rec['s'] }}</span>
                            </div>
                         </div>
                     </div>
                </div>
                @endforeach
             </div>
             <button class="mt-6 w-full text-center text-[10px] font-bold text-primary uppercase hover:underline">View All Archived Reports</button>
        </div>

        <div class="card-premium p-6 rounded-3xl border border-primary/20 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 text-primary/10">
                <span class="material-symbols-outlined text-[100px]">auto_stories</span>
            </div>
            <h3 class="text-label-caps font-bold text-on-surface-variant mb-4 uppercase">AI Insights Engine</h3>
            <p class="text-[11px] text-on-surface-variant leading-relaxed italic mb-6">"Automated cross-referencing of fiscal data against satellite output suggests a 4.2% revenue leak in the Northern corridor. Recommend generating a Compliance Special Report."</p>
            <button class="w-full py-2 bg-primary/10 text-primary border border-primary/20 rounded text-[10px] font-bold uppercase tracking-widest hover:bg-primary hover:text-on-primary-container transition-all">Enable Intelligence Overlay</button>
        </div>
    </div>
</div>
@endsection
