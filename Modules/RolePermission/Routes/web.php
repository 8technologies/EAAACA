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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/roles-permissions')->name('dashboard.')->group(function() {
    Route::get('/', 'RolePermissionController@index')->name('roles-permissions');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('permission_types', 'PermissionTypeController');
    Route::resource('models', 'ModelController');
    // Roles
    Route::get('roles/{id}/users', 'RoleController@indexUser')->name('roles.users');
    Route::get('roles/{id}/permissions', 'RoleController@indexPermission')->name('roles.permissions');
    // Models
    Route::get('models/{id}/permissions', 'ModelController@indexPermission')->name('models.permissions');
});
