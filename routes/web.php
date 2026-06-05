<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * EXECUTIVE INTELLIGENCE PORTAL (General Access)
 */
Route::get('/', function () {
    return view('generaldashboard');
});

Route::get('/homepage', function () {
    return view('generaldashboard');
});

Route::get('/mineral-atlas', function () {
    return view('mineral_atlas');
});

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
 * ADMINISTRATION SYSTEM (Restricted Access)
 */
Route::get('/admin', function () {
    if (session('admin_authenticated')) {
        return redirect('/admin/dashboard');
    }
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/authenticate', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Specified Credentials Check
    if ($username === 'GMITE mineral' && $password === '@menard123') {
        session(['admin_authenticated' => true]);
        return redirect('/admin/dashboard');
    }

    return redirect('/admin')->with('error', 'Authentication Failed: Invalid Credentials');
});

Route::get('/admin/logout', function () {
    session()->forget('admin_authenticated');
    return redirect('/');
});

Route::prefix('admin')->middleware(['web'])->group(function () {
    
    // Protection Middleware Simulation
    Route::get('/dashboard', function () {
        if (!session('admin_authenticated')) return redirect('/admin');
        return view('dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        if (!session('admin_authenticated')) return redirect('/admin');
        return view('users');
    });

    Route::get('/security', function () {
        if (!session('admin_authenticated')) return redirect('/admin');
        return view('security');
    });

    Route::get('/reporting', function () {
        if (!session('admin_authenticated')) return redirect('/admin');
        return view('reporting');
    });

    Route::get('/configuration', function () {
        if (!session('admin_authenticated')) return redirect('/admin');
        return view('configuration');
    });
});
