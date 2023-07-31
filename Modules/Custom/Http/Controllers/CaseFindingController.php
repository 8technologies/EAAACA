<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Custom\Entities\CaseFinding;
use Modules\Custom\Entities\CaseInvestigation;

class CaseFindingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', CaseFinding::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Custom/CaseFinding/Index', []);
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

        $data = CaseFinding::
            with('media', 'user', 'case_investigation')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', CaseFinding::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if ($request->has('case_investigation_id')) {
            $data['case_investigation_id'] = $request->case_investigation_id;
            $data['case_investigation'] = CaseInvestigation::findOrFail($data['case_investigation_id']);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Custom/CaseFinding/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', CaseFinding::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();
        if ($data['date_of_submission'] == '') {
            $data['date_of_submission'] = now();
        }

        // Validate results
        Validator::make($data, [
            'case_investigation_id' => ['required'],
            'findings' => ['required'],
        ])->validate();

        $entity = CaseFinding::create($data);
        $entity->updateRelatedEntities($request);
        $statusText = 'Case Finding "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
        // return redirect()->route('dashboard.contact-points.index')->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = CaseFinding::with(
            'user', 
            'media',
            'case_investigation', 
        )->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/CaseFinding/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = CaseFinding::with(
            'user', 
            'media',
            'case_investigation', 
        )->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/CaseFinding/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = CaseFinding::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // // Validate results
        // Validator::make($data, [
        //     'case_id' => ['required'],
        // ])->validate();

        $entity->fill($data)->save();
        $entity->updateRelatedEntities($request);
        $statusText = 'Case Finding "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
        // return redirect($entity['entity_links']['url'])->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $entity = CaseFinding::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Case Finding "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

}
