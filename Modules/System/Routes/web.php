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

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/system')->name('dashboard.')->group(function() {
    Route::get('/', 'SystemController@index')->name('system');
    Route::get('/packages', 'SystemController@packages')->name('system.packages');
    Route::get('/status-report', 'SystemController@statusReport')->name('system.status-report');

    // Route::get('backup', BackupStatusesController::class.'@index')->name('backup.index');
    Route::get('backup', BackupController::class.'@index')->name('backup.index');
    
    Route::get('backups', BackupController::class.'@backups')->name('backups.index');
    Route::post('backups', BackupController::class.'@create')->name('backups.create');
    Route::delete('backups', BackupController::class.'@delete')->name('backups.delete');
    
    Route::get('download-backup', BackupDownloadController::class)->name('backup.download');
    
    Route::get('backup-statuses', BackupController::class.'@backupStatuses')->name('backup.statuses');
    Route::post('clean-backups', BackupCleanController::class)->name('backup.clean');

    Route::get('/commands', 'SystemController@indexCommands')->name('system.commands');
    Route::post('/commands', 'SystemController@runCommand')->name('system.commands');

    // Route::get('backup', 'BackupsController@index')->name('backup.index');
    // Route::put('backup/create', 'BackupController@create')->name('backup.store');
    // Route::get('backup/download/{file_name?}', 'BackupController@download')->name('backup.download');
    // Route::delete('backup/delete/{file_name?}', 'BackupController@delete')->where('file_name', '(.*)')->name('backup.destroy');
});

Route::middleware(['auth', 'verified', 'activity'])->prefix('dashboard/system')->name('dashboard.')->group(function() {
    Route::get('/logs', 'LogViewerController@index')->name('logs.index');
    Route::get('/logs/listlogs', 'LogViewerController@listLogs')->name('logs.listlogs');
    Route::get('/logs/{date}', 'LogViewerController@show')->name('logs.show');

    Route::get('/logs/{date}/download', 'LogViewerController@download')->name('logs.download');
    Route::post('/logs/{date}/delete', 'LogViewerController@delete')->name('logs.delete');

    Route::get('/jobs', 'JobController@index')->name('jobs.index');

    // php artisan queue
    // Route::get('/queue-work', 'SystemController@queueWork')->name('queue.work');

});

Route::middleware(['web', 'auth', 'verified'])->prefix('dashboard/system/activities')->name('dashboard.')->group(function() {
    // Dashboards
    Route::get('/', 'ActivityController@index')->name('activities.index');
    Route::get('/cleared', ['uses' => 'ActivityController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'ActivityController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'ActivityController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'ActivityController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'ActivityController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'ActivityController@restoreClearedActivityLog'])->name('restore-activity');
});