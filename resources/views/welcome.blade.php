@extends('layouts.public')

@section('title', 'GMITE — Transforming Global Mineral Operations')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center pt-20 overflow-hidden hero-gradient">
    <div class="absolute inset-0 z-0">
        <img src="/hero_premium.png" class="w-full h-full object-cover opacity-30 filter contrast-125" alt="Hero Background">
        <div class="absolute inset-0 bg-gradient-to-b from-dark via-dark/40 to-dark"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div class="space-y-10 reveal-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-primary">New Enterprise Release v4.0</span>
            </div>
            
            <h1 class="text-6xl lg:text-8xl font-black font-display tracking-tighter leading-[0.9] text-white">
                Verified Minerals.<br>
                <span class="text-gradient">Trusted Trade.</span>
            </h1>
            
            <p class="mt-8 max-w-3xl text-xl text-slate-300">
                A world-class digital platform connecting mineral certification, laboratory intelligence, regulatory compliance, and global trade into one trusted ecosystem.
            </p>
            <div class="flex flex-wrap gap-5">
                <a href="/dashboard" data-action="get-started" class="group relative px-10 py-5 bg-primary text-white font-black text-[12px] uppercase tracking-[0.2em] rounded-full overflow-hidden hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] transition-all transform hover:-translate-y-1">
                    <span class="relative z-10 flex items-center gap-3">Get Started <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span></span>
                </a>
                <a href="#features" data-action="explore-features" class="px-10 py-5 bg-white/5 border border-white/10 text-white font-black text-[12px] uppercase tracking-[0.2em] rounded-full hover:bg-white/10 transition-all flex items-center gap-3">Explore Features</a>
            </div>

            <div class="grid grid-cols-3 gap-10 pt-10 border-t border-white/5">
                <div>
                    <div class="text-3xl font-black text-white font-display tabular-nums">42.8k</div>
                    <div class="text-[9px] font-bold text-white/30 uppercase tracking-widest mt-1">Mining Sites Monitored</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-secondary font-display tabular-nums">$8.4T</div>
                    <div class="text-[9px] font-bold text-white/30 uppercase tracking-widest mt-1">Trade Volume Audited</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-white font-display tabular-nums">100%</div>
                    <div class="text-[9px] font-bold text-white/30 uppercase tracking-widest mt-1">Compliance Accuracy</div>
                </div>
            </div>
        </div>

        <div class="relative hidden lg:block reveal-right">
            <!-- Animated Mineral IQ Slider Container -->
            <div class="relative z-10 glass-card rounded-[40px] p-2 border-white/10 shadow-2xl transform rotate-[-2deg] hover:rotate-0 transition-transform duration-700 overflow-hidden group">
                 <div class="relative aspect-[4/3] rounded-[32px] overflow-hidden">
                     <!-- Extraction Nodes (Rotating) -->
                     <div id="mineral-slider" class="w-full h-full relative">
                         <img src="/lithium_scan.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100 mineral-slide" alt="Lithium Analysis">
                         <img src="/diamond_scan.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 mineral-slide" alt="Diamond Intelligence">
                         <img src="/copper_scan.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 mineral-slide" alt="Copper Auditing">
                         <img src="/hero_premium.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 mineral-slide" alt="Global Node Intelligence">
                     </div>
                     
                      <!-- UI Overlay (Scanning effect) -->
                      <div class="absolute inset-0 pointer-events-none">
                          <div class="absolute inset-0 bg-primary/20 mix-blend-overlay"></div>
                          <div class="absolute top-0 left-0 w-full h-[2px] bg-secondary shadow-[0_0_15px_#4edea3] animate-[scan_4s_linear_infinite]"></div>
                          
                          <!-- Scan Progress Bar (World Class Feature) -->
                          <div class="absolute top-0 left-0 h-1 bg-primary/40 z-30 transition-all duration-[5000ms] linear" id="scan-progress" style="width: 0%"></div>

                          <div class="absolute bottom-8 left-8 right-8 p-4 glass rounded-2xl border border-white/10 flex justify-between items-center z-20">
                              <div class="flex flex-col">
                                  <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Active Extraction Node</span>
                                  <span id="mineral-name" class="text-xs font-bold text-white uppercase tracking-wider">Initializing Terminal...</span>
                              </div>
                              <div class="flex items-center gap-3">
                                  <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                                  <span class="text-[10px] font-bold text-secondary uppercase">Operational Scan</span>
                              </div>
                          </div>
                      </div>
                 </div>
            </div>
            <!-- Floating Accents -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-secondary/20 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
        </div>
    </div>
</section>

<style>
    @keyframes scan {
        0% { top: 0; }
        100% { top: 100%; }
    }
</style>

<!-- Industry Showcase -->
<section id="services" class="py-32 bg-dark">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-28 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 border border-primary/20 rounded-full mb-4 animate-in fade-in slide-in-from-bottom-2 duration-700">
                <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                <span class="text-[9px] font-black uppercase tracking-[0.4em] text-primary">Core Ecosystem Verticals</span>
            </div>
            <h2 class="text-5xl lg:text-7xl font-black font-display text-white tracking-tighter uppercase leading-none">Global Mineral <span class="text-gradient">Showcase.</span></h2>
            <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.5em] mt-4">Enterprise-Grade Intelligence Infrastructure</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @php
                $showcase = [
                    [
                        'title' => 'Strategic Minerals', 
                        'desc' => 'High-precision tracking for Lithium, Copper, and Rare Earth nodes across sovereign extraction zones.', 
                        'icon' => 'diamond', 
                        'color' => 'primary',
                        'stat' => '42.8k Units'
                    ],
                    [
                        'title' => 'Trade Corridors', 
                        'desc' => 'Automated institutional export auditing through secure blockchain-integrated global corridors.', 
                        'icon' => 'currency_exchange', 
                        'color' => 'secondary',
                        'stat' => '$8.4T Audited'
                    ],
                    [
                        'title' => 'GIS Surveillance', 
                        'desc' => 'Military-grade satellite monitoring for extraction zones with AI-driven compliance risk detection.', 
                        'icon' => 'public', 
                        'color' => 'accent',
                        'stat' => 'Live Feed'
                    ],
                ];
            @endphp
            @foreach($showcase as $item)
            <div class="relative group cursor-pointer">
                <!-- Holographic Background Glow -->
                <div class="absolute inset-0 bg-{{ $item['color'] }}/20 rounded-[40px] blur-[80px] opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="glass-card relative z-10 p-12 rounded-[40px] border border-white/5 group-hover:border-{{ $item['color'] }}/40 transition-all duration-500 overflow-hidden group-hover:-translate-y-4 shadow-2xl">
                    <!-- Icon Terminal -->
                    <div class="w-16 h-16 bg-{{ $item['color'] }}/10 border border-{{ $item['color'] }}/20 rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 group-hover:shadow-[0_0_30px_rgba(var(--{{ $item['color'] }}-rgb),0.3)] transition-all">
                         <span class="material-symbols-outlined text-{{ $item['color'] }} text-3xl">{{ $item['icon'] }}</span>
                    </div>

                    <h3 class="text-2xl font-black text-white mb-6 uppercase tracking-tighter leading-tight">{{ $item['title'] }}</h3>
                    <p class="text-white/40 text-sm leading-relaxed mb-10 group-hover:text-white/60 transition-colors">{{ $item['desc'] }}</p>
                    
                    <div class="flex items-center justify-between pt-8 border-t border-white/5">
                        <div class="flex flex-col">
                            <span class="text-[8px] font-black text-white/20 uppercase tracking-[0.2em] mb-1">System Metric</span>
                            <span class="text-[11px] font-bold text-white uppercase tracking-widest">{{ $item['stat'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-{{ $item['color'] }}/10 rounded-full border border-{{ $item['color'] }}/20">
                             <span class="w-1.5 h-1.5 rounded-full bg-{{ $item['color'] }} animate-pulse"></span>
                             <span class="text-[9px] font-black text-{{ $item['color'] }} uppercase tracking-widest">Active</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Deep Dive -->
<section id="features" class="py-32 bg-surface relative">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-[1px] bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-32">
            <div class="space-y-12">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 border border-primary/20 rounded-full mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                        <span class="text-[9px] font-black uppercase tracking-[0.4em] text-primary">Sovereign Management Protocol</span>
                    </div>
                    <h2 class="text-5xl lg:text-7xl font-black font-display text-white tracking-tighter uppercase leading-[0.9]">Intelligent <span class="text-gradient">Resource</span> Management.</h2>
                    <p class="text-white/50 text-base leading-relaxed max-w-xl">Our proprietary AI engines analyze millions of extraction data points every second to ensure 100% compliance across all global trade partners, utilizing advanced predictive modeling for resource longevity.</p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @php
                        $features = [
                            [
                                'title' => 'AI-Assisted Operations', 
                                'desc' => 'Autonomous node optimization utilizing genetic algorithms for maximum extraction efficiency.',
                                'icon' => 'neurology'
                            ],
                            [
                                'title' => 'Secure Access Control (PBAC)', 
                                'desc' => 'Policy-Based Access Control integrated with national digital identities for sovereign security.',
                                'icon' => 'verified_user'
                            ],
                            [
                                'title' => 'Real-Time Auditing', 
                                'desc' => 'Continuous blockchain-backed auditing of every mineral gram from extraction to global export.',
                                'icon' => 'account_balance'
                            ],
                        ];
                    @endphp
                    @foreach($features as $feature)
                    <div class="group flex items-start gap-6 p-6 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-primary/30 transition-all duration-500 cursor-pointer relative overflow-hidden">
                        <div class="absolute inset-y-0 left-0 w-1 bg-primary transform scale-y-0 group-hover:scale-y-100 transition-transform duration-500"></div>
                        <div class="w-14 h-14 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:shadow-[0_0_20px_#3b82f6] transition-all">
                            <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors text-2xl">{{ $feature['icon'] }}</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">{{ $feature['title'] }}</h4>
                            <p class="text-[11px] text-white/40 leading-relaxed group-hover:text-white/60 transition-colors">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <div class="glass-card rounded-[40px] aspect-[4/3] overflow-hidden p-3 border-white/10 shadow-2xl relative z-10 transition-transform duration-700 hover:scale-[1.02]">
                    <!-- REAL-TIME MARKET TERMINAL -->
                    <div class="bg-[#050A15] w-full h-full rounded-[28px] border border-white/5 flex flex-col p-6 overflow-hidden relative">
                         <!-- Terminal Header -->
                         <div class="flex justify-between items-center mb-6">
                             <div class="flex items-center gap-3">
                                 <div class="w-2 h-2 rounded-full bg-secondary animate-pulse shadow-[0_0_8px_#4edea3]"></div>
                                 <span class="text-[10px] font-black text-white/40 uppercase tracking-widest font-display">Live Market Feed • LME SYNC</span>
                             </div>
                            <span id="terminal-clock" class="text-[11px] font-bold text-white tabular-nums tracking-widest uppercase"></span>
                            <script>
                                function updateTerminalTime() {
                                    const now = new Date();
                                    const timeString = now.toLocaleTimeString('en-US', {
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit',
                                        hour12: false,
                                        timeZoneName: 'shortOffset'
                                    });
                                    document.getElementById('terminal-clock').textContent = timeString;
                                }

                                // Update immediately and every second
                                updateTerminalTime();
                                setInterval(updateTerminalTime, 1000);

                            </script>   
    
                         </div>

                        <!-- Live Price Grid -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="p-5 bg-white/5 border border-white/10 rounded-2xl group/price hover:bg-white/10 transition-all cursor-pointer">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="text-[9px] font-black text-white/30 uppercase tracking-[0.2em]">Gold AU-79</div>
                                    <div class="px-2 py-0.5 rounded-md bg-secondary/10 border border-secondary/20 text-[8px] font-black text-secondary uppercase animate-pulse">Live</div>
                                </div>
                                <div class="text-2xl font-black text-white tabular-nums tracking-tighter" id="price-gold">$2,342.12</div>
                                <div class="text-[10px] font-bold text-secondary mt-1" id="trend-gold">▲ 0.12% Today</div>
                            </div>
                            <div class="p-5 bg-white/5 border border-white/10 rounded-2xl group/price hover:bg-white/10 transition-all cursor-pointer">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="text-[9px] font-black text-white/30 uppercase tracking-[0.2em]">Lithium LI-3</div>
                                    <div class="px-2 py-0.5 rounded-md bg-primary/10 border border-primary/20 text-[8px] font-black text-primary uppercase animate-pulse">LME</div>
                                </div>
                                <div class="text-2xl font-black text-white tabular-nums tracking-tighter" id="price-lithium">$14,842.00</div>
                                <div class="text-[10px] font-bold text-primary mt-1" id="trend-lithium">▼ 0.05% Today</div>
                            </div>
                                                <!-- Real-Time Institutional Chart (World Standard Multi-Asset) -->
                        <div class="flex-1 relative flex flex-col justify-center min-h-[160px] bg-dark/40 rounded-2xl border border-white/5 p-4 overflow-hidden">
                            <div class="absolute top-4 left-4 z-20 flex gap-4">
                                <span class="text-[8px] font-black text-primary uppercase tracking-widest flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-primary animate-ping"></span> Global Spot Index</span>
                                <span class="text-[8px] font-black text-white/20 uppercase tracking-widest">Volatility: 0.84%</span>
                            </div>

                            <svg class="w-full h-full preserve-3d" viewBox="0 0 400 150" preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#3b82f6" stop-opacity="0.2" />
                                        <stop offset="100%" stop-color="#3b82f6" stop-opacity="0" />
                                    </linearGradient>
                                    <filter id="glow">
                                        <feGaussianBlur stdDeviation="2.5" result="coloredBlur"/>
                                        <feMerge>
                                            <feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/>
                                        </feMerge>
                                    </filter>
                                </defs>
                                <!-- Grid Lines -->
                                <g stroke="white" stroke-opacity="0.05" stroke-dasharray="2,2">
                                    <line x1="0" y1="37.5" x2="400" y2="37.5" />
                                    <line x1="0" y1="75" x2="400" y2="75" />
                                    <line x1="0" y1="112.5" x2="400" y2="112.5" />
                                </g>

                                <!-- Area Fill -->
                                <path id="chart-area" d="" fill="url(#chartGradient)" class="transition-all duration-1000 ease-in-out" />
                                <!-- Path Line -->
                                <path id="chart-line" d="" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" filter="url(#glow)" class="transition-all duration-1000 ease-in-out" />
                                
                                <!-- Tooltip Indicator -->
                                <circle id="chart-pointer" cx="400" cy="75" r="4" fill="#3b82f6" class="animate-pulse shadow-[0_0_15px_#3b82f6]" />
                            </svg>

                            <!-- Vertical Scanning line -->
                            <div class="absolute inset-y-0 w-px bg-white/10 left-0 transition-all duration-[5000ms] linear" id="chart-scan-line"></div>
                        </div>

                        <!-- Institutional Ticker Marquee -->
                        <div class="mt-6 py-3 bg-white/5 rounded-xl border border-white/10 overflow-hidden relative">
                             <div class="flex animate-[marquee_20s_linear_infinite] whitespace-nowrap gap-8 items-center">
                                 <div class="flex items-center gap-2"><span class="text-[9px] font-black text-white/30 uppercase">Diamond</span> <span class="text-[10px] font-bold text-white tracking-widest">$54,200</span> <span class="text-[8px] text-secondary">▲ 1.4%</span></div>
                                 <div class="flex items-center gap-2"><span class="text-[9px] font-black text-white/30 uppercase">Copper</span> <span class="text-[10px] font-bold text-white tracking-widest">$9,820</span> <span class="text-[8px] text-red-500">▼ 0.3%</span></div>
                                 <div class="flex items-center gap-2"><span class="text-[9px] font-black text-white/30 uppercase">Nickel</span> <span class="text-[10px] font-bold text-white tracking-widest">$18,400</span> <span class="text-[8px] text-secondary">▲ 0.8%</span></div>
                                 <div class="flex items-center gap-2"><span class="text-[9px] font-black text-white/30 uppercase">Iron Ore</span> <span class="text-[10px] font-bold text-white tracking-widest">$115.4</span> <span class="text-[8px] text-red-500">▼ 1.2%</span></div>
                                 <!-- Duplicates for seamless loop -->
                                 <div class="flex items-center gap-2"><span class="text-[9px] font-black text-white/30 uppercase">Diamond</span> <span class="text-[10px] font-bold text-white tracking-widest">$54,200</span> <span class="text-[8px] text-secondary">▲ 1.4%</span></div>
                                 <div class="flex items-center gap-2"><span class="text-[9px] font-black text-white/30 uppercase">Copper</span> <span class="text-[10px] font-bold text-white tracking-widest">$9,820</span> <span class="text-[8px] text-red-500">▼ 0.3%</span></div>
                             </div>
                        </div>  </div>

                         <!-- Terminal Footer -->
                         <div class="mt-8 pt-6 border-t border-white/5 flex justify-between items-center">
                             <div class="flex flex-col">
                                 <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mb-1">Global System Uptime</div>
                                 <div class="text-2xl font-black text-white font-display tabular-nums">99.998%</div>
                             </div>
                             <div class="flex -space-x-2">
                                 @for($i=0; $i<4; $i++)
                                    <div class="w-8 h-8 rounded-full border-2 border-[#050A15] bg-white/10 flex items-center justify-center overflow-hidden">
                                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $i }}" alt="User">
                                    </div>
                                 @endfor
                             </div>
                         </div>
                    </div>
                </div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-primary/10 rounded-full blur-[80px]"></div>
            </div>
        </div>
    </div>
</section>

<!-- Institutional Conversion (CTA) -->
<section class="py-32 relative bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-primary/5"></div>
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10 space-y-12">
        <h2 class="text-5xl lg:text-7xl font-black font-display text-white tracking-tighter uppercase leading-[0.9]">Ready to Experience the <span class="text-primary italic">Future</span> of Mineral Trade?</h2>
        <p class="text-white/50 text-xl leading-relaxed max-w-2xl mx-auto font-medium">Join the global network of sovereign nations and enterprise leaders transforming the future of resource governance.</p>
        
        <div class="flex flex-wrap justify-center gap-6 pt-10">
            <a href="/register" data-action="request-executive-access" class="px-12 py-6 bg-primary text-white font-black text-[13px] uppercase tracking-[0.25em] rounded-full hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] hover:-translate-y-1 transition-all">Request Executive Access</a>
            <a href="/login" data-action="institutional-login" class="px-12 py-6 bg-white/5 border border-white/10 text-white font-black text-[13px] uppercase tracking-[0.25em] rounded-full hover:bg-white/10 transition-all">Institutional Login</a>
        </div>
    </div>
</section>

<script>
    // ---------------------------------------------------------
    // 1. INSTITUTIONAL MARKET TERMINAL ENGINE
    // ---------------------------------------------------------
    const chartLine = document.getElementById('chart-line');
    const chartArea = document.getElementById('chart-area');
    const chartPointer = document.getElementById('chart-pointer');
    const chartScan = document.getElementById('chart-scan-line');
    
    let chartPoints = Array.from({length: 41}, () => 75 + (Math.random() * 40 - 20));

    function updateChart() {
        if (!chartLine || !chartScan) return;

        chartPoints.shift();
        chartPoints.push(75 + (Math.random() * 60 - 30));

        let pathD = "";
        let areaD = "";

        for(let i=0; i<chartPoints.length; i++) {
            let x = i * 10;
            let y = chartPoints[i];
            
            if (i === 0) {
                pathD = `M ${x} ${y}`;
                areaD = `M ${x} 150 L ${x} ${y}`;
            } else {
                pathD += ` L ${x} ${y}`;
                areaD += ` L ${x} ${y}`;
            }

            if(i === chartPoints.length - 1) {
                chartPointer.setAttribute('cx', x);
                chartPointer.setAttribute('cy', y);
                areaD += ` L ${x} 150 Z`;
            }
        }
        
        chartLine.setAttribute('d', pathD);
        chartArea.setAttribute('d', areaD);

        // Reset & Animate Scan Line
        if(parseFloat(chartScan.style.left) >= 95 || !chartScan.style.left) {
            chartScan.style.transition = 'none';
            chartScan.style.left = '0%';
            setTimeout(() => {
                chartScan.style.transition = 'left 5000ms linear';
                chartScan.style.left = '100%';
            }, 50);
        }
    }

    function updateMarketData() {
        const goldEl = document.getElementById('price-gold');
        const lithiumEl = document.getElementById('price-lithium');
        const trendGold = document.getElementById('trend-gold');

        if (!goldEl || !lithiumEl) return;

        const goldPrice = 2340 + (Math.random() * 10);
        const lithiumPrice = 14840 + (Math.random() * 5);
        const goldChange = (Math.random() * 0.4 - 0.2).toFixed(2);
        
        goldEl.textContent = `$${goldPrice.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        lithiumEl.textContent = `$${lithiumPrice.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        
        trendGold.textContent = `${goldChange >= 0 ? '▲' : '▼'} ${Math.abs(goldChange)}% Today`;
        trendGold.className = `text-[10px] font-bold ${goldChange >= 0 ? 'text-secondary' : 'text-red-500'} mt-1`;
        
        updateChart();
    }

    // Initialize Terminal
    setInterval(updateMarketData, 2000);
    updateMarketData();

    // ---------------------------------------------------------
    // 2. SOVEREIGN SCAN ENGINE (HERO SLIDER)
    // ---------------------------------------------------------
    const slides = document.querySelectorAll('.mineral-slide');
    const nameLabel = document.getElementById('mineral-name');
    const progressBar = document.getElementById('scan-progress');
    const names = [
        'Lithium Li-3 High-Purity Scan', 
        'Diamond Asset Valuation Audit', 
        'Copper Cu-29 Industrial Intelligence', 
        'Global Extraction Node v4.2'
    ];
    let currentSlide = 0;

    function resetProgressBar() {
        if (!progressBar) return;
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.transition = 'width 5000ms linear';
            progressBar.style.width = '100%';
        }, 50);
    }

    function rotateMinerals() {
        if (!slides.length) return;

        // Hide current
        slides[currentSlide].style.transition = 'opacity 1s ease-in-out';
        slides[currentSlide].style.opacity = '0';
        
        currentSlide = (currentSlide + 1) % slides.length;
        
        // Update UI State
        if (nameLabel) {
            nameLabel.style.opacity = '0.5';
            nameLabel.textContent = 'Refreshing Node...';
        }
        
        setTimeout(() => {
            slides[currentSlide].style.transition = 'opacity 1s ease-in-out';
            slides[currentSlide].style.opacity = '1';
            
            if (nameLabel) {
                nameLabel.style.opacity = '1';
                nameLabel.textContent = names[currentSlide];
            }
            resetProgressBar();
        }, 800);
    }

    // Start Hero Engine
    if (nameLabel) nameLabel.textContent = names[0];
    resetProgressBar();
    setInterval(rotateMinerals, 5000);

    // ---------------------------------------------------------
    // 3. GLOBAL UI INTERACTORS
    // ---------------------------------------------------------
    // Parallax
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        document.querySelectorAll('.reveal-left').forEach(el => {
            el.style.transform = `translateX(${scrolled * -0.05}px)`;
            el.style.opacity = 1 - (scrolled / 800);
        });
    });

    // Reveal Observer
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.glass-card').forEach(card => {
        card.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
        revealObserver.observe(card);
    });
</script>
@endsection
