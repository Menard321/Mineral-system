<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'GMITE Executive - Intelligence Portal')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#424754",
                        "primary": "#adc6ff",
                        "background": "#000000",
                        "surface-container-highest": "#1E1F21",
                        "on-surface-variant": "#c2c6d6",
                        "surface": "#0C0D0F",
                        "on-surface": "#e3e2e5",
                        "secondary": "#4edea3",
                    }
                },
            },
        }
    </script>
    <style>
        body { background-color: #000; color: #e3e2e5; font-family: 'Inter', sans-serif; }
        .executive-sidebar-active { background: rgba(77, 142, 255, 0.1); color: #adc6ff; border-right: 2px solid #adc6ff; }
        .ticker-scroll { animation: ticker 40s linear infinite; }
        @keyframes ticker { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
    </style>
</head>
<body class="bg-background overflow-hidden h-screen flex flex-col">
    <!-- Top Nav -->
    <nav class="h-16 border-b border-white/5 flex items-center justify-between px-8 bg-surface z-50">
        <div class="flex items-center gap-4">
             <span class="text-2xl font-black text-primary tracking-tighter">GMITE</span>
             <span class="text-[9px] font-bold tracking-[0.4em] text-white/30 uppercase pl-4 border-l border-white/10">Executive Intelligence Portal</span>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-6 pr-6 border-r border-white/10 text-[10px] font-bold uppercase tracking-widest text-white/40">
                <span class="text-secondary text-[8px] flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_5px_#4edea3]"></span>
                    Terminal: Online
                </span>
                <span>System Health: OPTIMAL</span>
            </div>
            
            <!-- ADMIN SECURE GATEWAY -->
            <a href="/admin" class="flex items-center gap-3 group">
                <div class="text-right hidden md:block">
                    <div class="text-[9px] font-bold text-white/40 uppercase tracking-widest leading-none mb-1">Restricted</div>
                    <div class="text-[10px] font-black text-white uppercase tracking-tighter">Admin Login</div>
                </div>
                <div class="w-10 h-10 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-black transition-all shadow-[0_4px_15px_rgba(173,198,255,0.1)]">
                    <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                </div>
            </a>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden">
        <!-- Executive Sidebar (Intelligence Only, No Admin Links) -->
        <aside class="w-64 border-r border-white/5 bg-surface flex flex-col py-6 overflow-y-auto">
            <div class="px-6 mb-8">
                 <div class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em] mb-2 font-label-caps">Main Command</div>
            </div>
            <nav class="space-y-1">
                <a href="/" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('/') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">home</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Market Dashboard</span>
                </a>
                <a href="/mineral-atlas" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('mineral-atlas') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">public</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Intelligence Atlas</span>
                </a>
                <a href="/intelligence-map" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('intelligence-map') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">map</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Global MAP</span>
                </a>
                <a href="/trade-oversight" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('trade-oversight') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">currency_exchange</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Trade Oversight</span>
                </a>
                <a href="/mineral-governance" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('mineral-governance') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">diamond</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Mineral Registry</span>
                </a>
                <a href="/analytics" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('analytics') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">query_stats</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Analytics</span>
                </a>
                <a href="/compliance" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('compliance') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">gavel</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Compliance</span>
                </a>
                <a href="/laboratory" class="flex items-center gap-4 px-6 py-3 transition-all {{ Request::is('laboratory') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-lg">science</span>
                    <span class="text-[11px] font-bold uppercase tracking-widest font-label-caps">Laboratory</span>
                </a>
            </nav>
            
            <div class="mt-auto px-6 py-8">
                 <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                     <div class="text-[9px] font-bold text-white/30 uppercase mb-2">Access Status</div>
                     <div class="text-[10px] font-bold text-secondary">EXECUTIVE DIRECTOR</div>
                 </div>
            </div>
        </aside>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto p-10 custom-scrollbar">
            @yield('content')
        </main>
    </div>

    <!-- Executive Ticker -->
    <footer class="h-10 bg-surface border-t border-white/5 flex items-center overflow-hidden shrink-0">
        <div class="px-6 bg-primary text-black font-bold text-[10px] tracking-widest h-full flex items-center z-10 shrink-0">LIVE MARKET FEED</div>
        <div class="ticker-scroll whitespace-nowrap flex gap-12 text-[10px] font-bold text-white/50">
            <span>GOLD: $2,342.10 <span class="text-secondary">+1.4%</span></span>
            <span>LITHIUM: $14.2K <span class="text-error">-0.5%</span></span>
            <span>COPPER: $3.84 <span class="text-secondary">+0.2%</span></span>
            <span>DIAMOND INDEX: 114.2 <span class="text-secondary">+2.1%</span></span>
            <span>NICKEL: $16.4K <span>--</span></span>
        </div>
    </footer>
</body>
</html>
