<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMITE | Sample Archive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #000; color: #fff; font-family: 'Rajdhani', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .neon-border { border: 1px solid rgba(255, 215, 0, 0.3); box-shadow: 0 0 15px rgba(255, 215, 0, 0.1); }
    </style>
</head>
<body class="p-8">
    <div class="max-w-6xl mx-auto">
        <header class="flex justify-between items-center mb-12 border-b border-yellow-500/20 pb-6">
            <div>
                <h1 class="text-3xl font-bold font-['Orbitron'] text-yellow-500 tracking-tighter">SAMPLE ARCHIVE</h1>
                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Digital Identity Repository</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-white/10 text-xs uppercase tracking-widest hover:bg-white/5 transition-all">Portal Alpha</a>
                <a href="{{ route('user.samples.register') }}" class="px-6 py-2 bg-yellow-500 text-black font-bold text-xs uppercase tracking-widest hover:bg-yellow-400 transition-all shadow-lg">New Registration</a>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-yellow-500/10 border border-yellow-500/50 text-yellow-500 p-4 rounded mb-8 text-sm uppercase tracking-widest">
                {{ session('success') }}
            </div>
        @endif

        <!-- Sample Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($samples as $sample)
                <div class="glass p-6 rounded-lg neon-border relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-2 bg-yellow-500/10 text-yellow-500 text-[10px] uppercase font-bold tracking-tighter">
                        {{ $sample->status }}
                    </div>
                    
                    <div class="mb-4">
                        <span class="text-[10px] text-gray-500 uppercase block tracking-widest">Digital ID</span>
                        <h3 class="text-lg font-bold text-white font-['Orbitron'] tracking-tighter">{{ $sample->sample_id }}</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase block">Mineral</span>
                            <span class="text-sm text-yellow-500 font-bold uppercase">{{ $sample->mineral_type }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase block">Category</span>
                            <span class="text-sm text-white uppercase">{{ $sample->mineral_category }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase block">Weight</span>
                            <span class="text-sm text-white">{{ $sample->estimated_weight }} KG</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-500 uppercase block">Status</span>
                            <span class="text-xs text-yellow-500 uppercase tracking-tighter">{{ $sample->status }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-white/5">
                        <div class="flex items-center space-x-2">
                             <div class="w-8 h-8 bg-white/5 rounded flex items-center justify-center">
                                 <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                             </div>
                             <span class="text-[10px] text-gray-500 uppercase">View QR Terminal</span>
                        </div>
                        <button class="text-[10px] uppercase text-yellow-500 hover:tracking-widest transition-all">Full Intelligence →</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
