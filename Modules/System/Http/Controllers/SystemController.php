<?php

namespace Modules\System\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Modules\System\Entities\SystemModel;
use Modules\System\System;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Cache;

class SystemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $data = [];
        $data['laravelEnv'] = Cache::remember("LaravelEnv", now()->addMinutes(5), function () {
            return System::getLaravelEnv();
        });
        $data['serverEnv'] = Cache::remember("ServerEnv", now()->addMinutes(5), function () {
            return System::getServerEnv();
        });

        return Inertia::render('Core/System/Index', ['data' => $data]);
    }

    public function packages(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $data = [];

        $data['composerArray'] = System::getComposerArray();
        $data['packages'] = System::getPackagesAndDependencies($data['composerArray']['require']);
        $data['laravelEnv'] = System::getLaravelEnv();
        $data['serverEnv'] = System::getServerEnv();
        $data['serverExtras'] = System::getServerExtras();
        $data['laravelExtras'] = System::getLaravelExtras();
        $data['extraStats'] = System::getExtraStats();

        return Inertia::render('Core/System/IndexPackages', ['data' => $data]);
    }

    public function statusReport(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $data = [];

        $data['composerArray'] = System::getComposerArray();
        $data['packages'] = System::getPackagesAndDependencies($data['composerArray']['require']);
        $data['laravelEnv'] = System::getLaravelEnv();
        $data['serverEnv'] = System::getServerEnv();
        $data['serverExtras'] = System::getServerExtras();
        $data['laravelExtras'] = System::getLaravelExtras();
        $data['extraStats'] = System::getExtraStats();

        return Inertia::render('Core/System/IndexStatusReport', ['data' => $data]);
    }







    public function indexCommands(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $data = [];

        return Inertia::render('Core/System/IndexCommands', ['data' => $data]);
    }

    public function runCommand(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }
        // ini_set('memory_limit', 1);
        // nohup php artisan queue:work --daemon &
        // $process = new Process(['php artisan queue:restart']);
        // dd( $process->run() );

        // $process = new Process(['ls', '-lsa']);
        // $process = new Process(['ls']);
        // $process = new Process(['php artisan storage:link']);

        // $process = Process::fromShellCommandline('php artisan queue:restart');
        // $process = Process::fromShellCommandline('php artisan storage:link');
        $process = Process::fromShellCommandline($request['command']);
        
        $process->setWorkingDirectory(base_path());
        $process->run(null, ['HOME' => base_path()]);
        
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        
        // dd( $process->getOutput() );

        // dd( shell_exec('php artisan queue:work') );
        // dd( Artisan::call('queue:work --daemon --sleep=15 --tries=3 --timeout=120 --memory=128') );
        // $response = Artisan::call('queue:work', []);
        $statusText = $process->getOutput() ;

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
