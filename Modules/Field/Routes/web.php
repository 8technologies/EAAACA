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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/fields')->name('dashboard.')->group(function() {
	Route::get('/', 'FieldController@index')->name('fields');
    Route::resource('field_titles', 'FieldTitleController');
    Route::resource('field_texts', 'FieldTextController');
    Route::resource('field_images', 'FieldImageController');
    Route::resource('field_links', 'FieldLinkController');
    Route::resource('field_htmls', 'FieldHtmlController');
    Route::resource('field_blocks', 'FieldBlockController');
});
