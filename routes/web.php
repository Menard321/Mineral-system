<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

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
    if ($username === 'GMITE mineral' && $password === '@menard123') {
        session(['admin_authenticated' => true]);
        return redirect('/admin/dashboard');
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
        
        Route::get('/dashboard', function () use ($protect) {
            return $protect('dashboard'); // Admin-only management dashboard
        })->name('admin.dashboard');

        Route::get('/users', function () use ($protect) { return $protect('users'); });
        Route::get('/security', function () use ($protect) { return $protect('security'); });
        Route::get('/reporting', function () use ($protect) { return $protect('reporting'); });
        Route::get('/configuration', function () use ($protect) { return $protect('configuration'); });
    });
});
