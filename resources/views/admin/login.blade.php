<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>GMITE - Secure Admin Access</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#adc6ff",
                        "background": "#000000",
                        "surface": "#0C0D10",
                        "secondary": "#4edea3",
                    }
                },
            },
        }
    </script>
    <style>
        body { background-color: #000; color: #e3e2e5; font-family: 'Inter', sans-serif; }
        .glass-login { background: rgba(12, 13, 16, 0.8); backdrop-filter: blur(40px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .glow-cyan { box-shadow: 0 0 50px rgba(173, 198, 255, 0.1); }
    </style>
</head>
<body class="bg-background flex items-center justify-center min-h-screen relative overflow-hidden">
    <!-- Animated background accents -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-secondary/5 rounded-full blur-[120px]"></div>

    <div class="w-full max-w-md p-8 glass-login rounded-[32px] relative z-10 shadow-2xl glow-cyan animate-in fade-in zoom-in duration-500">
        <div class="text-center mb-10">
            <div class="inline-flex w-20 h-20 bg-primary/10 border border-primary/20 rounded-3xl items-center justify-center mb-6">
                <span class="material-symbols-outlined text-primary text-4xl">admin_panel_settings</span>
            </div>
            <h1 class="text-3xl font-black text-white tracking-tighter uppercase">Admin Authentication</h1>
            <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.3em] mt-2">Secure Administrative Terminal</p>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-3 animate-bounce">
            <span class="material-symbols-outlined text-red-400 text-sm">lock</span>
            <span class="text-[11px] font-bold text-red-400 uppercase tracking-widest">{{ session('error') }}</span>
        </div>
        @endif

        <form action="/admin/authenticate" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="text-[10px] font-black text-white/40 uppercase tracking-widest mb-3 block ml-1">Terminal identity</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-primary transition-colors">person</span>
                    <input type="text" name="username" placeholder="Username" required
                           class="w-full bg-[#1A1C22] border border-white/5 rounded-2xl pl-14 pr-6 py-4 text-[13px] text-white outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black text-white/40 uppercase tracking-widest mb-3 block ml-1">Access Protocol (Key)</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-white/20 group-focus-within:text-primary transition-colors">lock</span>
                    <input type="password" name="password" placeholder="Password" required
                           class="w-full bg-[#1A1C22] border border-white/5 rounded-2xl pl-14 pr-6 py-4 text-[13px] text-white outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all">
                </div>
            </div>

            <button type="submit" class="w-full py-5 bg-primary text-black font-black text-[12px] uppercase tracking-[0.2em] rounded-2xl hover:brightness-110 active:scale-[0.98] transition-all shadow-[0_8px_30px_rgba(173,198,255,0.2)] mt-8">
                Initiate Secure Access
            </button>
        </form>

        <div class="mt-12 text-center">
            <a href="/" class="text-[10px] font-bold text-white/30 hover:text-white uppercase tracking-widest flex items-center justify-center gap-2 transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Return to Portal
            </a>
        </div>
    </div>
</body>
</html>
