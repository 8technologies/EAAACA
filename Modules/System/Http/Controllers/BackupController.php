<?php

namespace Modules\System\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Illuminate\Support\Facades\Cache;
use Modules\System\Entities\SystemModel;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Helpers\Format;
use Modules\System\Jobs\CreateBackupJob;
use Modules\System\Rules\BackupDisk;
use Modules\System\Rules\PathToZip;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $data = [];
        $data['backup_statuses'] = $this->backupStatuses();

        return Inertia::render('Core/System/Backup/Index', ['data' => $data]);
    }

    public function backupStatuses()
    {
        return  BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'))
            ->map(function (BackupDestinationStatus $backupDestinationStatus) {
                return [
                    'name' => $backupDestinationStatus->backupDestination()->backupName(),
                    'disk' => $backupDestinationStatus->backupDestination()->diskName(),
                    'reachable' => $backupDestinationStatus->backupDestination()->isReachable(),
                    'healthy' => $backupDestinationStatus->isHealthy(),
                    'amount' => $backupDestinationStatus->backupDestination()->backups()->count(),
                    'newest' => $backupDestinationStatus->backupDestination()->newestBackup()
                        ? $backupDestinationStatus->backupDestination()->newestBackup()->date()->diffForHumans()
                        : __('No backups present'),
                    'usedStorage' => Format::humanReadableSize($backupDestinationStatus->backupDestination()->usedStorage()),
                ];
            })
            ->values()
            ->toArray();
    }

    public function backups(Request $request)
    {
        $validated = $request->validate([
            'disk' => ['required', new BackupDisk()],
        ]);

        $backupDestination = BackupDestination::create($validated['disk'], config('backup.backup.name'));

        return $backupDestination
            ->backups()
            ->map(function (Backup $backup) {
                $size = method_exists($backup, 'sizeInBytes') ? $backup->sizeInBytes() : $backup->size();

                return [
                    'path' => $backup->path(),
                    'date' => $backup->date()->format('Y-m-d H:i:s'),
                    'size' => Format::humanReadableSize($size),
                ];
            })
            ->toArray();
    }

    public function create(Request $request)
    {
        $option = $request->input('option', '');

        dispatch(new CreateBackupJob($option))->onQueue('default');

        return Redirect::back()->with('success', 'Backup Job has been dispatched successfull');
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'disk' => new BackupDisk(),
            'path' => ['required', new PathToZip()],
        ]);

        $backupDestination = BackupDestination::create($validated['disk'], config('backup.backup.name'));

        $backupDestination
            ->backups()
            ->first(function (Backup $backup) use ($validated) {
                return $backup->path() === $validated['path'];
            })
            ->delete();
        
        return Redirect::back()->with('success', 'Deleted successfully');
    }

}
