<?php

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

// Route::prefix('block')->group(function() {
//     Route::get('/', 'BlockController@index');
// });

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard')->name('dashboard.')->group(function() {
	// Route::get('/', 'BlockController@index')->name('blocks');
    Route::resource('blocks', 'BlockController');
});



Route::middleware(['activity'])->group(function() {
    // Front-End Routes
    Route::get('/front-slider', 'BlockDataController@getFrontSliderData');
});