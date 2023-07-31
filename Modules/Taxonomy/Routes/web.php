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

use Illuminate\Support\Facades\Route;

Route::prefix('taxonomy')->group(function() {
    Route::get('/', 'TaxonomyController@index');
});

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/taxonomy')->name('dashboard.')->group(function() {
	Route::get('/', 'TaxonomyController@index')->name('taxonomy');
    Route::resource('taxonomy_types', 'TaxonomyTypeController');
    Route::resource('taxonomy_terms', 'TaxonomyTermController');
});

Route::middleware(['activity'])->group(function() {
    // Front-End Routes
    Route::get('terms', 'TaxonomyController@terms')->name('taxonomy_terms');
    Route::get('terms/{slug}', 'TaxonomyController@showTerm')->name('taxonomy_terms.show');

});