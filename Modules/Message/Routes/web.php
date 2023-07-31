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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/messages')->name('dashboard.')->group(function() {
    Route::resource('contact_messages', 'ContactMessageController');
    Route::resource('user-messages', 'MessageController');
    Route::get('users/{id}/contact_messages', 'ContactMessageController@indexUser')->name('users.contact_messages');
});

Route::middleware(['activity'])->prefix('messages')->name('messages.')->group(function() {
    Route::resource('contact', 'ContactMessages');
});
