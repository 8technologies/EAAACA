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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard')->name('dashboard.')->group(function() {
    Route::get('/users/online-status', 'OnlineStatusController@index')->name('users.online-status');
    Route::resource('users', 'UserController');
    Route::put('/users/{id}/update-verified', 'UserController@updateVerified')->name('users.update-verified');
    Route::put('/users/{id}/update-enabled', 'UserController@updateEnabled')->name('users.update-enabled');
    Route::put('/users/{id}/update-password', 'UserController@updatePassword')->name('users.update-password');

    Route::get('/users/{id}/edit-profile', 'UserController@editProfile')->name('users.edit-profile');
    Route::put('/users/{id}/update-profile', 'UserController@updateProfile')->name('users.update-profile');

    Route::get('/contact-points', 'UserController@indexContactPoint')->name('contact-points.index');
});

// User related data routes
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function() {
    // Route::resource('users.messages', 'UserMessageController');
    // Route::resource('users.notifications', 'UserNotificationController');
    // Route::resource('users.teams', 'UserTeamController');
});

// Custom profile routes
Route::group(['middleware' => ['auth', 'verified', 'activity']], function () {
    Route::get('/account/edit', 'UserProfileController@accountEdit')->name('account.edit');
    Route::put('/account/update', 'UserProfileController@accountUpdate')->name('account.update');
    Route::put('/account/update-password', 'UserProfileController@accountUpdatePassword')->name('account.updatepassword');

    Route::get('/account/edit-profile', 'UserProfileController@accountEditProfile')->name('account.edit-profile');
    Route::put('/account/update-profile', 'UserProfileController@accountUpdateProfile')->name('account.update-profile');

    Route::post('/account/logoutfromotherdevices', 'UserProfileController@logoutFromOtherDevices')->name('account.logoutfromotherdevices');

	Route::get('/account', 'UserProfileController@show')->name('profile.show');
    Route::get('/account/messages', 'UserProfileController@messages')->name('profile.messages');
    Route::get('/account/notifications', 'UserProfileController@notifications')->name('profile.notifications');
    Route::get('/account/teams', 'UserProfileController@teams')->name('profile.teams');
    Route::get('/account/files', 'UserProfileController@files')->name('profile.files');
    Route::get('/account/sessions', 'UserProfileController@browserSessions')->name('profile.sessions');
});

// Social Oauth Routes
Route::get('auth/social', 'SocialLoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'SocialLoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'SocialLoginController@handleProviderCallback')->name('social.callback');
