<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMITE | Digital Sample Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-gold: #FFD700;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        body {
            background: radial-gradient(circle at top right, #0a0a1a, #000000);
            color: #e0e0e0;
            font-family: 'Rajdhani', sans-serif;
            min-height: 100vh;
        }
        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.8);
        }
        .neon-text {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        .form-input {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 215, 0, 0.2);
            transition: all 0.3s ease;
        }
        .form-input:focus {
            border-color: var(--neon-gold);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="p-4 md:p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <header class="mb-12 flex justify-between items-end border-b border-yellow-500/20 pb-6">
            <div>
                <h1 class="text-4xl font-bold font-['Orbitron'] text-yellow-500 tracking-wider uppercase neon-text">
                    Digital Sample Terminal
                </h1>
                <p class="text-gray-400 mt-2 uppercase tracking-widest text-sm">Layer 1: Sovereign Specimen Entry</p>
            </div>
            <a href="{{ route('user.samples.index') }}" class="text-xs text-yellow-500/60 hover:text-yellow-500 transition-all uppercase tracking-tighter">
                ← Return to Archive
            </a>
        </header>

        <!-- Registration Form -->
        <form action="{{ route('user.samples.store') }}" method="POST" class="glass-panel rounded-2xl p-8 space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Section 1: Mineral Identity -->
                <div class="space-y-6">
                    <h3 class="text-yellow-500/80 uppercase font-bold tracking-widest text-xs border-l-2 border-yellow-500 pl-3">I. Mineral Identity</h3>
                    
                    <div>
                        <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">Mineral Type</label>
                        <select name="mineral_type" class="w-full p-3 rounded bg-black/60 border border-yellow-500/20 text-yellow-500 focus:border-yellow-500 transition-all outline-none">
                            <option value="Gold">Gold (Au)</option>
                            <option value="Lithium">Lithium (Li)</option>
                            <option value="Copper">Copper (Cu)</option>
                            <option value="Diamond">Diamond (C)</option>
                            <option value="Nickel">Nickel (Ni)</option>
                            <option value="Tanzanite">Tanzanite</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">Processing Category</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center space-x-2 bg-black/40 p-3 rounded border border-white/5 cursor-pointer hover:border-yellow-500/40 transition-all">
                                <input type="radio" name="mineral_category" value="Raw Ore" class="accent-yellow-500" checked>
                                <span class="text-sm">Raw Ore</span>
                            </label>
                            <label class="flex items-center space-x-2 bg-black/40 p-3 rounded border border-white/5 cursor-pointer hover:border-yellow-500/40 transition-all">
                                <input type="radio" name="mineral_category" value="Concentrate" class="accent-yellow-500">
                                <span class="text-sm">Concentrate</span>
                            </label>
                            <label class="flex items-center space-x-2 bg-black/40 p-3 rounded border border-white/5 cursor-pointer hover:border-yellow-500/40 transition-all">
                                <input type="radio" name="mineral_category" value="Refined" class="accent-yellow-500">
                                <span class="text-sm">Refined</span>
                            </label>
                            <label class="flex items-center space-x-2 bg-black/40 p-3 rounded border border-white/5 cursor-pointer hover:border-yellow-500/40 transition-all">
                                <input type="radio" name="mineral_category" value="Alluvial" class="accent-yellow-500">
                                <span class="text-sm">Alluvial</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Origin & Legal -->
                <div class="space-y-6">
                    <h3 class="text-yellow-500/80 uppercase font-bold tracking-widest text-xs border-l-2 border-yellow-500 pl-3">II. Origin & Compliance</h3>
                    
                    <div>
                        <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">Mining License (ML/PML)</label>
                        <input type="text" name="mining_license_number" placeholder="Enter License Number..." required
                               class="w-full p-3 rounded bg-black/60 border border-yellow-500/20 text-white placeholder-gray-700 focus:border-yellow-500 transition-all outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">Estimated Weight (kg)</label>
                            <input type="number" step="0.001" name="estimated_weight" placeholder="0.000" required
                                   class="w-full p-3 rounded bg-black/60 border border-yellow-500/20 text-white placeholder-gray-700 focus:border-yellow-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">Sample Purpose</label>
                            <select name="sample_purpose" class="w-full p-3 rounded bg-black/60 border border-yellow-500/20 text-white focus:border-yellow-500 transition-all outline-none">
                                <option value="Export Certification">Export Cert</option>
                                <option value="Lab Testing">Lab Testing</option>
                                <option value="Grade Valuation">Valuation</option>
                                <option value="Research">Research</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Geolocation -->
            <div class="space-y-6">
                <h3 class="text-yellow-500/80 uppercase font-bold tracking-widest text-xs border-l-2 border-yellow-500 pl-3">III. Extraction Location</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">Collection Site / Shaft ID</label>
                        <input type="text" name="collection_site" placeholder="e.g. Western Zone - Geita Shaft 4..." required
                               class="w-full p-3 rounded bg-black/60 border border-yellow-500/20 text-white placeholder-gray-700 focus:border-yellow-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 mb-2 tracking-tighter">GPS Coordinates (Auto-Calculated)</label>
                        <div class="flex space-x-2">
                            <input type="text" name="gps_coordinates" id="gps" readonly value="-6.1623, 39.2026"
                                   class="w-full p-3 rounded bg-black/80 border border-white/5 text-gray-500 text-sm outline-none">
                            <button type="button" class="bg-yellow-500/10 border border-yellow-500/30 text-yellow-500 px-3 rounded hover:bg-yellow-500/20 transition-all text-xs uppercase cursor-not-allowed">
                                Sync
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 flex justify-between items-center">
                <div class="flex items-center space-x-3 text-gray-500">
                    <svg class="w-5 h-5 text-yellow-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <span class="text-[10px] uppercase tracking-[3px]">Secure Regulatory Submission Point</span>
                </div>
                <button type="submit" class="bg-yellow-500 text-black px-12 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-yellow-400 transition-all shadow-[0_0_20px_rgba(255,215,0,0.3)]">
                    Register Digital Identity
                </button>
            </div>
        </form>

        <!-- Footer -->
        <footer class="mt-8 text-center text-gray-600 text-[10px] uppercase tracking-[5px]">
            GMITE Sovereign Mineral Governance System &copy; 2026
        </footer>
    </div>
</body>
</html>
