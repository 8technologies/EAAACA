<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OnlineStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // if ($request->user()->cannot('viewAny', User::class)) {
        //     return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        // }

        if(($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/User/Index', []);
        }
    }

    /**
     * Fetch resources from the database.
     *
     * @return \$data
     */
    public function getData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';
        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'last_seen';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = User::with('roles', 'media')
                ->filter($request->all())
                ->search($query)
                ->whereNotNull('last_seen')
                // ->orderBy('last_seen', 'DESC')
                ->orderBy($sort_by, $sort_type)
                ->paginate($limit)
                ->withQueryString();

        $data->each(function($model) {
            $model->append(['user_online']);
        });

        return $data;
    }

}
