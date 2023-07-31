<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Custom\Entities\ForumCategory;
use App\Models\User;

class ForumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', ForumCategory::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Custom/ForumCategory/Index', []);
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

        $data = ForumCategory::
                search($query)
                ->orderBy($sort_by, $sort_type)
                ->paginate($limit)
                ->withQueryString();

        // $data->each(function($model) {
        //     $model->append(['entity_permissions']);
        // });

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', ForumCategory::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Custom/ForumCategory/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', ForumCategory::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        // Validate results
        Validator::make($data, [
            'name' => ['required'],
        ])->validate();

        $entity = ForumCategory::create($data);
        $statusText = 'Forum Categoryhas been saved';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.forum-categories.index')->with('success', $statusText);
        // return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = ForumCategory::findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/ForumCategory/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = ForumCategory::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/ForumCategory/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = ForumCategory::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'name' => ['required'],
        ])->validate();

        $entity->fill($data)->save();
        $statusText = 'Forum Category"' . $entity['id'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity->fieldable)->setStatusCode(200, $statusText);
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
        $entity = ForumCategory::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }
        $statusText = 'Forum Category"' . $entity['id'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.forum-categories.index')->with('success', $statusText);
        // return Redirect::back()->with('success', $statusText);
    }
}
