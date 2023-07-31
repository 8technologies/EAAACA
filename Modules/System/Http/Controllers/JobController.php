<?php

namespace Modules\System\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\System\Entities\SystemModel;
use Modules\System\Entities\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', SystemModel::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/System/Job/Index', []);
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

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = Job::
            search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }
}
