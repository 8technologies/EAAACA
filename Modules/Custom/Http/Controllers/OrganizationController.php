<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Custom\Entities\Organization;
use Modules\User\Http\Controllers\UserController;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Organization::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Custom/Organization/Index', []);
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

        $data = Organization::
        with('media', 'user', 'member_state')
        ->withCount('cases', 'information_requests', 'contact_points')
        ->filter($request->all())
        ->search($query)
        ->orderBy($sort_by, $sort_type)
        ->paginate($limit)
        ->withQueryString();

        return $data;
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function getContactPoints(Request $request, $id)
    {
        $entity = Organization::with(
            'user', 
            'media',
            'member_state', 
        )
        ->withCount('contact_points', 'cases', 'information_requests')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new UserController;
        $request['organization_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/Organization/IndexContactPoints', ['data' => $entity]);
    }

    public function getCases(Request $request, $id)
    {
        $entity = Organization::with(
            'user', 
            'media',
            'member_state', 
        )
        ->withCount('contact_points', 'cases', 'information_requests')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new CaseController;
        $request['organization_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/Organization/IndexCases', ['data' => $entity]);
    }
    public function getInformationRequests(Request $request, $id)
    {
        $entity = Organization::with(
            'user', 
            'media',
            'member_state', 
        )
        ->withCount('contact_points', 'cases', 'information_requests')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new InformationRequestController;
        $request['organization_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/Organization/IndexInformationRequests', ['data' => $entity]);
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Organization::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Custom/Organization/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Organization::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        // Validate results
        Validator::make($data, [
            'name' => ['required', 'min:3', 'max:255'],
        ])->validate();

        $entity = Organization::create($data);
        $entity->updateRelatedEntities($request);
        $statusText = 'Organization "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.organizations.index')->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = Organization::with(
            'user', 
            'media',
            'member_state', 
        )
        ->withCount('contact_points', 'cases', 'information_requests')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/Organization/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = Organization::with(
            'user', 
            'media',
            'member_state', 
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/Organization/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = Organization::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'name' => ['min:3', 'max:255'],
        ])->validate();

        $entity->fill($data)->save();
        $entity->updateRelatedEntities($request);
        $statusText = 'Organization "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect($entity['entity_links']['url'])->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $entity = Organization::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Organization "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.organizations.index')->with('success', $statusText);
    }

}
