@extends('layouts.executive')

@section('title', 'GMITE - Laboratory Certification')

@section('content')
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
    <div class="flex items-center gap-5">
        <div class="w-14 h-14 bg-primary/10 border border-primary/20 rounded-2xl flex items-center justify-center">
             <span class="material-symbols-outlined text-primary text-3xl">science</span>
        </div>
        <div>
            <h1 class="text-display-lg font-bold text-on-background tracking-tighter">Laboratory & Certification</h1>
            <p class="text-body-md text-on-surface-variant">Mineral testing system and certificate validation.</p>
        </div>
    </div>
    <div class="flex gap-3">
        <button class="btn-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">verified</span>
            Validate Certificate
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Test Queue -->
    <div class="lg:col-span-8 space-y-6">
        <div class="card-premium p-6 rounded-2xl">
            <h2 class="text-headline-sm font-bold mb-6 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">biotech</span>
                Active Testing Queue
            </h2>
            <div class="space-y-4">
                @php
                    $tests = [
                        ['id' => 'LAB-9281', 'sample' => 'Lithium Ore Concent.', 'miner' => 'Albemarle', 'status' => 'ANALYZING', 'purity' => '--'],
                        ['id' => 'LAB-9282', 'sample' => 'Gold Dore Bar', 'miner' => 'AngloGold', 'status' => 'VERIFIED', 'purity' => '99.98%'],
                        ['id' => 'LAB-9283', 'sample' => 'Copper Scrap', 'miner' => 'MetalX', 'status' => 'PENDING', 'purity' => '--'],
                    ];
                @endphp
                @foreach($tests as $test)
                <div class="p-4 bg-surface-container-high rounded-xl border border-outline-variant hover:border-primary transition-all">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-4">
                             <div class="text-[10px] font-bold text-primary">{{ $test['id'] }}</div>
                             <div>
                                <div class="text-[13px] font-bold text-on-background">{{ $test['sample'] }}</div>
                                <div class="text-[10px] text-on-surface-variant">{{ $test['miner'] }}</div>
                             </div>
                        </div>
                        <div class="text-right">
                             <div class="text-xs font-bold {{ $test['status'] == 'VERIFIED' ? 'text-secondary' : 'text-primary' }}">{{ $test['status'] }}</div>
                             <div class="text-[10px] text-on-surface-variant">{{ $test['purity'] != '--' ? 'Purity: '.$test['purity'] : 'Processing...' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="lg:col-span-4 space-y-6">
        <div class="bg-surface-container-low border border-outline-variant p-6 rounded-2xl">
             <h3 class="text-label-caps font-bold text-on-surface-variant mb-6 uppercase">Lab Performance</h3>
             <div class="space-y-4">
                <div class="flex justify-between text-[11px]">
                    <span>Certificates Issued</span>
                    <span class="font-bold">1,242</span>
                </div>
                <div class="flex justify-between text-[11px]">
                    <span>Average Test Time</span>
                    <span class="font-bold text-primary">2.4 Hours</span>
                </div>
                <div class="flex justify-between text-[11px]">
                    <span>Accuracy Rating</span>
                    <span class="font-bold text-secondary">99.99%</span>
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
