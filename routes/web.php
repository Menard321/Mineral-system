<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * PUBLIC LANDING PAGE (Sovereign & Enterprise Entry)
 */
Route::get('/', function () {
    return view('welcome');
});


/**
 * SECURE AUTHENTICATION TERMINAL
 */
Route::get('/login', function () {
    if (session('admin_authenticated')) {
        return redirect('/dashboard');
    }
    return view('admin.login');
})->name('login');

Route::post('/admin/authenticate', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Specified Credentials Check
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
 * PROTECTED INTELLIGENCE & ADMINISTRATION
 * Restricted Access: Mandatory Admin Login Required
 */
Route::middleware(['web'])->group(function () {
    
    // Protection Interceptor Logic
    $protect = function ($view) {
        if (!session('admin_authenticated')) return redirect('/login');
        return view($view);
    };

    // Intelligence Portal (Executive Level)
    Route::get('/dashboard', function () use ($protect) {
        return $protect('generaldashboard');
    })->name('dashboard');

    Route::get('/mineral-atlas', function () use ($protect) {
        return $protect('mineral_atlas');
    })->name('atlas');

    Route::get('/intelligence-map', function () use ($protect) {
        return $protect('intelligence_map');
    });

    Route::get('/analytics', function () use ($protect) {
        return $protect('analytics');
    });

    Route::get('/trade-oversight', function () use ($protect) {
        return $protect('trade_oversight');
    });

    Route::get('/mineral-governance', function () use ($protect) {
        return $protect('mineral_governance');
    });

    Route::get('/compliance', function () use ($protect) {
        return $protect('compliance');
    });

    Route::get('/laboratory', function () use ($protect) {
        return $protect('laboratory');
    });

    // Administrative Control Center (Management Level)
    Route::group(['prefix' => 'admin'], function () use ($protect) {
        Route::get('/', function () { return redirect('/dashboard'); });
        
        Route::get('/dashboard', function () use ($protect) {
            return $protect('dashboard'); // This refers to the original 'admin dashboard'
        });

        Route::get('/users', function () use ($protect) { return $protect('users'); });
        Route::get('/security', function () use ($protect) { return $protect('security'); });
        Route::get('/reporting', function () use ($protect) { return $protect('reporting'); });
        Route::get('/configuration', function () use ($protect) { return $protect('configuration'); });
    });
});
