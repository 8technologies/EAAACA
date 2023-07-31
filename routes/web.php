<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Nwidart\Modules\Facades\Module;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('front');

Route::get('/dashboard/administration', function () {
    return Inertia::render('Core/System/IndexAdministration');
})->name('dashboard.administration');

Route::get('/dashboard/settings', function () {
    return Inertia::render('Core/System/IndexSettings');
})->name('dashboard.settings');

//	Artisan commands

Route::get('/clear-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    // Artisan::call('route:cache');
    return "Cache, Config, route and View caches cleared";
});

Route::get('/link-storage', function () {
    $exitCode = Artisan::call('storage:link', [] );
    echo $exitCode; // 0 exit code for no errors.
});

// composer dump-autoload

Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return "route Cache is cleared";
});

Route::get('/optimize', function() {
    Artisan::call('optimize');
    return "optimized";
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return "View Cache is cleared";
});

Route::get('/config-clear', function() {
    Artisan::call('config:clear');
    return "config Cache is cleared";
});

Route::middleware(['auth:sanctum', 'verified', 'activity'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// fallback as Wildcard routes page
if (Module::collections()->has('Content')) {
    Route::fallback('\Modules\Content\Http\Controllers\ContentController@showPage')->name('page');
}
