<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMITE Admin | Sample Intake</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body { background: #050510; color: #fff; font-family: 'Rajdhani', sans-serif; }
        .terminal-panel { background: #000; border: 1px solid #1e293b; box-shadow: 0 0 40px rgba(0, 0, 0, 0.5); }
        .row-hover:hover { background: rgba(59, 130, 246, 0.05); }
    </style>
</head>
<body class="p-8">
    <div class="max-w-7xl mx-auto">
        <header class="flex justify-between items-center mb-8 border-b-2 border-blue-500/10 pb-4">
            <div>
                <h1 class="text-2xl font-bold font-['Orbitron'] text-blue-400">SAMPLE INTAKE TERMINAL</h1>
                <p class="text-xs text-gray-500 uppercase tracking-widest">Digital Layer 2: Physical Chain-of-Custody</p>
            </div>
            <div class="bg-blue-500/10 px-4 py-2 rounded border border-blue-500/20">
                <span class="text-xs text-blue-400 font-bold uppercase">Officer: Master Admin</span>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/40 text-green-400 p-3 rounded mb-6 text-xs uppercase tracking-widest">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Receiving Queue -->
            <div class="lg:col-span-2">
                <div class="terminal-panel rounded-lg overflow-hidden">
                    <div class="bg-blue-500/10 p-4 border-b border-white/5">
                        <h2 class="text-xs font-bold uppercase tracking-widest">Pending Verification Queue</h2>
                    </div>
                    <table class="w-full text-left">
                        <thead class="text-[10px] uppercase text-gray-500 border-b border-white/5">
                            <tr>
                                <th class="p-4">Digital ID</th>
                                <th class="p-4">Mineral</th>
                                <th class="p-4">Registrant</th>
                                <th class="p-4">Est. Weight</th>
                                <th class="p-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($samples as $sample)
                                <tr class="border-b border-white/5 row-hover transition-all">
                                    <td class="p-4 font-['Orbitron'] text-blue-300">{{ $sample->sample_id }}</td>
                                    <td class="p-4 uppercase">{{ $sample->mineral_type }}</td>
                                    <td class="p-4 text-gray-400">{{ $sample->user->name ?? 'Unknown' }}</td>
                                    <td class="p-4">{{ $sample->estimated_weight }} KG</td>
                                    <td class="p-4">
                                        <button onclick="openIntake('{{ $sample->id }}', '{{ $sample->sample_id }}')" class="bg-blue-500 hover:bg-blue-600 text-black px-3 py-1 rounded text-[10px] font-bold uppercase tracking-tighter transition-all">
                                            Initiate Intake
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Scanner & Manual Entry -->
            <div class="space-y-6">
                <!-- Mock Scanner -->
                <div class="terminal-panel p-6 rounded-lg border-blue-500/30">
                    <h3 class="text-xs font-bold uppercase mb-4 text-blue-400">QR Command Center</h3>
                    <div class="aspect-square bg-blue-500/5 rounded border-2 border-dashed border-blue-500/20 flex flex-col items-center justify-center p-8 text-center">
                        <svg class="w-16 h-16 text-blue-500/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        <p class="text-[10px] uppercase text-gray-600 tracking-[3px]">Awaiting Scan Pulse...</p>
                    </div>
                </div>

                <!-- Intake Form (Modal in UX, simple here) -->
                <div id="intake-form" class="terminal-panel p-6 rounded-lg opacity-50 pointer-events-none transition-all border-l-4 border-blue-500">
                    <h3 class="text-xs font-bold uppercase mb-4 text-white">Verification: <span id="target-id" class="text-blue-400">NO_TARGET</span></h3>
                    <form id="action-form" action="" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-[10px] uppercase text-gray-500 block mb-1">Actual Verified Weight (kg)</label>
                            <input type="number" step="0.001" name="actual_weight" class="w-full bg-black border border-white/10 p-2 rounded text-sm outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="text-[10px] uppercase text-gray-500 block mb-1">Physical Condition</label>
                            <select name="physical_condition" class="w-full bg-black border border-white/10 p-2 rounded text-sm outline-none focus:border-blue-500 text-gray-400">
                                <option value="GOOD">Condition Good (Sealed)</option>
                                <option value="DAMAGED">Packaging Damaged</option>
                                <option value="CONTAMINATED">Possible Contamination</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] uppercase text-gray-500 block mb-1">Storage Assignment</label>
                            <select name="storage_location" class="w-full bg-black border border-white/10 p-2 rounded text-sm outline-none focus:border-blue-500 text-gray-400">
                                <option value="VAULT_A">Secure Vault A</option>
                                <option value="LAB_STAGE">Lab Staging Area</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 text-black py-4 rounded font-bold uppercase text-[10px] tracking-widest hover:bg-blue-400 transition-all">
                            Finalize Legal Custody
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openIntake(id, sid) {
            document.getElementById('intake-form').classList.remove('opacity-50', 'pointer-events-none');
            document.getElementById('target-id').innerText = sid;
            document.getElementById('action-form').action = "/admin/samples/receive/" + id;
        }
    </script>
</body>
</html>
