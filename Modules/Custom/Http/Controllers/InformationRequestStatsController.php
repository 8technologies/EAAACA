<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Custom\Entities\InformationRequest;
use Modules\Custom\Entities\InformationRestriction;
use Modules\Custom\Entities\NatureOfOffence;
use Modules\Custom\Entities\Organization;
use Modules\Custom\Entities\Status;

class InformationRequestStatsController extends Controller
{
    /**
     * Get Grievance statuses.
     * @return Renderable
     */
    public function getStats() {

        $stats = [];
        $request = app()->request;
        $request['stats_only'] = true;
        $request['limit'] = 9999999999999999;

        return Cache::remember("informationrequest_query_stats" . '_user_' . Auth::user()->id, now()->addMinutes(1), function () use ($request, $stats) {
            
            $controller = new InformationRequestController;
            
            $request['entity_status'] = '';
            $stats['all_requests'] = $controller->getData($request)->count();

            $request['entity_status'] = 'NEW';
            $stats['new'] = $controller->getData($request)->count();

            $request['entity_status'] = 'PENDING';
            $stats['pending'] = $controller->getData($request)->count();

            $request['entity_status'] = 'AWAITING RESPONSE';
            $stats['awaitingresponse'] = $controller->getData($request)->count();

            $request['entity_status'] = 'AWAITING FEEDBACK';
            $stats['awaitingfeedback'] = $controller->getData($request)->count();

            $request['entity_status'] = 'MORE INFORMATION NEEDED';
            $stats['moreinformation'] = $controller->getData($request)->count();

            $request['entity_status'] = 'COMPLETED';
            $stats['completed'] = $controller->getData($request)->count();

            return $stats;
        });
    }

    public function indexNew(Request $request)
    {
        $controller = new InformationRequestController;

        $request['entity_status'] = 'NEW';
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $controller->getData($request);
            return $data;
        } else {
            $data['stats'] = $this->getStats();
            return Inertia::render('Custom/InformationRequest/IndexNew', ['data' => $data]);
        }
    }

    public function indexPending(Request $request)
    {
        $controller = new InformationRequestController;

        $request['entity_status'] = 'PENDING';
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $controller->getData($request);
            return $data;
        } else {
            $data['stats'] = $this->getStats();
            return Inertia::render('Custom/InformationRequest/IndexPending', ['data' => $data]);
        }
    }

    public function indexAwaitingResponse(Request $request)
    {
        $controller = new InformationRequestController;

        $request['entity_status'] = 'AWAITING RESPONSE';
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $controller->getData($request);
            return $data;
        } else {
            $data['stats'] = $this->getStats();
            return Inertia::render('Custom/InformationRequest/IndexAwaitingResponse', ['data' => $data]);
        }
    }

    public function indexAwaitingFeedback(Request $request)
    {
        $controller = new InformationRequestController;

        $request['entity_status'] = 'AWAITING FEEDBACK';
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $controller->getData($request);
            return $data;
        } else {
            $data['stats'] = $this->getStats();
            return Inertia::render('Custom/InformationRequest/IndexAwaitingFeedback', ['data' => $data]);
        }
    }

    public function indexMoreInformation(Request $request)
    {
        $controller = new InformationRequestController;

        $request['entity_status'] = 'MORE INFORMATION NEEDED';
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $controller->getData($request);
            return $data;
        } else {
            $data['stats'] = $this->getStats();
            return Inertia::render('Custom/InformationRequest/IndexMoreInformation', ['data' => $data]);
        }
    }

    public function indexCompleted(Request $request)
    {
        $controller = new InformationRequestController;

        $request['entity_status'] = 'COMPLETED';
        if ($request->user()->cannot('viewAny', InformationRequest::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $controller->getData($request);
            return $data;
        } else {
            $data['stats'] = $this->getStats();
            return Inertia::render('Custom/InformationRequest/IndexCompleted', ['data' => $data]);
        }
    }

}
