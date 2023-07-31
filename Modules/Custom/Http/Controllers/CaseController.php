<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Custom\Entities\CaseManagement;
use Modules\Custom\Entities\Organization;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', CaseManagement::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Custom/Case/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getInformationRequests(Request $request, $id)
    {
        $entity = CaseManagement::with(
            'user', 
            'organization',
        )
        ->withCount('information_requests', 'case_contributors', 'case_coordinators')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new InformationRequestController;
        $request['case_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/Case/IndexInformationRequests', ['data' => $entity]);
    }

    public function getCaseContributors(Request $request, $id)
    {
        $entity = CaseManagement::with(
            'user', 
            'organization',
        )
        ->withCount('information_requests', 'case_contributors', 'case_coordinators')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new CaseContributorController;
        $request['case_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/Case/IndexCaseContributors', ['data' => $entity]);
    }

    public function getCaseCoordinators(Request $request, $id)
    {
        $entity = CaseManagement::with(
            'user', 
            'organization',
        )
        ->withCount('information_requests', 'case_contributors', 'case_coordinators')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new CaseCoordinatorController;
        $request['case_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/Case/IndexCaseCoordinators', ['data' => $entity]);
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

        $data = CaseManagement::
        with(
            'organization',
            'user',
        )
        ->withCount('information_requests', 'case_contributors', 'case_coordinators')
        ->filter($request->all())
        ->search($query)
        ->where(function($query) use($request) {
            $user = Auth::user();

            if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.view')) {
                
            } else {
                if ($user->contact_points) {
                    // dd($user->contact_points->pluck('organization_id'));
                    $query
                    ->whereIn('cases.organization_id', [$user->contact_points->pluck('organization_id')])
                    ;
                } else {
                    $query
                    ->where('cases.created_by_id', $user->id)
                    ;
                }
            }
        })
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
        if ($request->user()->cannot('create', CaseManagement::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if ($request->has('organization_id')) {
            $data['organization_id'] = $request->organization_id;
            $data['organization'] = Organization::findOrFail($data['organization_id']);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Custom/Case/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', CaseManagement::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        if (!$request->has('organization_id')) {
            $data['organization_id'] = Auth::user()->contact_points[0]->organization_id;
        }

        // Validate results
        Validator::make($data, [
            'reference_number' => ['required'],
        ])->validate();

        $entity = CaseManagement::create($data);
        $entity->updateRelatedEntities($request);
        $statusText = 'Case has been saved';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.cases.index')->with('success', $statusText);
        // return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = CaseManagement::with(
            'organization',
            'case_investigations',
            'case_investigations.case',
            'case_investigations.case_findings',
            'case_investigations.case_findings.case_investigation',
            'case_investigations.case_findings.user',
            'case_investigations.assigned_contributor',
            'media',
            'user',
        )
        ->withCount('information_requests', 'case_contributors', 'case_coordinators')
        ->findOrFail($id)
        ->append('media_attachments');

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/Case/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = CaseManagement::with(
            'organization',
            'case_investigations',
            'case_investigations.case',
            'case_investigations.case_findings',
            'case_investigations.case_findings.case_investigation',
            'case_investigations.case_findings.user',
            'case_investigations.assigned_contributor',
            'media',
            'user',
        )
        ->withCount('information_requests', 'case_contributors', 'case_coordinators')
        ->findOrFail($id)
        ->append('media_attachments');

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/Case/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = CaseManagement::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'reference_number' => ['required'],
        ])->validate();

        $entity->fill($data)->save();
        $entity->updateRelatedEntities($request);
        $statusText = 'Case "' . $entity['id'] . '" has been updated';

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
        $entity = CaseManagement::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Case "' . $entity['id'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.cases.index')->with('success', $statusText);
        // return Redirect::back()->with('success', $statusText);
    }
}
