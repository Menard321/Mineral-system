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

    <!-- Professional Footer -->
    <footer class="bg-dark pt-24 pb-12 border-t border-white/5 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-primary/5 rounded-full blur-[120px]"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                             <span class="material-symbols-outlined text-white text-md">query_stats</span>
                        </div>
                        <span class="text-xl font-black font-display uppercase tracking-tight">GMITE</span>
                    </div>
                    <p class="text-sm text-white/40 leading-relaxed max-w-xs">
                        The global standard for mineral intelligence, trade compliance, and operational ecosystem management. 
                    </p>
                    <div class="flex gap-4">
                        @foreach(['linkedin', 'facebook', 'youtube', 'terminal'] as $social)
                            <a href="#" class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center hover:bg-primary transition-all group">
                                <span class="material-symbols-outlined text-md text-white/40 group-hover:text-white">{{ $social }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest mb-6 text-white">Strategic Sections</h4>
                    <ul class="space-y-4 text-sm text-white/40">
                        <li><a href="#" class="hover:text-primary transition-colors">Global Intelligence Map</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Trade Oversight Dashboard</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Mineral Governance</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Compliance Verification</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest mb-6 text-white">Support & Resources</h4>
                    <ul class="space-y-4 text-sm text-white/40">
                        <li><a href="#" class="hover:text-primary transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">API Documentation</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Laboratory Standards</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Market Reports</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-widest mb-6 text-white">Contact Authority</h4>
                    <ul class="space-y-4 text-sm text-white/40">
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-sm">mail</span>
                            intelligence@gmite.int
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-sm">location_on</span>
                            Global Operations Hub • CH
                        </li>
                        <li class="mt-8">
                             <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                                 <div class="text-[9px] font-bold uppercase tracking-widest text-primary mb-1">System Version</div>
                                 <div class="text-[10px] font-bold text-white">v4.2.0-STABLE (ENTERPRISE)</div>
                             </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 pt-12 border-t border-white/5 text-[10px] font-bold uppercase tracking-[0.25em] text-white/10 px-4">
                <span>© 2026 GMITE ECOSYSTEM — TRANS-GLOBAL MINERAL AUTHORITY. ALL RIGHTS RESERVED.</span>
                <div class="flex gap-10">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Security Audit</a>
                    <a href="#">Legal Disclosure</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
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
