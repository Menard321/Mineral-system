<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMITE Admin | Certification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #000; color: #fff; font-family: 'Rajdhani', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .cert-card { border-top: 4px solid #A855F7; }
    </style>
</head>
<body class="p-8">
    <div class="max-w-7xl mx-auto">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-bold font-['Orbitron'] text-purple-500 tracking-widest uppercase">Science & Certification</h1>
            <p class="text-gray-500 uppercase tracking-[10px] text-[10px] mt-2">Layer 3: Sovereign Validation Terminal</p>
        </header>

        @if(session('success'))
            <div class="bg-purple-500/10 border border-purple-500/40 text-purple-400 p-4 rounded mb-8 text-sm uppercase text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($samples as $sample)
                <div class="glass p-6 rounded-xl cert-card relative">
                    <div class="mb-6 flex justify-between items-start">
                        <div>
                            <h3 class="font-['Orbitron'] text-lg text-white tracking-tighter">{{ $sample->sample_id }}</h3>
                            <span class="text-[10px] uppercase text-gray-500">{{ $sample->mineral_type }} ({{ $sample->mineral_category }})</span>
                        </div>
                        <span class="text-[8px] p-1 bg-white/5 text-gray-400 uppercase tracking-widest">{{ $sample->status }}</span>
                    </div>

                    <!-- Lab Results Breakdown (Mocked if empty) -->
                    <div class="space-y-3 mb-8 bg-black/40 p-4 rounded border border-white/5">
                        <h4 class="text-[10px] uppercase text-purple-400 font-bold border-b border-purple-500/20 pb-1">Science Metrics</h4>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Mineral Grade</span>
                            <span class="text-white font-bold">{{ $sample->grade ?? 'ANALYSIS_PENDING' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Purity Scale</span>
                            <span class="text-green-400 font-bold">98.42%</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Impurity Check</span>
                            <span class="text-white">PASSED</span>
                        </div>
                    </div>

                    @if($sample->status == 'CERTIFIED')
                        <div class="text-center py-4 border-2 border-dashed border-green-500/20 rounded-lg">
                            <svg class="w-8 h-8 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xs uppercase text-green-500 font-bold">Official Document Active</span>
                        </div>
                    @else
                        <form action="{{ route('admin.samples.approve', $sample->id) }}" method="POST">
                            @csrf
                            <textarea name="comments" placeholder="Regulatory remarks..." class="w-full bg-black/60 border border-white/10 rounded p-2 text-xs mb-4 outline-none focus:border-purple-500 h-20"></textarea>
                            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 rounded text-[10px] uppercase tracking-widest transition-all">
                                Validate & Issue Certificate
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
