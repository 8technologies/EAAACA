<?php

namespace Modules\System\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Spatie\Backup\BackupDestination\BackupDestinationFactory;
use Spatie\Backup\Tasks\Cleanup\CleanupJob;
use Spatie\Backup\Tasks\Cleanup\CleanupStrategy;

class BackupCleanController extends Controller
{
    public function __invoke(CleanupStrategy $strategy)
    {
        $backupDestinations = BackupDestinationFactory::createFromArray(config('backup.backup'));

        $cleanupJob = new CleanupJob($backupDestinations, $strategy);

        $cleanupJob->run();

        $this->respondSuccess();
    }
}
