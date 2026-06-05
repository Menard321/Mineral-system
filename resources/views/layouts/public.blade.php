<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'GMITE — Global Mineral Intelligence, Trade & Ecosystem')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: "#3B82F6",
                        secondary: "#10B981",
                        accent: "#6366F1",
                        dark: "#050A15",
                        surface: "#0B1222",
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                },
            },
        }
    </script>
    <style>
        body { background-color: #050A15; color: #E2E8F0; }
        .glass-header { background: rgba(11, 18, 34, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .hero-gradient { background: radial-gradient(circle at 50% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%); }
        .text-gradient { background: linear-gradient(to right, #60A5FA, #34D399); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #1E293B; border-radius: 4px; }
    </style>
</head>
<body class="selection:bg-primary selection:text-white overflow-x-hidden">
    
    <!-- Sticky Navigation -->
    <header class="fixed top-0 left-0 w-full z-[100] glass-header">
        <nav class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-10">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(59,130,246,0.3)]">
                         <span class="material-symbols-outlined text-white font-bold">query_stats</span>
                    </div>
                    <span class="text-2xl font-black tracking-tighter font-display uppercase">GMITE</span>
                </a>
                <div class="hidden lg:flex items-center gap-8 text-[11px] font-bold uppercase tracking-widest text-white/50">
                    <a href="/" class="hover:text-primary transition-colors">Home</a>
                    <button onclick="toggleAboutModal(true)" class="hover:text-primary transition-colors cursor-pointer outline-none">About</button>
                    <a href="#services" class="hover:text-primary transition-colors">Services</a>
                    <a href="#features" class="hover:text-primary transition-colors">Features</a>
                    <a href="/events-center" class="hover:text-primary transition-colors">Events</a>
                    <a href="/dashboard" class="flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined text-sm">dashboard</span> Dashboard Access
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-6 border-r border-white/10 pr-6 mr-2">
                    <div class="flex items-center gap-2 text-[11px] font-bold text-white/40">
                        <span class="material-symbols-outlined text-sm">language</span>
                        EN
                    </div>
                </div>
                <a href="/login" class="px-6 py-2.5 text-[11px] font-bold uppercase tracking-widest text-white hover:text-primary transition-colors">Log In</a>
                <a href="/register" class="px-7 py-3 bg-primary text-white font-bold text-[11px] uppercase tracking-[0.2em] rounded-full hover:shadow-[0_0_25px_rgba(59,130,246,0.4)] transition-all transform hover:-translate-y-0.5 active:scale-95">Register</a>
            </div>
        </nav>
    </header>

    @yield('content')

    <!-- Institutional About Modal -->
    <div id="about-modal" class="fixed inset-0 z-[200] hidden flex items-center justify-center p-6 sm:p-20">
        <div class="absolute inset-0 bg-dark/60 backdrop-blur-xl" onclick="toggleAboutModal(false)"></div>
        <div class="glass-card w-full max-w-4xl p-10 sm:p-16 rounded-[40px] relative z-10 overflow-y-auto max-h-full shadow-2xl animate-in zoom-in duration-300">
            <button onclick="toggleAboutModal(false)" class="absolute top-8 right-8 w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-500 transition-all group">
                <span class="material-symbols-outlined text-white/40 group-hover:text-white">close</span>
            </button>
            <div class="space-y-12">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full">
                    <span class="text-[10px] font-bold text-primary uppercase tracking-[0.3em]">Institutional Briefing</span>
                </div>
                <h2 class="text-4xl sm:text-6xl font-black font-display text-white tracking-tighter uppercase leading-none">The GMITE <span class="text-gradient">Mandate.</span></h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-sm text-white/50 leading-relaxed font-medium">
                    <div class="space-y-6">
                        <p>GMITE (Global Mineral Intelligence, Trade & Ecosystem) is the world's most advanced enterprise platform designed for the comprehensive management of mineral extraction, trade corridors, and institutional compliance.</p>
                        <p>Our mandate is to provide sovereign nations and global corporations with a unified data-sync environment where real-time intelligence meets regulatory authority.</p>
                    </div>
                    <div class="space-y-6">
                        <p>Driven by proprietary AI extraction models and GIS surveillance, GMITE ensures that every unit of mineral resource is traced from node to global market, maintaining the integrity of the international supply chain.</p>
                        <div class="pt-6 border-t border-white/5 grid grid-cols-2 gap-6">
                            <div>
                                <div class="text-lg font-black text-white uppercase">Sovereign</div>
                                <div class="text-[9px] font-bold text-white/30 tracking-widest mt-1 uppercase">Governance Standard</div>
                            </div>
                            <div>
                                <div class="text-lg font-black text-primary uppercase">Elite</div>
                                <div class="text-[9px] font-bold text-white/30 tracking-widest mt-1 uppercase">Extraction Security</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4">
                     <a href="/dashboard" class="px-10 py-5 bg-primary text-white font-black text-[12px] uppercase tracking-[0.2em] rounded-full hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] transition-all">Enter Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Enterprise Footer -->
    <footer class="bg-[#050A15] pt-32 pb-12 border-t border-white/5 relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[140px]"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Footer Top: News & Highlights -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 pb-20 border-b border-white/5 items-center">
                <div class="lg:col-span-5 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center shadow-[0_0_25px_rgba(59,130,246,0.4)]">
                            <span class="material-symbols-outlined text-white text-2xl">query_stats</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-white font-display tracking-tight uppercase">GMITE ECOSYSTEM</h3>
                            <p class="text-[10px] font-bold text-primary uppercase tracking-[0.4em]">The Global Platform for Mineral Intelligence, Trade, and Compliance</p>
                        </div>
                    </div>
                    <p class="text-sm text-white/40 leading-relaxed max-w-sm">
                        The definitive sovereign platform for mineral intelligence, trade corridor oversight, and global extraction compliance. Committed to institutional transparency and data-driven governance.
                    </p>
                </div>
                <!-- Newsletter Section -->
                <div class="lg:col-span-7 bg-white/5 border border-white/10 p-10 rounded-[32px] glass-card flex flex-col md:flex-row gap-8 items-center justify-between">
                    <div class="space-y-2">
                        <h4 class="text-xl font-black text-white uppercase tracking-tighter">Stay Updated</h4>
                        <p class="text-[10px] font-bold text-white/30 uppercase tracking-widest">Receive executive reports & platform releases</p>
                    </div>
                    <div class="flex-1 w-full max-w-md">
                        <form class="flex gap-2 p-1.5 bg-dark rounded-2xl border border-white/10 focus-within:border-primary transition-all">
                            <input type="email" placeholder="Institutional Email" class="bg-transparent border-none focus:ring-0 text-sm text-white flex-1 pl-4">
                            <button type="submit" class="px-6 py-3 bg-primary text-white font-black text-[10px] uppercase tracking-widest rounded-xl hover:brightness-110 active:scale-95 transition-all">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer Main: Navigation Columns -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 py-24">
                <!-- Column 1: Quick Navigation -->
                <div>
                    <h5 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-1 h-3 bg-primary rounded-full"></span> Quick Navigation
                    </h5>
                    <ul class="space-y-4 text-sm text-white/40 font-medium tracking-tight">
                        <li><a href="/" class="hover:text-primary transition-colors">Home Terminal</a></li>
                        <li><button onclick="toggleAboutModal(true)" class="hover:text-primary transition-colors cursor-pointer outline-none">About Authority</button></li>
                        <li><a href="#features" class="hover:text-primary transition-colors">Platform Features</a></li>
                        <li><a href="#services" class="hover:text-primary transition-colors">Sovereign Services</a></li>
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">Executive Dashboard</a></li>
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">News & Updates</a></li>
                    </ul>
                </div>

                <!-- Column 2: Products & Modules -->
                <div>
                    <h5 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-1 h-3 bg-secondary rounded-full"></span> Core Systems
                    </h5>
                    <ul class="space-y-4 text-sm text-white/40 font-medium">
                        <li><a href="/intelligence-map" class="flex items-center gap-2 hover:text-white transition-colors"><span class="material-symbols-outlined text-xs text-primary">public</span> Intelligence Map</a></li>
                        <li><a href="/trade-oversight" class="flex items-center gap-2 hover:text-white transition-colors"><span class="material-symbols-outlined text-xs text-primary">currency_exchange</span> Trade Oversight</a></li>
                        <li><a href="/compliance" class="flex items-center gap-2 hover:text-white transition-colors"><span class="material-symbols-outlined text-xs text-primary">gavel</span> Compliance Auditor</a></li>
                        <li><a href="/laboratory" class="flex items-center gap-2 hover:text-white transition-colors"><span class="material-symbols-outlined text-xs text-primary">science</span> Laboratory Terminal</a></li>
                        <li><a href="/admin/configuration" class="flex items-center gap-2 hover:text-white transition-colors"><span class="material-symbols-outlined text-xs text-primary">terminal</span> API Core Access</a></li>
                    </ul>
                </div>

                <!-- Column 3: Global Support -->
                <div>
                    <h5 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-1 h-3 bg-accent rounded-full"></span> Support Center
                    </h5>
                    <ul class="space-y-4 text-sm text-white/40 font-medium">
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">Technical Help Center</a></li>
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">User Documentation</a></li>
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">System Status: <span class="text-secondary font-black">OK</span></a></li>
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">Raise Support Ticket</a></li>
                        <li><a href="/dashboard" class="hover:text-primary transition-colors">Knowledge Base</a></li>
                    </ul>
                </div>

                <!-- Column 4: Legal & Security -->
                <div>
                    <h5 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <span class="w-1 h-3 bg-red-400 rounded-full"></span> Governance
                    </h5>
                    <ul class="space-y-4 text-sm text-white/40 font-medium">
                        <li><a href="/compliance" class="hover:text-primary transition-colors">Privacy Declaration</a></li>
                        <li><a href="/compliance" class="hover:text-primary transition-colors">Terms of Engagement</a></li>
                        <li><a href="/compliance" class="hover:text-primary transition-colors">Cookie Policy</a></li>
                        <li><a href="/compliance" class="hover:text-primary transition-colors">Secure Data Standard</a></li>
                        <li><a href="/mineral-governance" class="hover:text-primary transition-colors">Regulatory Framework</a></li>
                    </ul>
                </div>

                <!-- Column 5: Contact Intelligence -->
                <div class="space-y-8">
                    <div>
                        <h5 class="text-[11px] font-black text-white uppercase tracking-[0.3em] mb-6">Headquarters</h5>
                        <p class="text-sm text-white/40 font-medium leading-relaxed">
                            Trans-Global Operations Hub<br>
                            Administrative District SW-2<br>
                            Geneva, Switzerland
                        </p>
                    </div>
                    <div class="space-y-3">
                        <a href="mailto:intelligence@gmite.int" class="flex items-center gap-3 text-sm text-white/40 hover:text-white transition-colors">
                            <span class="material-symbols-outlined text-primary text-sm">mail</span> intelligence@gmite.int
                        </a>
                        <div class="flex items-center gap-3 text-sm text-white/40">
                            <span class="material-symbols-outlined text-primary text-sm">schedule</span> 09:00 - 18:00 CET
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Stats Area -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-16 border-y border-white/5">
                <div class="text-center group">
                    <div class="text-3xl font-black text-white font-display tabular-nums group-hover:text-primary transition-colors">42,842</div>
                    <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-2">Active Extraction Nodes</div>
                </div>
                <div class="text-center group">
                    <div class="text-3xl font-black text-white font-display tabular-nums group-hover:text-primary transition-colors">1.4M+</div>
                    <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-2">Verified Trade Records</div>
                </div>
                <div class="text-center group">
                    <div class="text-3xl font-black text-white font-display tabular-nums group-hover:text-primary transition-colors">100%</div>
                    <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-2">Regulatory Compliance</div>
                </div>
                <div class="text-center group">
                    <div class="text-3xl font-black text-white font-display tabular-nums group-hover:text-primary transition-colors">24/7</div>
                    <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-2">System Availability</div>
                </div>
            </div>

            <!-- Bottom Section: Language & Rights -->
            <div class="pt-12 flex flex-col lg:flex-row justify-between items-center gap-12 mb-12">
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach(['LinkedIn', 'X-Twitter', 'YouTube', 'Facebook', 'GitHub'] as $social)
                        <a href="#" class="px-5 py-2.5 bg-white/5 border border-white/10 rounded-full text-[10px] font-bold text-white/30 uppercase tracking-widest hover:bg-primary hover:text-white hover:border-primary transition-all">{{ $social }}</a>
                    @endforeach
                </div>
                
                <!-- CUSTOM SOVEREIGN LANGUAGE SELECTOR -->
                <div class="relative inline-block text-left" id="language-gate">
                    <button onclick="toggleLanguageDropdown()" class="flex items-center gap-4 bg-white/5 border border-white/10 p-2 rounded-full pr-6 hover:bg-white/10 transition-all outline-none">
                        <div class="flex items-center gap-3 pl-4">
                            <span class="material-symbols-outlined text-sm text-primary">language</span>
                            <span id="current-lang" class="text-[10px] font-black text-white uppercase tracking-widest">English (US)</span>
                        </div>
                        <span class="material-symbols-outlined text-xs text-white/20 transition-transform" id="lang-chevron">expand_more</span>
                    </button>
                    
                    <!-- HIGH-CONTRAST DROPDOWN -->
                    <div id="lang-dropdown" class="absolute bottom-full mb-4 right-0 w-48 bg-[#0C0D10] border border-white/10 rounded-2xl shadow-2xl hidden animate-in slide-in-from-bottom-2 duration-200 z-[200]">
                        <div class="p-2 space-y-1">
                            <button onclick="selectLang('English (US)')" class="w-full text-left px-4 py-3 text-[10px] font-black text-white/50 uppercase tracking-widest hover:text-white hover:bg-primary/20 rounded-xl transition-all">English (US)</button>
                            <button onclick="selectLang('Mandarin (中文)')" class="w-full text-left px-4 py-3 text-[10px] font-black text-white/50 uppercase tracking-widest hover:text-white hover:bg-primary/20 rounded-xl transition-all">Mandarin (中文)</button>
                            <button onclick="selectLang('Spanish (ES)')" class="w-full text-left px-4 py-3 text-[10px] font-black text-white/50 uppercase tracking-widest hover:text-white hover:bg-primary/20 rounded-xl transition-all">Spanish (ES)</button>
                            <button onclick="selectLang('Arabic (العربية)')" class="w-full text-left px-4 py-3 text-[10px] font-black text-white/50 uppercase tracking-widest hover:text-white hover:bg-primary/20 rounded-xl transition-all">Arabic (العربية)</button>
                            <button onclick="selectLang('French (FR)')" class="w-full text-left px-4 py-3 text-[10px] font-black text-white/50 uppercase tracking-widest hover:text-white hover:bg-primary/20 rounded-xl transition-all">French (FR)</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-8 text-[10px] font-bold uppercase tracking-[0.2em] text-white/10 mt-12 pt-8 border-t border-white/5">
                <div class="flex gap-10">
                    <span>© 2026 GMITE ECOSYSTEM Authority.</span>
                    <a href="#" class="hover:text-white/20 transition-colors">Sitemap</a>
                    <a href="#" class="hover:text-white/20 transition-colors">Developer Portal</a>
                </div>
                <div class="flex items-center gap-6">
                    <span>Platform Version: 4.2.0-STABLE</span>
                    <span class="text-secondary/20 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_5px_#4edea3] opacity-20"></span> API Status: Secure</span>
                </div>
            </div>
        </div>

        <!-- Scroll to Top -->
        <button onclick="window.scrollTo({top:0, behavior:'smooth'})" class="fixed bottom-10 right-10 w-14 h-14 bg-primary text-white rounded-2xl shadow-2xl flex items-center justify-center hover:-translate-y-2 transition-all z-[100] group active:scale-90">
             <span class="material-symbols-outlined text-2xl group-hover:-translate-y-1 transition-transform">arrow_upward</span>
        </button>
    </footer>
    <script>
        function toggleLanguageDropdown() {
            const dropdown = document.getElementById('lang-dropdown');
            const chevron = document.getElementById('lang-chevron');
            const isHidden = dropdown.classList.contains('hidden');
            
            if (isHidden) {
                dropdown.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        function selectLang(lang) {
            document.getElementById('current-lang').textContent = lang;
            toggleLanguageDropdown();
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.closest('#language-gate')) {
                const dropdown = document.getElementById('lang-dropdown');
                const chevron = document.getElementById('lang-chevron');
                if (dropdown && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    chevron.style.transform = 'rotate(0deg)';
                }
            }
        }

        function toggleAboutModal(show) {
            const modal = document.getElementById('about-modal');
            if (show) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</body>
</html>
