<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'GMITE Terminal - Global Mineral Intelligence')</title>
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
                        "tertiary-container": "#ff5451",
                        "background": "#0A0B0D",
                        "surface-container-highest": "#343537",
                        "primary-fixed": "#d8e2ff",
                        "on-primary-container": "#00285d",
                        "surface-tint": "#adc6ff",
                        "inverse-on-surface": "#303033",
                        "secondary-fixed": "#6ffbbe",
                        "on-background": "#e3e2e5",
                        "on-error-container": "#ffdad6",
                        "on-surface-variant": "#c2c6d6",
                        "on-tertiary": "#68000a",
                        "surface": "#121315",
                        "on-primary": "#002e6a",
                        "secondary-container": "#00a572",
                        "on-tertiary-container": "#5c0008",
                        "on-primary-fixed": "#001a42",
                        "inverse-surface": "#e3e2e5",
                        "outline": "#8c909f",
                        "tertiary-fixed": "#ffdad7",
                        "secondary-fixed-dim": "#4edea3",
                        "on-secondary": "#003824",
                        "on-error": "#690005",
                        "surface-container-lowest": "#0d0e10",
                        "surface-bright": "#38393b",
                        "surface-container-high": "#292a2c",
                        "primary-container": "#4d8eff",
                        "tertiary-fixed-dim": "#ffb3ad",
                        "on-primary-fixed-variant": "#004395",
                        "on-secondary-fixed": "#002113",
                        "surface-dim": "#121315",
                        "on-surface": "#e3e2e5",
                        "surface-container-low": "#1b1c1e",
                        "tertiary": "#ffb3ad",
                        "on-tertiary-fixed": "#410004",
                        "on-tertiary-fixed-variant": "#930013",
                        "on-secondary-container": "#00311f",
                        "secondary": "#4edea3",
                        "error-container": "#93000a",
                        "on-secondary-fixed-variant": "#005236",
                        "error": "#ffb4ab",
                        "inverse-primary": "#005ac2",
                        "surface-container": "#1f2022",
                        "primary-fixed-dim": "#adc6ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin": "16px",
                        "gutter": "12px",
                        "unit": "4px",
                        "container-padding": "20px"
                    },
                    "fontFamily": {
                        "display-lg": ["Inter"],
                        "data-tabular": ["JetBrains Mono"],
                        "headline-sm": ["Inter"],
                        "label-caps": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "display-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "data-tabular": ["13px", {"lineHeight": "16px", "letterSpacing": "-0.01em", "fontWeight": "500"}],
                        "headline-sm": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                        "label-caps": ["11px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #0A0B0D;
            color: #e3e2e5;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        .glass {
            background: rgba(18, 20, 23, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(66, 71, 84, 0.5);
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.05);
        }
        .ticker-scroll {
            animation: ticker 30s linear infinite;
        }
        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .sidebar-item-active {
            background: rgba(77, 142, 255, 0.15);
            color: #adc6ff;
            border-left: 3px solid #adc6ff;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0A0B0D; }
        ::-webkit-scrollbar-thumb { background: #262A33; border-radius: 3px; }
        
        .card-premium {
            background: linear-gradient(145deg, #1b1c1e, #121315);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        .card-premium:hover {
            border-color: rgba(77, 142, 255, 0.3);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }
        .btn-primary {
            background-color: #4d8eff;
            color: #001a42;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: #adc6ff;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-background">
    <!-- TopNavBar -->
    <nav class="flex justify-between items-center w-full px-margin h-16 z-50 fixed top-0 bg-surface-container-low border-b border-outline-variant">
        <div class="flex items-center gap-8">
            <span class="text-headline-md font-headline-md font-bold text-primary tracking-tight">GMITE</span>
            <div class="hidden md:flex gap-6">
                <!-- Links updated for Executive usage -->
                <a class="hover:text-primary transition-colors font-label-caps text-label-caps {{ Request::is('/') ? 'text-primary' : 'text-on-surface-variant' }}" href="/">Terminal</a>
                <a class="hover:text-primary transition-colors font-label-caps text-label-caps {{ Request::is('analytics') ? 'text-primary' : 'text-on-surface-variant' }}" href="/analytics">Intelligence</a>
                <a class="hover:text-primary transition-colors font-label-caps text-label-caps {{ Request::is('trade-oversight') ? 'text-primary' : 'text-on-surface-variant' }}" href="/trade-oversight">Global Trade</a>
                <a class="hover:text-primary transition-colors font-label-caps text-label-caps {{ Request::is('compliance') ? 'text-primary' : 'text-on-surface-variant' }}" href="/compliance">Compliance</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="hidden lg:flex items-center bg-surface-container-high px-4 py-1.5 rounded-full border border-outline-variant">
                <span class="material-symbols-outlined text-sm text-on-surface-variant mr-2">search</span>
                <input type="text" placeholder="Global Search..." class="bg-transparent border-none focus:ring-0 text-sm text-on-surface w-48"/>
            </div>
            <span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:text-primary relative font-bold">
                notifications
                <span class="absolute top-0 right-0 w-2 h-2 bg-error rounded-full animate-pulse"></span>
            </span>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 px-4 py-2 bg-white/5 rounded-xl border border-white/10">
                    <div class="text-right">
                         <div class="text-[10px] font-black text-white uppercase tracking-tighter">Global Executive Director</div>
                         <div class="text-[8px] font-bold text-secondary uppercase tracking-widest">Master Admin Access</div>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-secondary/10 border border-secondary/20 flex items-center justify-center text-secondary shadow-[0_0_15px_rgba(78,222,163,0.15)]">
                        <span class="material-symbols-outlined text-sm">person</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-[0_4px_15px_rgba(239,68,68,0.1)]" title="Terminate Session">
                        <span class="material-symbols-outlined text-sm">logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- SideNavBar -->
    <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-64 bg-surface-container-low border-r border-outline-variant flex flex-col py-4 px-2 z-40 hidden md:flex">
        <div class="px-4 mb-6">
            <div class="text-label-caps font-label-caps text-primary opacity-80 letter-spacing-widest">EXECUTIVE INTELLIGENCE SUITE</div>
            <div class="text-body-md font-bold text-on-background mt-1 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-secondary grow-0 shadow-[0_0_8px_#4edea3]"></span>
                Global Executive Director
            </div>
        </div>
        <nav class="flex-1 space-y-1 overflow-y-auto">
            <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('/') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined">home</span>
                <span class="text-label-caps font-label-caps">Executive Home</span>
            </a>
            <a href="{{ route('admin.control_center') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/control-center') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/control-center') ? 'text-primary' : '' }}">dashboard</span>
                <span class="text-label-caps font-label-caps">Control Center</span>
            </a>
            <a href="/mineral-governance" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('mineral-governance') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined">diamond</span>
                <span class="text-label-caps font-label-caps">Minerals</span>
            </a>
            <a href="{{ route('admin.trade_market') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/trade-market') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/trade-market') ? 'text-primary' : '' }}">currency_exchange</span>
                <span class="text-label-caps font-label-caps">Trade Market</span>
            </a>
            <a href="/intelligence-map" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('intelligence-map') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined">map</span>
                <span class="text-label-caps font-label-caps">GIS Map</span>
            </a>
            <a href="{{ route('admin.analytics') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/analytics') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/analytics') ? 'text-primary' : '' }}">query_stats</span>
                <span class="text-label-caps font-label-caps">Analytics</span>
            </a>
            <a href="{{ route('admin.compliance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/compliance') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/compliance') ? 'text-primary' : '' }}">gavel</span>
                <span class="text-label-caps font-label-caps">Compliance</span>
            </a>
            
            <!-- 💰 MOCC Revenue Assurance Terminal -->
            <a href="{{ route('admin.revenue.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg border border-secondary/10 bg-secondary/5 mt-2 cursor-pointer transition-all {{ Request::is('admin/revenue*') ? 'sidebar-item-active' : 'text-secondary/80 hover:text-secondary hover:bg-secondary/10' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/revenue*') ? 'text-secondary' : '' }}">payments</span>
                <span class="text-label-caps font-label-caps font-black tracking-tight">Revenue Assurance</span>
            </a>

            <a href="/laboratory" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('laboratory') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined">science</span>
                <span class="text-label-caps font-label-caps">Laboratory</span>
            </a>
            
            <!-- 🧪 Layer 2 & 3 Integration -->
            <a href="{{ route('admin.samples.receiving') }}" class="flex items-center gap-3 px-8 py-2 rounded-lg cursor-pointer transition-all {{ Request::is('admin/samples/receiving') ? 'text-primary border-l-2 border-primary ml-1' : 'text-on-surface-variant/60 hover:text-primary' }}">
                <span class="material-symbols-outlined text-sm">qr_code_scanner</span>
                <span class="text-[10px] font-bold uppercase tracking-widest">Sample Intake</span>
            </a>
            <a href="{{ route('admin.samples.certification') }}" class="flex items-center gap-3 px-8 py-2 rounded-lg cursor-pointer transition-all {{ Request::is('admin/samples/certification') ? 'text-primary border-l-2 border-primary ml-1' : 'text-on-surface-variant/60 hover:text-primary' }}">
                <span class="material-symbols-outlined text-sm">verified_user</span>
                <span class="text-[10px] font-bold uppercase tracking-widest">Certification</span>
            </a>
            <a href="{{ route('admin.users_management') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/users') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/users') ? 'text-primary' : '' }}">group</span>
                <span class="text-label-caps font-label-caps">Users & Roles</span>
            </a>
            <a href="{{ route('admin.alerts_center') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/alerts-center') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/alerts-center') ? 'text-primary' : '' }}">security</span>
                <span class="text-label-caps font-label-caps">Alerts Center</span>
            </a>
            <a href="{{ route('admin.configuration') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all {{ Request::is('admin/configuration') ? 'sidebar-item-active' : 'text-on-surface-variant hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined {{ Request::is('admin/configuration') ? 'text-primary' : '' }}">settings</span>
                <span class="text-label-caps font-label-caps">Settings</span>
            </a>
        </nav>
        <div class="mt-auto border-t border-outline-variant pt-4 space-y-1">
            <div class="px-4 py-2 flex items-center justify-between text-[10px] uppercase font-bold opacity-60">
                <span>System Status</span>
                <span class="text-secondary">Optimal</span>
            </div>
            <div class="flex items-center gap-3 px-4 py-2 text-on-surface-variant hover:text-on-surface cursor-pointer">
                <span class="material-symbols-outlined text-sm">sensors</span>
                <span class="text-label-caps font-label-caps">Uptime: 99.99%</span>
            </div>
        </div>
    </aside>

    <!-- Main Content Canvas -->
    <main class="md:ml-64 mt-16 p-6 pb-20 space-y-6">
        <!-- Live Alert Ticker -->
        <div class="w-full bg-surface-container-lowest border border-outline-variant h-10 flex items-center overflow-hidden relative">
            <div class="absolute left-0 top-0 h-full px-4 bg-tertiary-container text-on-tertiary-container flex items-center z-10 font-bold text-label-caps">
                ALERTS
            </div>
            <div class="ticker-scroll whitespace-nowrap flex gap-12 text-body-md text-on-surface">
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-error animate-pulse"></span> CRITICAL: Copper supply delay in Port of Antofagasta</span>
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-secondary"></span> MARKET: Gold surges +2.4% on geopolitical risk</span>
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-tertiary"></span> LOGISTICS: Lithium shipment L742 verified at Shanghai Hub</span>
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-error"></span> ALERT: Nickel trading halted in LME due to volatility</span>
            </div>
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 w-full flex justify-between items-center px-6 py-2 z-50 bg-surface-container-lowest border-t border-outline-variant text-[10px]">
        <div class="text-on-surface-variant font-label-caps">© 2026 GMITE ECOSYSTEM — TRANS-GLOBAL MINERAL AUTHORITY. ALL RIGHTS RESERVED.</div>
        <div class="flex gap-6 items-center">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary shadow-[0_0_5px_#4edea3]"></span>
                <span class="text-secondary font-label-caps font-bold">API OPERATIONAL</span>
            </div>
            <span class="text-on-surface-variant font-label-caps cursor-pointer hover:text-primary transition-colors">REGULATORY DISCLOSURE</span>
            <span class="text-on-surface-variant font-label-caps cursor-pointer hover:text-primary transition-colors">SECURITY PROTOCOLS</span>
        </div>
    </footer>
</body>
</html>
