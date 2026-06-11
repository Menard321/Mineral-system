<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SampleManagementController;
use App\Http\Controllers\AdminSampleController;
use App\Http\Controllers\CertificatesController;

/**
 * PUBLIC INTELLIGENCE SUITE (De-Restricted & Open Access)
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('generaldashboard');
})->name('dashboard')->middleware('auth');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // Fail-safe fallback for manual entry

Route::get('/events-center', function () {
    return view('events_center');
})->name('miec');

Route::get('/samples/{id}/archive', [AdminSampleController::class, 'archive'])
    ->name('samples.archive');




Route::get('/mineral-atlas', function () {
    return view('mineral_atlas');
})->name('atlas');

Route::get('/intelligence-map', function () {
    return view('intelligence_map');
});

Route::get('/analytics', function () {
    return view('analytics');
});

Route::get('/trade-oversight', function () {
    return view('trade_oversight');
});

Route::get('/mineral-governance', function () {
    return view('mineral_governance');
});

Route::get('/compliance', function () {
    return view('compliance');
});

Route::get('/laboratory', function () {
    return view('laboratory');
});


/**
 * SECURE ADMINISTRATIVE TERMINAL (Restricted Access Only)
 */
Route::get('/login', function () {
    if (session('admin_authenticated')) {
        return redirect('/admin/dashboard');
    }
    return view('admin.login');
})->name('login');

Route::post('/admin/authenticate', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Specified Admin Credentials
    if ($username === 'gmiteadmin@gmail.com' && $password === '@menard123') {
        // Ensure the AdminUser exists in the database
        $admin = \App\Models\AdminUser::where('email', $username)->first();
        
        if (!$admin) {
            // Fallback: Check if the user is in the main users table
            $user = \App\Models\User::where('email', $username)->first();
            if ($user && $user->is_admin) {
                // For legacy support, we can use the main guard or map them (but Compliance expects AdminUser)
                // Let's ensure an AdminUser exists for this master login
                $admin = \App\Models\AdminUser::create([
                    'full_name' => 'GMITE Master Authority',
                    'email' => $username,
                    'password_hash' => \Illuminate\Support\Facades\Hash::make($password),
                    'role_id' => \App\Models\AdminRole::where('role_name', 'SUPER_ADMIN')->first()->id ?? 1,
                    'status' => 'ACTIVE'
                ]);
            }
        }

        if ($admin) {
            \Illuminate\Support\Facades\Auth::guard('admin')->login($admin);
            session(['admin_authenticated' => true]);
            return redirect('/admin/dashboard');
        }
    }

    return redirect('/login')->with('error', 'Authentication Failed: Invalid Credentials');
});

Route::get('/admin/logout', function () {
    session()->forget('admin_authenticated');
    return redirect('/');
});


/**
 * PROTECTED ADMINISTRATIVE CONTROL CENTER
 * Restricted Access: Mandatory Admin Login Required
 */
Route::middleware(['web'])->group(function () {
    
    // Protection Interceptor Logic
    $protect = function ($view) {
        if (!session('admin_authenticated')) return redirect('/login');
        return view($view);
    };

    // Administrative Management Zone
    Route::group(['prefix' => 'admin'], function () use ($protect) {
        Route::get('/', function () { return redirect('/admin/dashboard'); });
        
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/control-center', [AdminDashboardController::class, 'controlCenter'])->name('admin.control_center');
        Route::get('/trade-market', [AdminDashboardController::class, 'tradeMarket'])->name('admin.trade_market');
        Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('admin.analytics');
        Route::get('/compliance', [\App\Http\Controllers\ComplianceEnforcementController::class, 'index'])->name('admin.compliance');
        Route::get('/compliance/case/{case}', [\App\Http\Controllers\ComplianceEnforcementController::class, 'show'])->name('admin.compliance.show');
        Route::post('/compliance/create', [\App\Http\Controllers\ComplianceEnforcementController::class, 'createCase'])->name('admin.compliance.create');
        Route::post('/compliance/action/{case}', [\App\Http\Controllers\ComplianceEnforcementController::class, 'action'])->name('admin.compliance.action');
        Route::post('/compliance/evidence/{case}', [\App\Http\Controllers\ComplianceEnforcementController::class, 'uploadEvidence'])->name('admin.compliance.evidence');

        // 🧪 Refined Sample Management Zone (Layers 2 & 3)
        Route::get('/samples/receiving', [AdminSampleController::class, 'receiving'])->name('admin.samples.receiving');
        Route::post('/samples/receive/{id}', [AdminSampleController::class, 'receive'])->name('admin.samples.receive');
        Route::get('/samples/certification', [AdminSampleController::class, 'certification'])->name('admin.samples.certification');
        Route::post('/samples/approve/{id}', [AdminSampleController::class, 'approve'])->name('admin.samples.approve');

        Route::get('/laboratory', function () use ($protect) { return $protect('laboratory'); })->name('admin.laboratory');
        Route::get('/laboratory/registration', function () use ($protect) { return $protect('laboratory_registration'); })->name('admin.laboratory.registration');
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users_management');
        Route::get('/alerts-center', [AdminDashboardController::class, 'alertsCenter'])->name('admin.alerts_center');
        Route::get('/reporting', function () use ($protect) { return $protect('reporting'); });
        Route::get('/configuration', [AdminDashboardController::class, 'configuration'])->name('admin.configuration');

        // 💰 MOCC Revenue Assurance Control Center
        Route::get('/revenue', [\App\Http\Controllers\MOCCRevenueController::class, 'index'])->name('admin.revenue.index');
    });
});

// ─── USER / EXECUTIVE PORTAL ROUTES ───────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/business', [UserDashboardController::class, 'business'])->name('user.business');
    Route::get('/investor', [UserDashboardController::class, 'investor'])->name('user.investor');
    Route::get('/user-alerts', [UserDashboardController::class, 'alerts'])->name('user.alerts');
    Route::get('/profile', fn() => view('profile'))->name('user.profile');

    // 🟢 Layer 1 Sample Center
    Route::get('/samples', [SampleManagementController::class, 'index'])->name('user.samples.index');
    Route::get('/samples/register', [SampleManagementController::class, 'create'])->name('user.samples.register');
    Route::post('/samples/store', [SampleManagementController::class, 'store'])->name('user.samples.store');
    
    // 🏆 Certificates & Lifecycle Tracking
    Route::get('/certificates', [CertificatesController::class, 'index'])->name('user.certificates');
    Route::get('/certificates/{id}', [CertificatesController::class, 'show'])->name('user.certificates.show');

    Route::get('/user-analytics', fn() => view('generaldashboard'))->name('user.analytics');
    Route::get('/vault', fn() => view('generaldashboard'))->name('user.vault');
    Route::get('/compliance-status', fn() => view('generaldashboard'))->name('user.compliance');

    // 🚢 Export Intelligence & Trade Hub
    Route::get('/trades', [\App\Http\Controllers\TradeRequestController::class, 'index'])->name('user.trades.index');
    Route::get('/trades/create', [\App\Http\Controllers\TradeRequestController::class, 'create'])->name('user.trades.create');
    Route::post('/trades/store', [\App\Http\Controllers\TradeRequestController::class, 'store'])->name('user.trades.store');
});
