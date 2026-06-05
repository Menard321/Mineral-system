@extends('layouts.public')

@section('title', 'GMITE — Transforming Global Mineral Operations')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center pt-20 overflow-hidden hero-gradient">
    <div class="absolute inset-0 z-0">
        <img src="/hero.png" class="w-full h-full object-cover opacity-20 filter grayscale contrast-125" alt="Hero Background">
        <div class="absolute inset-0 bg-gradient-to-b from-dark via-dark/80 to-dark"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div class="space-y-10 reveal-left">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-primary">New Enterprise Release v4.0</span>
            </div>
            
            <h1 class="text-6xl lg:text-8xl font-black font-display tracking-tighter leading-[0.9] text-white">
                Transforming <span class="text-gradient">Digital Operations</span> Through Intelligence.
            </h1>
            
            <p class="text-lg text-white/50 leading-relaxed max-w-xl font-medium">
                The most advanced ecosystem for global mineral traceability, trade compliance, and institutional resource governance. Trusted by 24+ world governments and extraction authorities.
            </p>

            <div class="flex flex-wrap gap-5">
                <a href="/dashboard" class="group relative px-10 py-5 bg-primary text-white font-black text-[12px] uppercase tracking-[0.2em] rounded-full overflow-hidden hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] transition-all transform hover:-translate-y-1">
                    <span class="relative z-10 flex items-center gap-3">
                         Get Started <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </span>
                </a>
                <a href="#features" class="px-10 py-5 bg-white/5 border border-white/10 text-white font-black text-[12px] uppercase tracking-[0.2em] rounded-full hover:bg-white/10 transition-all flex items-center gap-3">
                    Explore Features
                </a>
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
                         <img src="/gold.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100 mineral-slide" alt="Gold Extraction">
                         <img src="/lithium.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 mineral-slide" alt="Lithium Energy">
                         <img src="/copper.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 mineral-slide" alt="Copper Industrial">
                         <img src="/hero.png" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0 mineral-slide" alt="Global Node">
                     </div>
                     
                     <!-- UI Overlay (Scanning effect) -->
                     <div class="absolute inset-0 pointer-events-none">
                         <div class="absolute inset-0 bg-primary/20 mix-blend-overlay"></div>
                         <div class="absolute top-0 left-0 w-full h-[2px] bg-secondary shadow-[0_0_15px_#4edea3] animate-[scan_4s_linear_infinite]"></div>
                         <div class="absolute bottom-8 left-8 right-8 p-4 glass rounded-2xl border border-white/10 flex justify-between items-center z-20">
                             <div class="flex flex-col">
                                 <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Active Extraction</span>
                                 <span id="mineral-name" class="text-xs font-bold text-white uppercase tracking-wider">Awaiting Scan...</span>
                             </div>
                             <div class="flex items-center gap-3">
                                 <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                                 <span class="text-[10px] font-bold text-secondary uppercase">Operational</span>
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
        <div class="text-center mb-24 space-y-4">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.4em] text-primary">Core Ecosystem Verticals</h4>
            <h2 class="text-4xl lg:text-6xl font-black font-display text-white tracking-tighter uppercase leading-none">Global Mineral <span class="text-gradient">Showcase.</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $showcase = [
                    ['title' => 'Strategic Minerals', 'desc' => 'High-precision tracking for Lithium, Copper, and Rare Earth nodes.', 'icon' => 'diamond', 'color' => 'primary'],
                    ['title' => 'Trade Corridors', 'desc' => 'Automated export auditing through global institutional corridors.', 'icon' => 'currency_exchange', 'color' => 'secondary'],
                    ['title' => 'GIS Surveillance', 'desc' => 'Satellite-monitored extraction zones with AI risk detection.', 'icon' => 'public', 'color' => 'accent'],
                ];
            @endphp
            @foreach($showcase as $item)
            <div class="glass-card group p-10 rounded-[32px] hover:-translate-y-4 transition-all duration-500 cursor-pointer overflow-hidden relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $item['color'] }}/10 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-{{ $item['color'] }}/20 transition-colors"></div>
                <div class="w-16 h-16 bg-{{ $item['color'] }}/10 border border-{{ $item['color'] }}/20 rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform">
                     <span class="material-symbols-outlined text-{{ $item['color'] }} text-3xl">{{ $item['icon'] }}</span>
                </div>
                <h3 class="text-2xl font-black text-white mb-4 uppercase tracking-tighter">{{ $item['title'] }}</h3>
                <p class="text-white/40 text-sm leading-relaxed mb-8">{{ $item['desc'] }}</p>
                <div class="flex items-center gap-2 text-[10px] font-bold text-{{ $item['color'] }} uppercase tracking-widest">
                    Live Status: Operational <span class="w-1.5 h-1.5 rounded-full bg-{{ $item['color'] }} animate-pulse"></span>
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
            <div class="space-y-8">
                <h2 class="text-4xl lg:text-6xl font-black font-display text-white tracking-tighter uppercase leading-none">Intelligent <br><span class="text-primary">Resource</span> Management.</h2>
                <p class="text-white/40 leading-relaxed text-lg">Our proprietary AI engines analyze millions of extraction data points every second to ensure 100% compliance across all global trade partners.</p>
                
                <div class="space-y-6 pt-10">
                    @foreach(['AI-Assisted Operations', 'Secure Access Control (PBAC)', 'Automated Compliance Audit'] as $feat)
                    <div class="flex items-center gap-6 group">
                        <div class="w-12 h-12 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center group-hover:border-primary transition-colors">
                             <span class="material-symbols-outlined text-white/40 group-hover:text-primary transition-colors">check_circle</span>
                        </div>
                        <span class="text-lg font-bold text-white uppercase tracking-tight">{{ $feat }}</span>
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
                             <span id="terminal-clock" class="text-[11px] font-bold text-white tabular-nums tracking-widest uppercase">15:12:42 GMT+3</span>
                         </div>

                         <!-- Live Price Grid -->
                         <div class="grid grid-cols-2 gap-4 mb-8">
                             <div class="p-4 bg-white/5 border border-white/10 rounded-2xl">
                                 <div class="text-[9px] font-bold text-white/30 uppercase tracking-widest mb-1">Gold AU-79</div>
                                 <div class="flex items-end justify-between">
                                     <span id="price-gold" class="text-xl font-black text-white tabular-nums">$2,342.12</span>
                                     <span id="trend-gold" class="text-[10px] font-bold text-secondary">▲ 0.12%</span>
                                 </div>
                             </div>
                             <div class="p-4 bg-white/5 border border-white/10 rounded-2xl">
                                 <div class="text-[9px] font-bold text-white/30 uppercase tracking-widest mb-1">Lithium LI-3</div>
                                 <div class="flex items-end justify-between">
                                     <span id="price-lithium" class="text-xl font-black text-primary tabular-nums">$14,842.00</span>
                                     <span id="trend-lithium" class="text-[10px] font-bold text-primary">▼ 0.05%</span>
                                 </div>
                             </div>
                         </div>

                         <!-- Real-Time Heartbeat Chart -->
                         <div class="flex-1 relative flex items-center justify-center">
                             <div class="absolute inset-0 flex items-end justify-between gap-1 px-2" id="live-bars">
                                 @for($i=0; $i<30; $i++)
                                    <div class="flex-1 bg-primary/20 border-t border-primary/40 rounded-t-sm transition-all duration-300" style="height: {{ rand(20, 80) }}%"></div>
                                 @endfor
                             </div>
                             <!-- Scanning line -->
                             <div class="absolute inset-x-0 h-px bg-primary/50 shadow-[0_0_15px_#3b82f6] top-1/2 -translate-y-1/2 animate-bounce opacity-20"></div>
                         </div>

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
            <a href="/register" class="px-12 py-6 bg-primary text-white font-black text-[13px] uppercase tracking-[0.25em] rounded-full hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] hover:-translate-y-1 transition-all">Request Executive Access</a>
            <a href="/login" class="px-12 py-6 bg-white/5 border border-white/10 text-white font-black text-[13px] uppercase tracking-[0.25em] rounded-full hover:bg-white/10 transition-all">Institutional Login</a>
        </div>
    </div>
</section>

<script>
    // Real-Time Market Terminal Engine
    function updateTerminal() {
        const now = new Date();
        document.getElementById('terminal-clock').textContent = now.toLocaleTimeString('en-GB') + ' GMT+3';
        
        // Random Price Fluctuation (Gold)
        const goldEl = document.getElementById('price-gold');
        const goldTrendEl = document.getElementById('trend-gold');
        let goldPrice = parseFloat(goldEl.textContent.replace('$', '').replace(',', ''));
        let goldChange = (Math.random() * 0.5 - 0.2); // Small tick
        goldPrice += goldChange;
        goldEl.textContent = '$' + goldPrice.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        goldTrendEl.textContent = (goldChange >= 0 ? '▲ ' : '▼ ') + Math.abs(goldChange).toFixed(2) + '%';
        goldTrendEl.className = `text-[10px] font-bold ${goldChange >= 0 ? 'text-secondary' : 'text-error'}`;

        // Random Chart Heartbeat (Updating bars)
        const bars = document.getElementById('live-bars').children;
        for (let i = 0; i < bars.length - 1; i++) {
            bars[i].style.height = bars[i+1].style.height;
        }
        bars[bars.length - 1].style.height = (Math.random() * 60 + 20) + '%';
        bars[bars.length - 1].className = `flex-1 border-t rounded-t-sm transition-all duration-300 ${goldChange >= 0 ? 'bg-secondary/20 border-secondary/40' : 'bg-primary/20 border-primary/40'}`;
    }
    setInterval(updateTerminal, 1000);
    updateTerminal();

    // Mineral Slider Logic
    const slides = document.querySelectorAll('.mineral-slide');
    const nameLabel = document.getElementById('mineral-name');
    const names = ['Gold AU-79 Extraction', 'Lithium Li-3 Energy', 'Copper Cu-29 Industrial', 'Global Asset Intelligence'];
    let currentSlide = 0;

    function rotateMinerals() {
        slides[currentSlide].classList.remove('opacity-100');
        slides[currentSlide].classList.add('opacity-0');
        
        currentSlide = (currentSlide + 1) % slides.length;
        
        slides[currentSlide].classList.remove('opacity-0');
        slides[currentSlide].classList.add('opacity-100');
        nameLabel.textContent = names[currentSlide];
    }
    
    // Initial name
    nameLabel.textContent = names[0];
    setInterval(rotateMinerals, 4000);

    // Parallax & Reveal Script
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        document.querySelectorAll('.reveal-left').forEach(el => {
            const speed = 0.5;
            el.style.transform = `translateX(${scrolled * -0.05}px)`;
            el.style.opacity = 1 - (scrolled / 800);
        });
    });

    // Simple fade-in observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-10');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.glass-card').forEach(card => {
        card.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700');
        observer.observe(card);
    });
</script>
@endsection
