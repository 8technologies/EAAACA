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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard')->name('dashboard.')->group(function() {
    Route::resource('notifications', 'NotificationController');
    // User Notifications
    Route::get('users/{id}/notifications', 'NotificationController@indexUser')->name('users.notifications');
});

// Profile Notifications
Route::middleware(['auth', 'verified', 'activity'])->group(function () {
    Route::get('user/notifications', 'NotificationController@indexMy')->name('user.notifications');
    Route::get('user/notifications/mark-as-read', 'NotificationController@indexMarkAsRead')->name('user.notifications.markasread');
    Route::get('user/notifications/delete-all', 'NotificationController@indexDeleteAll')->name('user.notifications.deleteall');
});