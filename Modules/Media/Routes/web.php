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
use Modules\Media\Entities\Media as File;

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard')->name('dashboard.')->group(function() {
	Route::get('media/', 'MediaController@index')->name('media');
    // User Files
    Route::get('users/{id}/files', 'FileController@indexUser')->name('users.files');
});

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/media')->name('dashboard.media.')->group(function() {
    Route::resource('files', 'FileController');
    Route::resource('videos', 'MediaVideoController');
    Route::resource('providers', 'MediaProviderController');
});

// Profile Routes
Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('user/files', 'FileController@indexMy')->name('user.files');
});

Route::middleware(['activity'])->group(function () {
    // Route::get('download/{id}', 'FileController@download')->name('download');
    Route::get('stream/{id}', 'FileController@stream')->name('stream');
    Route::get('storage/videos/{id}/{name}', 'FileController@stream')->name('stream-videos');    

    Route::get('/secure-files/{filePath}/download', 'SecureFilesController@download')->where(['filePath' => '.*'])->name('download');
    Route::get('/secure-files/{filePath}', 'SecureFilesController@fileServe')->where(['filePath' => '.*']);
});
