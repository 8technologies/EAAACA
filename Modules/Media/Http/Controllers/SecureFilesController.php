<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Illuminate\Support\Facades\Response;
use Modules\Media\Entities\Media as File;

class SecureFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Provide access to a secure file
     */
    public function fileServe(Request $request, $filePath)
    {
        if ($request['action'] == 'download') {

            if(!File::exists(storage_path('app/private/'.($filePath)))) {

                return response()->json([
                    'error' => 'File does not exist'
                ], 404);

            }

            // Force the file to download
            return Response::download(storage_path('app/private/'.($filePath)));
        }

        if (File::exists(storage_path('app/private/'.($filePath)))) {
            return response()->file(storage_path('app/private/'.($filePath)));
        }

        return response()->json([
            'error' => 'File does not exist'
        ], 404);
        
    }


    /**
     * Force the file to download
     */
    public function download(Request $request, $filePath)
    {        
        if(!File::exists(storage_path('app/private/'.($filePath)))) {
            return response()->json([
                'error' => 'File does not exist'
            ], 404);
        }

        // Force the file to download
        return Response::download(storage_path('app/private/'.($filePath)));
    }
}
