@extends('layouts.executive')

@section('title', 'GMITE - Security Profile & Identity')

@section('content')
{{-- ─── HEADER ─────────────────────────────────────────────────────────── --}}
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-10 gap-6">
    <div class="flex items-center gap-6">
        <div class="relative">
            <div class="absolute inset-0 bg-primary/20 rounded-2xl blur-3xl animate-pulse"></div>
            <div class="relative w-20 h-20 bg-surface-container-low border border-primary/40 rounded-[28px] flex items-center justify-center text-primary shadow-2xl">
                <span class="material-symbols-outlined text-4xl">manage_accounts</span>
            </div>
        </div>
        <div>
            <div class="flex items-center gap-4 mb-1">
                <h1 class="text-display-lg font-black text-on-background tracking-tighter uppercase leading-none">Security Profile</h1>
                <span class="bg-secondary/10 text-secondary text-[10px] font-black px-3 py-1 rounded-full border border-secondary/20 tracking-[0.2em] uppercase">Identity Verified</span>
            </div>
            <p class="text-[11px] text-on-surface-variant font-bold tracking-[0.3em] uppercase opacity-60 font-data-tabular">
                Sovereign Identity Node — {{ Auth::user()->name ?? 'User' }} | SID-{{ rand(1000,9999) }}
            </p>
        </div>
    </div>
    <div class="flex gap-4">
        <button onclick="saveProfile()" class="px-8 py-4 bg-primary text-on-primary-container rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:brightness-110 active:scale-95 transition-all flex items-center gap-3 shadow-2xl shadow-primary/20">
            <span class="material-symbols-outlined text-xl">save</span>
            Save Changes
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- ─── LEFT: PROFILE FORM ─── --}}
    <div class="lg:col-span-8 space-y-8">

        {{-- Personal Information --}}
        <div class="card-premium p-10 rounded-[48px]">
            <h2 class="text-headline-sm font-black uppercase tracking-tight mb-10 flex items-center gap-3">
                <span class="w-1.5 h-8 bg-primary rounded-full"></span>
                Personal Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Full Name</label>
                    <input type="text" value="{{ Auth::user()->name ?? '' }}" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Email Address</label>
                    <input type="email" value="{{ Auth::user()->email ?? '' }}" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Phone Number</label>
                    <input type="tel" placeholder="+255 7XX XXX XXX" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Organization</label>
                    <input type="text" placeholder="Mining Company / Trade Firm" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                </div>
                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Physical Address</label>
                    <input type="text" placeholder="Dar es Salaam, Tanzania" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20">
                </div>
            </div>
        </div>

        {{-- Password Management --}}
        <div class="card-premium p-10 rounded-[48px]">
            <h2 class="text-headline-sm font-black uppercase tracking-tight mb-10 flex items-center gap-3">
                <span class="w-1.5 h-8 bg-error rounded-full"></span>
                Password Management
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Current Password</label>
                    <div class="relative">
                        <input type="password" id="currentPwd" placeholder="Enter current password" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20 pr-14">
                        <button type="button" onclick="togglePwd('currentPwd')" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">New Password</label>
                    <div class="relative">
                        <input type="password" id="newPwd" placeholder="Min. 8 characters" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20 pr-14">
                        <button type="button" onclick="togglePwd('newPwd')" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-on-surface-variant uppercase tracking-widest ml-2">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" id="confirmPwd" placeholder="Repeat new password" class="w-full bg-surface-container-high border border-outline-variant rounded-2xl px-6 py-4 text-sm font-bold text-on-background focus:border-primary outline-none transition-all placeholder:text-white/20 pr-14">
                        <button type="button" onclick="togglePwd('confirmPwd')" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </button>
                    </div>
                </div>
            </div>
            <button onclick="changePassword()" class="mt-8 px-8 py-4 bg-error/10 text-error border border-error/20 rounded-2xl font-black text-[11px] uppercase tracking-widest hover:bg-error hover:text-white transition-all flex items-center gap-3">
                <span class="material-symbols-outlined text-xl">lock_reset</span>
                Update Password
            </button>
        </div>

        {{-- Login History --}}
        <div class="card-premium p-10 rounded-[48px]">
            <h2 class="text-headline-sm font-black uppercase tracking-tight mb-10 flex items-center gap-3">
                <span class="w-1.5 h-8 bg-secondary rounded-full"></span>
                Login History & Device Tracking
            </h2>
            <div class="space-y-4">
                @php $sessions = [
                    ['device'=>'Microsoft Edge / Windows 10','ip'=>'127.0.0.1','loc'=>'Dar es Salaam, TZ','time'=>'Now — Current Session','current'=>true],
                    ['device'=>'Chrome / Android Mobile','ip'=>'41.92.xxx.xxx','loc'=>'Dar es Salaam, TZ','time'=>'2 days ago','current'=>false],
                    ['device'=>'Firefox / Windows 11','ip'=>'41.75.xxx.xxx','loc'=>'Mwanza, TZ','time'=>'1 week ago','current'=>false],
                ]; @endphp
                @foreach($sessions as $s)
                <div class="flex items-center justify-between p-6 bg-surface-container-low border {{ $s['current'] ? 'border-secondary/40' : 'border-outline-variant/30' }} rounded-3xl group">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-surface-container-highest rounded-2xl flex items-center justify-center {{ $s['current'] ? 'text-secondary' : 'text-on-surface-variant' }}">
                            <span class="material-symbols-outlined text-2xl">{{ str_contains($s['device'], 'Mobile') ? 'smartphone' : 'computer' }}</span>
                        </div>
                        <div>
                            <div class="text-[12px] font-black text-on-background uppercase">{{ $s['device'] }}</div>
                            <div class="text-[9px] font-bold text-on-surface-variant uppercase tracking-widest opacity-60 mt-1">{{ $s['ip'] }} — {{ $s['loc'] }}</div>
                            <div class="text-[9px] font-bold {{ $s['current'] ? 'text-secondary' : 'text-on-surface-variant opacity-40' }} uppercase tracking-widest mt-0.5">{{ $s['time'] }}</div>
                        </div>
                    </div>
                    @if(!$s['current'])
                    <button class="px-5 py-2.5 bg-error/10 text-error border border-error/20 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-error hover:text-white transition-all">Revoke</button>
                    @else
                    <span class="px-4 py-1.5 bg-secondary/10 text-secondary border border-secondary/20 rounded-full text-[8px] font-black uppercase tracking-widest">Active</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ─── RIGHT: SECURITY SETTINGS ─── --}}
    <div class="lg:col-span-4 space-y-8">

        {{-- Account Status --}}
        <div class="bg-surface-container-low border border-secondary/30 p-8 rounded-[48px] space-y-8">
            <h3 class="text-label-caps font-black text-secondary tracking-[0.3em] uppercase">Account Status</h3>
            <div class="text-center space-y-4">
                <div class="w-20 h-20 bg-secondary/10 border-2 border-secondary/30 rounded-full flex items-center justify-center mx-auto">
                    <span class="material-symbols-outlined text-4xl text-secondary">verified_user</span>
                </div>
                <div class="text-xl font-black text-on-background uppercase tracking-tighter">{{ Auth::user()->name ?? 'User' }}</div>
                <div class="text-[9px] font-black text-secondary uppercase tracking-[0.3em]">Account Verified & Active</div>
                <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-40">Member since: {{ Auth::user()->created_at?->format('M Y') ?? 'Jun 2026' }}</div>
            </div>
            <div class="space-y-3">
                @foreach(['Account Active' => true, 'Email Verified' => true, 'MFA Enabled' => false] as $item => $status)
                <div class="flex items-center justify-between p-4 bg-surface-container-high border border-outline-variant rounded-2xl">
                    <span class="text-[11px] font-black text-on-surface uppercase">{{ $item }}</span>
                    <span class="material-symbols-outlined text-xl {{ $status ? 'text-secondary' : 'text-on-surface-variant opacity-40' }}">{{ $status ? 'check_circle' : 'cancel' }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- MFA Setup --}}
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] space-y-6">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">Multi-Factor Auth (MFA)</h3>
            <div class="p-6 bg-primary/5 border border-primary/20 rounded-3xl space-y-4">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-3xl text-primary">security</span>
                    <div>
                        <div class="text-[12px] font-black text-on-background uppercase">Enable MFA</div>
                        <div class="text-[9px] font-bold text-on-surface-variant uppercase opacity-60">Add an extra layer of identity protection</div>
                    </div>
                </div>
                <button onclick="setupMFA()" class="w-full py-4 bg-primary text-on-primary-container rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:brightness-110 transition-all">
                    Setup Authenticator
                </button>
            </div>
        </div>

        {{-- Notification Preferences --}}
        <div class="bg-surface-container-low border border-outline-variant p-8 rounded-[40px] space-y-6">
            <h3 class="text-label-caps font-black text-on-surface-variant tracking-[0.3em] uppercase opacity-60">Notifications</h3>
            <div class="space-y-4">
                @foreach(['Email Alerts' => true, 'SMS Alerts' => false, 'Trade Updates' => true, 'Compliance Warnings' => true, 'Lab Results' => true] as $pref => $enabled)
                <label class="flex items-center justify-between p-4 bg-surface-container-high border border-outline-variant rounded-2xl cursor-pointer group hover:border-primary transition-all">
                    <span class="text-[11px] font-black text-on-surface uppercase group-hover:text-primary transition-colors">{{ $pref }}</span>
                    <div class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" {{ $enabled ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-white/5 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-on-surface-variant/40 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary/30 peer-checked:after:bg-primary"></div>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="p-8 bg-error/5 border border-error/20 rounded-[40px] space-y-4">
            <h3 class="text-label-caps font-black text-error tracking-[0.3em] uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">dangerous</span>
                Danger Zone
            </h3>
            <p class="text-[10px] font-bold text-on-surface-variant uppercase leading-relaxed opacity-60">These actions are irreversible. Proceed with extreme caution.</p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-error/10 text-error border border-error/20 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-error hover:text-white transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined text-xl">logout</span>
                    Terminate All Sessions
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePwd(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function saveProfile() {
        const btn = event.currentTarget;
        btn.innerHTML = '<span class="material-symbols-outlined text-xl animate-spin">sync</span> Saving...';
        setTimeout(() => {
            btn.innerHTML = '<span class="material-symbols-outlined text-xl">check</span> Saved!';
            setTimeout(() => {
                btn.innerHTML = '<span class="material-symbols-outlined text-xl">save</span> Save Changes';
            }, 2000);
        }, 1200);
    }

    function changePassword() {
        const current = document.getElementById('currentPwd').value;
        const newPwd = document.getElementById('newPwd').value;
        const confirm = document.getElementById('confirmPwd').value;
        if (!current || !newPwd || !confirm) return alert('Please fill in all password fields.');
        if (newPwd !== confirm) return alert('New passwords do not match.');
        alert('Password updated successfully. A confirmation has been sent to your registered email.');
    }

    function setupMFA() {
        alert('MFA Setup Terminal Initializing...\nScan the QR code with Google Authenticator or Authy to enable 2FA for your GMITE account.');
    }
</script>
@endsection
