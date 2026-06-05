@extends('layouts.executive')

@section('content')
<div class="flex-1 overflow-y-auto bg-[#0B1220] text-slate-100 font-sans">
    <!-- MIEC TOP MONITOR (Hero Section) -->
    <section class="relative min-h-[60vh] flex items-center px-12 py-20 overflow-hidden border-b border-white/5">
        <!-- Animated Intelligence Matrix -->
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0B1220] via-transparent to-[#0B1220]"></div>
            <!-- GIS Grid Animation Simulation -->
            <div class="w-full h-full" style="background-image: radial-gradient(#3B82F6 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <div class="relative z-10 max-w-4xl space-y-8 animate-in slide-in-from-left duration-1000">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-[#D4AF37]/10 border border-[#D4AF37]/20 rounded-full">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span class="text-[10px] font-black text-[#D4AF37] uppercase tracking-[0.3em]">Signal: Active Aggregation</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black font-display leading-none tracking-tighter uppercase">
                Discover Global <span class="text-[#D4AF37]">Mining & Mineral</span> Events in Real Time.
            </h1>
            
            <p class="text-lg text-slate-400 font-medium max-w-2xl leading-relaxed">
                Access verified investment forums, geological congresses, mineral trade expos, and sustainability summits. The MIEC synchronizes the world's extraction calendar.
            </p>

            <div class="flex flex-wrap gap-4 pt-4">
                <button data-action="explore-events" class="px-10 py-5 bg-[#D4AF37] text-black font-black text-xs uppercase tracking-widest rounded-full shadow-[0_0_40px_rgba(212,175,55,0.3)] hover:scale-105 transition-all">Explore Events</button>
                <button data-action="view-global-map" class="px-10 py-5 bg-white/5 border border-white/10 text-white font-black text-xs uppercase tracking-widest rounded-full hover:bg-white/10 transition-all flex items-center gap-3"><span class="material-symbols-outlined text-sm">public</span> View Global Map</button>
            </div>
        </div>

        <!-- Floating Analytics Panel -->
        <div class="absolute right-12 top-1/2 -translate-y-1/2 hidden xl:block w-80 space-y-6 animate-in zoom-in duration-1000">
             <div class="p-6 bg-white/5 border border-white/10 rounded-[32px] glass-card backdrop-blur-xl">
                 <div class="text-[9px] font-bold text-white/40 uppercase tracking-widest mb-6">Upcoming Signal Focus</div>
                 <div class="space-y-4">
                     <div class="flex items-center justify-between">
                         <span class="text-[11px] font-bold">Lithium Summit (AU)</span>
                         <span class="text-[10px] font-black text-[#D4AF37]">MAR 24</span>
                     </div>
                     <div class="h-1 bg-white/5 rounded-full overflow-hidden">
                         <div class="h-full bg-[#D4AF37] w-3/4"></div>
                     </div>
                     <div class="flex items-center justify-between">
                         <span class="text-[11px] font-bold">African Mining Indaba</span>
                         <span class="text-[10px] font-black text-[#3B82F6]">FEB 26</span>
                     </div>
                     <div class="h-1 bg-white/5 rounded-full overflow-hidden">
                         <div class="h-full bg-[#3B82F6] w-1/2"></div>
                     </div>
                 </div>
             </div>
        </div>
    </section>

    <!-- INTELLIGENCE KPI DASHBOARD -->
    <section class="py-16 px-12 grid grid-cols-2 md:grid-cols-4 gap-8">
        @foreach([
            ['Upcoming Events', '482', '+12%', 'event'],
            ['Countries Hosting', '18', 'Global', 'public'],
            ['Mining Summits', '124', 'Verified', 'query_stats'],
            ['Investor Forums', '96', 'Active', 'currency_exchange']
        ] as $stat)
        <div class="p-8 bg-[#111827] border border-white/5 rounded-[40px] group hover:border-[#D4AF37]/30 transition-all">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center group-hover:bg-[#D4AF37]/10 transition-colors">
                    <span class="material-symbols-outlined text-[#D4AF37]">{{ $stat[3] }}</span>
                </div>
                <span class="text-[10px] font-black text-[#D4AF37] uppercase tracking-widest">{{ $stat[2] }}</span>
            </div>
            <div class="text-4xl font-black text-white tabular-nums mb-1">{{ $stat[1] }}</div>
            <div class="text-[10px] font-bold text-white/40 uppercase tracking-widest">{{ $stat[0] }}</div>
        </div>
        @endforeach
    </section>

    <!-- GLOBAL EVENTS FEED -->
    <section id="events-feed" class="py-20 px-12 space-y-12">
        <div class="flex justify-between items-end">
            <div>
                <h2 class="text-4xl font-black text-white uppercase tracking-tighter">Verified Signals Feed</h2>
                <p class="text-sm text-white/40 font-medium">Aggregated event intelligence from 124+ global sources.</p>
            </div>
            <div class="flex gap-4">
                 <button data-filter-btn="all" onclick="filterEvents('all')" class="px-6 py-3 bg-[#3B82F6] text-white rounded-xl text-[10px] font-bold uppercase tracking-widest shadow-lg shadow-blue-500/20 transition-all">All Events</button>
                 <button data-filter-btn="investment" onclick="filterEvents('investment')" class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-white/10 transition-all">Investment</button>
                 <button data-filter-btn="geological" onclick="filterEvents('geological')" class="px-6 py-3 bg-white/5 border border-white/10 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-white/10 transition-all">Geological</button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" id="events-grid">
            @php
            $events = [
                [
                    'name' => 'African Mining Indaba 2026',
                    'org' => 'Mining Indaba Authority',
                    'cat' => 'Policy & Investment',
                    'loc' => 'Cape Town, ZA',
                    'date' => 'FEB 02-05, 2026',
                    'minerals' => ['Gold', 'Copper', 'Lithium'],
                    'status' => 'Confirmed',
                    'price' => '$1,850.00',
                    'color' => '#3B82F6'
                ],
                [
                    'name' => 'Critical Minerals Summit',
                    'org' => 'Sovereign Resources Group',
                    'cat' => 'Energy Transition',
                    'loc' => 'Perth, AU',
                    'date' => 'MAR 14-16, 2026',
                    'minerals' => ['Nickel', 'Lithium', 'Cobalt'],
                    'status' => 'Registration Open',
                    'price' => '$2,400.00',
                    'color' => '#D4AF37'
                ],
                [
                    'name' => 'Global Exploration Forum',
                    'org' => 'IGC Geological Congress',
                    'cat' => 'Exploration & Tech',
                    'loc' => 'Toronto, CA',
                    'date' => 'APR 20-22, 2026',
                    'minerals' => ['Iron Ore', 'Bauxite'],
                    'status' => 'Verified',
                    'price' => '$950.00',
                    'color' => '#10b981'
                ],
                [
                    'name' => 'ESG Mining Congress 2026',
                    'org' => 'Global Sustainability Council',
                    'cat' => 'Sustainability & ESG',
                    'loc' => 'Geneva, CH',
                    'date' => 'MAY 08-10, 2026',
                    'minerals' => ['Rare Earths', 'Graphite'],
                    'status' => 'Confirmed',
                    'price' => '$3,200.00',
                    'color' => '#8b5cf6'
                ],
                [
                    'name' => 'Lithium Trade Expo 2026',
                    'org' => 'LME Commodity Exchange',
                    'cat' => 'Trade & Commodity',
                    'loc' => 'Singapore, SG',
                    'date' => 'JUN 15-17, 2026',
                    'minerals' => ['Lithium', 'Cobalt', 'Nickel'],
                    'status' => 'Registration Open',
                    'price' => '$1,200.00',
                    'color' => '#D4AF37'
                ],
                [
                    'name' => 'Gold & Precious Metals Forum',
                    'org' => 'World Gold Council',
                    'cat' => 'Investment Forum',
                    'loc' => 'Dubai, AE',
                    'date' => 'JUL 22-24, 2026',
                    'minerals' => ['Gold', 'Silver', 'Platinum'],
                    'status' => 'Confirmed',
                    'price' => '$4,500.00',
                    'color' => '#f59e0b'
                ],
            ];
            @endphp

            @foreach($events as $event)
            <div class="group bg-[#111827] border border-white/5 rounded-[48px] overflow-hidden hover:scale-[1.02] transition-all duration-500 shadow-2xl relative">
                <!-- Status Badge -->
                <div class="absolute top-6 right-6 px-4 py-2 bg-black/40 backdrop-blur-md rounded-full border border-white/5 z-20">
                    <span class="text-[9px] font-black text-white/60 uppercase tracking-widest">{{ $event['status'] }}</span>
                </div>

                <!-- Event Image Placeholder -->
                <div class="aspect-[16/10] bg-white/5 relative flex items-center justify-center overflow-hidden">
                     <span class="material-symbols-outlined text-white/5 text-9xl group-hover:scale-110 transition-transform duration-700">event_available</span>
                     <div class="absolute inset-0 bg-gradient-to-t from-[#111827] to-transparent"></div>
                </div>

                <div class="p-10 -mt-12 relative z-10 space-y-6">
                    <div class="space-y-2">
                        <div data-category="{{ $event['cat'] }}" class="flex items-center gap-2 text-[9px] font-black uppercase tracking-[0.2em]" style="color: {{ $event['color'] }}">
                            <span class="w-1.5 h-1.5 rounded-full" style="background: {{ $event['color'] }}"></span>
                            {{ $event['cat'] }}
                        </div>
                        <h3 class="text-2xl font-black text-white tracking-tighter leading-tight group-hover:text-[#D4AF37] transition-colors">{{ $event['name'] }}</h3>
                        <p class="text-xs font-medium text-white/30 uppercase tracking-widest">{{ $event['org'] }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-6 bg-white/5 p-6 rounded-3xl border border-white/5">
                        <div>
                            <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mb-1">Timeline</div>
                            <div class="text-[11px] font-bold text-white">{{ $event['date'] }}</div>
                        </div>
                        <div>
                            <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mb-1">Registration Fee</div>
                            <div class="text-[11px] font-black text-[#D4AF37]">{{ $event['price'] ?? '$450.00' }}</div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach($event['minerals'] as $mineral)
                            <span class="px-3 py-1.5 bg-white/5 rounded-lg text-[9px] font-black text-white/40 uppercase tracking-widest hover:text-white hover:bg-white/10 transition-all cursor-default">{{ $mineral }}</span>
                        @endforeach
                    </div>

                    <div class="pt-4 flex gap-4">
                         <button onclick="showEventDetails('{{ $event['name'] }}', '{{ $event['org'] }}')" class="flex-1 py-4 bg-white/5 border border-white/10 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-white/10 transition-all">Details</button>
                         <button onclick="initiateRegistration('{{ $event['name'] }}', '{{ $event['price'] ?? '$450.00' }}')" class="flex-1 py-4 bg-white text-black font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-[#D4AF37] transition-all shadow-[0_10px_30px_rgba(255,255,255,0.1)]">Register</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- INSTITUTIONAL REGISTRATION MODAL (MIEC Terminal) -->
    <div id="registration-modal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center p-6 bg-[#050A15]/90 backdrop-blur-3xl overflow-y-auto">
        <div class="w-full max-w-2xl bg-[#0B1220] border border-white/5 rounded-[48px] p-12 relative shadow-2xl animate-in zoom-in duration-300 my-auto">
             <button onclick="closeModal('registration-modal')" class="absolute top-8 right-8 w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-500 transition-all text-white/40 hover:text-white">
                <span class="material-symbols-outlined text-sm">close</span>
             </button>

             <div class="space-y-10">
                 <div class="space-y-4">
                    <span class="text-[10px] font-black text-[#D4AF37] uppercase tracking-[0.4em]">MIEC Provisioning</span>
                    <h2 class="text-4xl font-black text-white tracking-tighter uppercase leading-none">Event <span class="text-[#D4AF37]">Registration.</span></h2>
                    <p id="reg-event-name" class="text-sm font-bold text-white/40 uppercase tracking-widest"></p>
                 </div>

                 <form id="registration-form" onsubmit="handlePayment(event)" class="space-y-8">
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-white/20 uppercase tracking-widest pl-2">Organization/Entity Name</label>
                            <input type="text" placeholder="Global Resources Ltd" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-xs font-bold text-white outline-none focus:border-[#D4AF37] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-white/20 uppercase tracking-widest pl-2">Mining License Number</label>
                            <input type="text" placeholder="ML-492-SYNC" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-xs font-bold text-white outline-none focus:border-[#D4AF37] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-white/20 uppercase tracking-widest pl-2">Institutional Email</label>
                            <input type="email" placeholder="protocol@organization.com" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-xs font-bold text-white outline-none focus:border-[#D4AF37] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-bold text-white/20 uppercase tracking-widest pl-2">Phone Number</label>
                            <input type="tel" placeholder="+41 22 730 00 00" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-xs font-bold text-white outline-none focus:border-[#D4AF37] transition-all">
                        </div>
                     </div>

                     <div class="p-8 bg-[#D4AF37]/5 border border-[#D4AF37]/20 rounded-[32px] space-y-6">
                         <div class="flex justify-between items-center">
                             <div>
                                 <h4 class="text-xs font-black text-white uppercase">Registration Total</h4>
                                 <p class="text-[9px] font-bold text-[#D4AF37] uppercase tracking-widest">Inclusive of institutional levies</p>
                             </div>
                             <div id="reg-total-price" class="text-3xl font-black text-white tabular-nums">$450.00</div>
                         </div>
                         <button type="submit" class="w-full py-5 bg-[#D4AF37] text-black font-black text-xs uppercase tracking-widest rounded-2xl shadow-xl hover:shadow-[#D4AF37]/20 transition-all">
                            Proceed to Secure Payment
                         </button>
                     </div>
                 </form>

                 <div id="payment-status" class="hidden text-center space-y-6 animate-in zoom-in">
                     <div class="w-20 h-20 bg-secondary/10 border border-secondary/20 rounded-full flex items-center justify-center mx-auto">
                        <span class="material-symbols-outlined text-secondary text-4xl">check_circle</span>
                     </div>
                     <div class="space-y-2">
                        <h4 class="text-xl font-black text-white uppercase">Transaction Verified</h4>
                        <p class="text-xs font-medium text-white/40">Credential sequence finalized. Your registration entry is secure.</p>
                     </div>
                     <button onclick="closeModal('registration-modal')" class="px-10 py-4 bg-white/5 border border-white/10 rounded-2xl text-[10px] font-bold text-white uppercase tracking-widest">Return to Feed</button>
                 </div>
             </div>
        </div>
    </div>

    <!-- EVENT DETAILS BRIEFING MODAL -->
    <div id="details-modal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center p-6 bg-[#050A15]/90 backdrop-blur-3xl">
        <div class="w-full max-w-3xl bg-[#0B1220] border border-white/5 rounded-[48px] p-12 relative shadow-2xl animate-in fade-in duration-300">
             <button onclick="closeModal('details-modal')" class="absolute top-8 right-8 w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-500 transition-all text-white/40 hover:text-white">
                <span class="material-symbols-outlined text-sm">close</span>
             </button>

             <div class="space-y-10">
                 <div class="space-y-4">
                    <span class="text-[10px] font-black text-[#3B82F6] uppercase tracking-[0.4em]">Intelligence Briefing</span>
                    <h2 id="detail-event-title" class="text-4xl font-black text-white tracking-tighter uppercase leading-none">Event Overview.</h2>
                    <p id="detail-event-org" class="text-[10px] font-black text-white/30 uppercase tracking-[0.5em]"></p>
                 </div>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-sm text-white/50 leading-relaxed">
                     <div class="space-y-6">
                         <h5 class="text-[11px] font-black text-white uppercase tracking-widest border-b border-white/10 pb-4">Strategic Agenda</h5>
                         <ul class="space-y-4 font-medium">
                             <li class="flex gap-3"><span class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-1.5 flex-shrink-0"></span> Sovereign investment protocols & FDI corridors.</li>
                             <li class="flex gap-3"><span class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-1.5 flex-shrink-0"></span> Resource nationalism vs global trade scaling.</li>
                             <li class="flex gap-3"><span class="w-1.5 h-1.5 bg-[#D4AF37] rounded-full mt-1.5 flex-shrink-0"></span> ESG verification & decarbonization of extraction.</li>
                         </ul>
                     </div>
                     <div class="space-y-6">
                         <h5 class="text-[11px] font-black text-white uppercase tracking-widest border-b border-white/10 pb-4">Operational Outcomes</h5>
                         <p>Delegates will engage in session-driven intelligence sharing, finalizing multi-lateral trade agreements and exploring emerging exploration technologies under verified sovereign oversight.</p>
                         <div class="pt-4">
                             <button class="w-full py-4 bg-[#3B82F6] text-white font-black text-[10px] uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-500/20">Download Full Agenda PDF</button>
                         </div>
                     </div>
                 </div>
             </div>
        </div>
    </div>

    <!-- MIEC TRUSTED SOURCES (Marquee Effect Simulation) -->
    <section class="py-20 border-y border-white/5 bg-[#111827]/50">
        <div class="text-center mb-12">
            <h4 class="text-[11px] font-black text-[#D4AF37] uppercase tracking-[0.4em]">Integrated Data Hubs</h4>
            <p class="text-sm text-white/30 font-medium">Verified intelligence synchronized from sovereign agencies.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-16 px-12 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-700 cursor-pointer">
            @foreach(['WORLD BANK', 'OECD MINING', 'AFRICAN DEV BANK', 'UNESCO MINERALS', 'UNEP GEOLOGY'] as $partner)
                <span class="text-xl font-black text-white/40 font-display tracking-tighter hover:text-[#D4AF37] transition-colors">{{ $partner }}</span>
            @endforeach
        </div>
    </section>
</div>

<script>
    /* ══════════════════════════════════════════════════
     *  MIEC JAVASCRIPT ENGINE  v2.0
     *  All functions are GLOBAL so onclick="" works.
     * ══════════════════════════════════════════════════ */

    // ── Modal helpers ──────────────────────────────────
    function openModal(id) {
        const el = document.getElementById(id);
        if (el) {
            el.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const el = document.getElementById(id);
        if (el) {
            el.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        if (id === 'registration-modal') {
            const form = document.getElementById('registration-form');
            const status = document.getElementById('payment-status');
            if (form) { form.classList.remove('hidden'); form.reset(); }
            if (status) status.classList.add('hidden');
        }
    }

    // ── Registration Terminal ──────────────────────────
    function initiateRegistration(eventName, price) {
        const nameEl   = document.getElementById('reg-event-name');
        const priceEl  = document.getElementById('reg-total-price');
        const form     = document.getElementById('registration-form');
        const status   = document.getElementById('payment-status');
        const submitBtn = form ? form.querySelector('button[type="submit"]') : null;

        if (nameEl)  nameEl.textContent  = eventName;
        if (priceEl) priceEl.textContent = price;
        if (form)    form.classList.remove('hidden');
        if (status)  status.classList.add('hidden');
        if (submitBtn) {
            submitBtn.textContent = 'Proceed to Secure Payment';
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-60');
        }
        openModal('registration-modal');
    }

    // ── Payment Protocol Simulation ────────────────────
    function handlePayment(e) {
        e.preventDefault();
        const btn = e.target.querySelector('button[type="submit"]');
        if (!btn) return;
        btn.textContent = '⏳ Processing Transaction...';
        btn.disabled = true;
        btn.classList.add('opacity-60');

        setTimeout(() => {
            const form   = document.getElementById('registration-form');
            const status = document.getElementById('payment-status');
            if (form)   form.classList.add('hidden');
            if (status) status.classList.remove('hidden');
        }, 2000);
    }

    // ── Event Briefing Modal ───────────────────────────
    function showEventDetails(name, org) {
        const titleEl = document.getElementById('detail-event-title');
        const orgEl   = document.getElementById('detail-event-org');
        if (titleEl) titleEl.textContent = name;
        if (orgEl)   orgEl.textContent   = org;
        openModal('details-modal');
    }

    // ── Event Filter Engine ────────────────────────────
    function filterEvents(type) {
        const cards = document.querySelectorAll('#events-grid > div');
        const filterMap = {
            investment: ['investment forum', 'policy & investment', 'trade & commodity'],
            geological: ['exploration & tech', 'sustainability & esg', 'energy transition']
        };

        // Swap active state on filter buttons
        document.querySelectorAll('[data-filter-btn]').forEach(b => {
            b.classList.remove('bg-[#3B82F6]', 'text-white', 'shadow-lg', 'shadow-blue-500/20');
            b.classList.add('bg-white/5', 'border', 'border-white/10');
        });
        const active = document.querySelector(`[data-filter-btn="${type}"]`);
        if (active) {
            active.classList.remove('bg-white/5', 'border', 'border-white/10');
            active.classList.add('bg-[#3B82F6]', 'text-white', 'shadow-lg', 'shadow-blue-500/20');
        }

        // Show / hide cards
        cards.forEach((card, i) => {
            const catEl = card.querySelector('[data-category]');
            if (!catEl) return;
            const cat  = catEl.dataset.category.toLowerCase();
            const show = type === 'all' || (filterMap[type] || []).some(k => cat.includes(k));
            if (show) {
                card.style.display = '';
                card.style.opacity = '0';
                setTimeout(() => { card.style.opacity = '1'; card.style.transition = 'opacity 0.4s ease'; }, i * 60);
            } else {
                card.style.display = 'none';
            }
        });
    }

    // ── Boot after DOM ready ───────────────────────────
    document.addEventListener('DOMContentLoaded', () => {

        // Hero "Explore Events" → smooth-scroll to events feed
        const exploreBtn = document.querySelector('[data-action="explore-events"]');
        if (exploreBtn) {
            exploreBtn.addEventListener('click', () => {
                document.getElementById('events-feed')?.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Hero "View Global Map" → redirect
        const mapBtn = document.querySelector('[data-action="view-global-map"]');
        if (mapBtn) {
            mapBtn.addEventListener('click', () => {
                window.location.href = '/intelligence-map';
            });
        }

        // Close modals when clicking the dark backdrop
        ['registration-modal', 'details-modal'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.addEventListener('click', function(e) {
                if (e.target === this) closeModal(id);
            });
        });

        // Close modals on Escape key
        document.addEventListener('keydown', e => {
            if (e.key !== 'Escape') return;
            ['registration-modal', 'details-modal'].forEach(id => {
                const el = document.getElementById(id);
                if (el && !el.classList.contains('hidden')) closeModal(id);
            });
        });
    });
</script>
@endsection
