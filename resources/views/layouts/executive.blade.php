<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'GMITE Executive - Intelligence Portal')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/dashboard/shared.css') }}" rel="stylesheet"/>
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
    {{-- External shared.css handles core styles --}}
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
            
            <!-- ADMIN SECURE GATEWAY (Unified) -->
            <a href="/" class="flex items-center gap-3 group outline-none">
                <div class="text-right hidden md:block">
                    <div class="text-[9px] font-bold text-white/40 uppercase tracking-widest leading-none mb-1">Restricted</div>
                    <div class="text-[10px] font-black text-white uppercase tracking-tighter">Unified Login</div>
                </div>
                <div class="w-10 h-10 rounded-lg bg-primary/10 border border-primary/20 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-black transition-all shadow-[0_4px_15px_rgba(173,198,255,0.1)]">
                    <span class="material-symbols-outlined text-xl">admin_panel_settings</span>
                </div>
            </a>
        </div>
    </nav>

    <!-- SECURE ADMIN GATEWAY TERMINAL (MODAL) -->
    <div id="admin-terminal" class="fixed inset-0 z-[1000] hidden flex items-center justify-center p-6 bg-black/80 backdrop-blur-2xl">
        <div class="w-full max-w-sm p-10 bg-[#0C0D10] border border-white/5 rounded-[40px] shadow-2xl relative animate-in zoom-in duration-300">
            <button onclick="toggleAdminTerminal(false)" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-red-500 transition-all text-white/40 hover:text-white">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>

            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl border border-primary/20 flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-primary text-3xl">lock</span>
                </div>
                <h3 class="text-xl font-black text-white uppercase tracking-tighter">Admin Entry</h3>
                <p class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-1">Level 4 Clearance Required</p>
            </div>

            <form action="/admin/authenticate" method="POST" class="space-y-4">
                @csrf
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-primary transition-colors text-sm">person</span>
                    <input type="text" name="username" placeholder="Master ID" required
                           class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-[11px] text-white outline-none focus:border-primary transition-all">
                </div>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-primary transition-colors text-sm">key</span>
                    <input type="password" name="password" placeholder="Access Key" required
                           class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-[11px] text-white outline-none focus:border-primary transition-all">
                </div>
                <button type="submit" class="w-full py-4 bg-primary text-black font-black text-[11px] uppercase tracking-widest rounded-xl hover:brightness-110 active:scale-95 transition-all mt-4">
                    Authenticate Session
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-1 overflow-hidden">
        <!-- Fintech-Grade Intelligence Sidebar -->
        <aside class="w-64 border-r border-white/5 bg-surface flex flex-col py-6 overflow-y-auto shrink-0 shadow-[20px_0_40px_rgba(0,0,0,0.4)]">
            <div class="px-6 mb-10">
                 <div class="text-[9px] font-black text-white/30 uppercase tracking-[0.4em] mb-4 font-label-caps flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary/40"></span>
                    Operational Core
                 </div>
            </div>
            
            <nav class="space-y-0.5 px-3">
                <a href="/dashboard" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('dashboard') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">grid_view</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Dashboard</span>
                </a>
                
                <a href="/samples" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('samples*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">science</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Samples Center</span>
                </a>

                <a href="{{ route('user.trades.index') }}" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('trades*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">ship</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Trade Intel</span>
                </a>

                <a href="/certificates" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('certificates*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">workspace_premium</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Certificates</span>
                </a>

                <!-- MOCC Specific Intelligence (Admin Only) -->
                @if(session('admin_authenticated'))
                <a href="{{ route('admin.revenue.index') }}" class="flex items-center gap-4 px-5 py-3.5 rounded-xl border border-secondary/10 bg-secondary/5 mt-4 transition-all {{ Request::is('admin/revenue*') ? 'executive-sidebar-active' : 'text-secondary/60 hover:text-secondary hover:bg-secondary/10' }}">
                    <span class="material-symbols-outlined text-xl">payments</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Revenue (MOCC)</span>
                </a>
                @endif

                <a href="/user-analytics" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('user-analytics*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">analytics</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Analytics</span>
                </a>

                <a href="/business" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('business*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">business</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Business Hub</span>
                </a>

                <a href="/investor" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('investor*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">attach_money</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Investor Hub</span>
                </a>

                <div class="h-px bg-white/5 mx-5 my-6"></div>
                <div class="px-5 mb-4">
                    <div class="text-[9px] font-black text-white/30 uppercase tracking-[0.4em] font-label-caps">Compliance & Safety</div>
                </div>

                <a href="/vault" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('vault*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">folder_managed</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Doc Vault</span>
                </a>

                <a href="/compliance-status" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('compliance-status*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">gavel</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Compliance</span>
                </a>

                <a href="/user-alerts" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('user-alerts*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">notifications_active</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Alerts Center</span>
                </a>

                <div class="h-px bg-white/5 mx-5 my-6"></div>

                <a href="/profile" class="flex items-center gap-4 px-5 py-3.5 rounded-xl transition-all {{ Request::is('profile*') ? 'executive-sidebar-active' : 'text-white/40 hover:text-white hover:bg-white/5' }}">
                    <span class="material-symbols-outlined text-xl">account_circle</span>
                    <span class="text-[11px] font-black uppercase tracking-widest">Security Profile</span>
                </a>
            </nav>
            
            <div class="mt-auto px-6 py-10 space-y-4">
                 <!-- Sovereign Logout Terminal -->
                 <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full h-12 flex items-center justify-center gap-3 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-[0_10px_30px_rgba(239,68,68,0.2)] group cursor-pointer">
                        <span class="material-symbols-outlined text-lg group-hover:rotate-180 transition-transform duration-700">power_settings_new</span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em]">Terminate Node</span>
                    </button>
                 </form>
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
    <script>
        function toggleAdminTerminal(show) {
            const terminal = document.getElementById('admin-terminal');
            if (show) {
                terminal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                terminal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</body>
</html>
