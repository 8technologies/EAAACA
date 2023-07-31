<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Custom\Entities\InformationRequest;
use Modules\Custom\Entities\InformationRestriction;
use Modules\Custom\Entities\NatureOfOffence;
use Modules\Custom\Entities\Organization;
use Modules\Custom\Entities\Status;

class InformationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $controller = new InformationRequestStatsController;
        // if(checkAjaxJsonRequest($request))
        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            $data['stats'] = $controller->getStats();
            return Inertia::render('Custom/InformationRequest/Index', ['data' => $data]);
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

        $data = InformationRequest::
            with('media', 'user', 'organization')
            ->withEntityStatus()
            ->filter($request->all())
            ->search($query)
            ->where(function($query) use($request) {
                $user = Auth::user();
    
                if ($user->can('information_request.*')) {
                    
                } else {
                    $query
                    ->where('information_requests.organization_id', $user->organization_id)
                    // ->orWhere('information_requests.user_id', $user->id)
                    ;
                }
            })
            ->orderBy($sort_by, $sort_type)
            // ->groupBy('entity_status')
            ->paginate($limit)
            ->withQueryString();

        // Check if stats only
        if (isset($request['stats_only']) && $request['stats_only'] == true ) {
            return $data;
        }

        return $data;
    }

    /**
     * Fetch resources from the database.
     *
     * @return \$data
     */
    public function getDataByEntityStatus(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';

        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = InformationRequest::
            withEntityStatus()
            ->filter($request->all())
            ->search($query)
            ->groupBy('entity_status')
            ->paginate($limit)
            ;

        return $data;
    }
    public function getDataStatistics(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';

        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = InformationRequest::
            withEntityStatus()
            ->filter($request->all())
            ->search($query)
            // ->groupBy('entity_status')
            ->paginate($limit)
            ;

        return $data;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getResponses(Request $request, $id)
    {
        $entity = InformationRequest::with(
            'user', 
            'request_responses',
            // 'request_responses.media',
            'request_responses.information_request',
            'information_restrictions', 
            'organization', 
            'organization.member_state', 
            'member_state',
        )
        ->withCount('request_responses')
        ->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        $controller = new RequestResponseController;
        $request['information_request_id'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            return $controller->getData($request);
        }
        return Inertia::render('Custom/InformationRequest/IndexRequestResponse', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function getReview(Request $request, $id)
    {
        $entity = InformationRequest::with(
            'user', 
        )
        ->findOrFail($id);

        $entity['all_statuses'] = Status::where('status_category', '=', 'InformationRequestReview')->get()->toArray();

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/InformationRequest/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function addReview(Request $request, $id)
    {
        $entity = InformationRequest::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        $data['review_by_id'] = Auth::user()->id;

        if ($data['review_on'] == '') {
            $data['review_on'] = now();
        }

        // Validate results
        Validator::make($data, [
            'review_status_id' => ['required'],
        ])->validate();

        $entity->fill($data)->save();
        $statusText = 'Review added';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect($entity['entity_links']['url'])->with('success', $statusText);
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        $user_organization_id = Auth::user()->organization_id;
        $data['organization'] = Organization::with('member_state')->findOrFail($user_organization_id);
        $data['organization_id'] = $user_organization_id;

        $data['all_nature_of_offences'] = NatureOfOffence::get()->toArray();
        $data['all_information_restrictions'] = InformationRestriction::get()->toArray();
        
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Custom/InformationRequest/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        // Validate results
        Validator::make($data, [
            'organization_id' => ['required'],
            'member_state_id' => ['required'],
            'request_reference_no' => ['required'],
        ])->validate();

        $entity = InformationRequest::create($data);
        $entity->updateRelatedEntities($request);
        $statusText = 'Information Request "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.information-requests.index')->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = InformationRequest::with(
            'user', 
            'media',
            'request_responses',
            'request_responses.media',
            'request_responses.information_request',
            'request_responses.feedback_status',
            'nature_of_offences', 
            'information_restrictions', 
            'organization', 
            'organization.member_state', 
            'member_state',
            'review_status',
        )
        ->withEntityStatus()
        ->withCount('request_responses',)
        ->findOrFail($id);

        if (isset($entity->request_responses)) {
            $entity->request_responses->each(function($model) {
                $model->append([
                    'media_attachments',
                    'entity_permissions'
                ]);
            });
        }

        $entity['all_nature_of_offences'] = NatureOfOffence::get()->toArray();
        $entity['all_information_restrictions'] = InformationRestriction::get()->toArray();

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/InformationRequest/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = InformationRequest::with(
            'user', 
            'media',
            'nature_of_offences', 
            'information_restrictions', 
            'organization',
            'organization.member_state', 
            'member_state',
        )
        ->withEntityStatus()
        ->withCount('request_responses')
        ->findOrFail($id);

        $entity['all_nature_of_offences'] = NatureOfOffence::get()->toArray();
        $entity['all_information_restrictions'] = InformationRestriction::get()->toArray();

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/InformationRequest/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = InformationRequest::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'organization_id' => ['required'],
            'member_state_id' => ['required'],
            'request_reference_no' => ['required'],
        ])->validate();

        $entity->fill($data)->save();
        $entity->updateRelatedEntities($request);
        $statusText = 'Information Request "' . $entity['name'] . '" has been updated';

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
        $entity = InformationRequest::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Information Request "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.information-requests.index')->with('success', $statusText);
    }

}
