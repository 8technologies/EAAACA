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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/teams-groups')->name('dashboard.')->group(function() {
	Route::get('/', 'TeamGroupController@index')->name('teams-groups');
    Route::resource('teams', 'TeamController');
    Route::resource('teams.members', 'TeamMemberController');
    Route::resource('teams.invites', 'TeamInviteController',
                ['only' => ['index', 'create']]);
    // Users teams
    Route::get('users/{id}/teams', 'TeamController@indexUser')->name('users.teams');
});

// Profile Routes
Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('teams', 'TeamController@myIndex')->name('user.teams');
});