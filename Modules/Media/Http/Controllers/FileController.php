<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Media\Entities\Media as File;
use Modules\Media\Entities\MediaUploader;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', File::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Media/File/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMy(Request $request)
    {
        if ($request->user()->cannot('viewAny', File::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $request['user'] = Auth::user()->id;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            $user = Auth::user();
            $entity = [
                'data' => $user
            ];
            return Inertia::render('Core/Profile/IndexMyFiles', $entity);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request, $userId)
    {
        if ($request->user()->cannot('viewAny', File::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $request['user'] = $userId;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            $user = User::findOrFail($userId);
            $entity = [
                'data' => $user
            ];
            return Inertia::render('Core/User/IndexUserFiles', $entity);
        }
    }

    /**
     * Pass the request object and query the database.
     *
     * @return \$data
     */
    public function getData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = File::
            with('user')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();

        $data->each(function($item) {
            $item->append(['file_url', 'entity_permissions', 'download_link']);
        });

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', File::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Media/File/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', File::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();
        $name = $data['name'];
        $description = $data['file_description'];

        // Validate results
        Validator::make($data, [
            'file' => ['required'],
            'user_id' => ['required'],
        ])->validate();

        if (!isset($data['name'])) {
            $name = $data['file']->getClientOriginalName();
        }

        if (!isset($data['description'])) {
            $description = '';
        }

        // dd( $data );

        $fileTypeCategory = getMimeTypeCategory($data['file']->getMimeType());
        $uploadFolder = Str::plural($fileTypeCategory);

        // $entity = MediaUploader::fromUrl();

        // dd($uploadFolder);
        // Upload Media
        $entity = MediaUploader::fromFile($data['file'])
            // ->useFileName('custom-file-name.jpeg')
            ->useUploadFolder($uploadFolder)
            ->useFileDescription($description)
            ->useUserId($data['user_id'])
            ->useName($name)
            ->upload();
        
        $statusText = 'File "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = File::with('user')
            ->findOrFail($id)
            ->append(['file_size', 'file_icon', 'file_url', 'file_preview', 'download_link']);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Media/File/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = File::with('user')
            ->findOrFail($id)
            ->append(['file_size', 'file_icon', 'file_url', 'file_preview']);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Media/File/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = File::with('user')
            ->findOrFail($id)
            ->append(['file_size', 'file_icon', 'file_url', 'file_preview']);
        
        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'name' => ['required', 'min:3', 'max:255'],
        ])->validate();

        $entity->fill($data)->save();
        $statusText = 'File "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $entity = File::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'File "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }







    // /**
    //  * Force the file to download
    //  */
    // public function download(Request $request, $id)
    // {
    //     $file = File::where('id', $id)->first();

    //     if(!$file) {
    //         abort(404);
    //     }

    //     $path = $file->getPath();

    //     if ($file->disk == 'private') {
    //         if(!File::exists(storage_path('app/private/'.($path)))) {
    //             return response()->json([
    //                 'error' => 'File does not exist'
    //             ], 404);
    //         }
    
    //         // Force the file to download
    //         return Response::download(storage_path('app/private/'.($path)));
    //     }

    //     if (Storage::disk('public')->exists($path)) {
    //         return Response::download('storage/' . $path);
    //     }

    //     return response()->json([
    //         'error' => 'File does not exist'
    //     ], 404);

    // }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function stream(Request $request, $id)
    {
        $entity = File::findOrFail($id);

        $entityPath = $entity->getFullPath();
 
        if (!File::exists($entityPath)) {
            abort(404);
        }

        $stream = new \App\Helpers\VideoStream($entityPath);
        // dd( $stream );

        return response()->stream(function() use ($stream) {
            $stream->start();
        });
    }

}
