<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Route;
use Modules\Custom\Entities\CaseManagement;
use Modules\Custom\Entities\InformationRequest;
use Modules\Custom\Entities\MemberState;
use Modules\Custom\Entities\Organization;
use Modules\Custom\Http\Controllers\InformationRequestController;
use Modules\Custom\Http\Controllers\InformationRequestStatsController;
use Modules\System\Entities\Activity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = [];
        $data['cases'] = $this->getCases();
        $data['information_requests'] = $this->getInformationRequests();
        $data['contact_points'] = $this->getContactPoints();
        $data['organization'] = Auth::user()->organization;
        $data['chart_data'] = [];

        $statsController = new InformationRequestStatsController;
        foreach ($statsController->getStats() as $key => $value) {
            $dataArray = array();

            switch ($key) {
                case 'new':
                    $dataArray = array(
                        "name" => 'NEW',
                        "y" => $value,
                    );
                    break;

                case 'pending':
                    $dataArray = array(
                        "name" => 'PENDING',
                        "y" => $value,
                    );
                    break;

                case 'awaitingresponse':
                    $dataArray = array(
                        "name" => 'AWAITING RESPONSE',
                        "y" => $value,
                    );
                    break;

                case 'awaitingfeedback':
                    $dataArray = array(
                        "name" => 'AWAITING FEEDBACK',
                        "y" => $value,
                    );
                    break;

                case 'moreinformation':
                    $dataArray = array(
                        "name" => 'MORE INFORMATION NEEDED',
                        "y" => $value,
                    );
                    break;

                case 'completed':
                    $dataArray = array(
                        "name" => 'COMPLETED',
                        "y" => $value,
                    );
                    break;
                
                default:
                    # code...
                    break;
            }

            if ($key != 'all_requests') {
                array_push($data['chart_data'], $dataArray);
            }
        }

        // dd( $data['chart_data'] );

        $controller = new InformationRequestController;          

        $arrayMemberStates = [];
        $memberStates = MemberState::
            withCount(
                'organizations',
                'information_requests', 
                'information_requests_incoming',
            )
            ->get();

        $arrayMemberStates = $memberStates->map(function ($item, $key) use($controller, $request) {
            $informationRequests = $controller->getDataByEntityStatus($request);

            return [
                'id' => $item->id,
                'name' => $item->name,
                'organizations_count' => $item->organizations_count,

                'information_requests_count' => $item->information_requests_count,
                'information_requests' => $informationRequests->map(function ($item2, $key2) use($controller, $request, $item) {
                    $request['entity_status'] = $item2->entity_status;
                    $request['parent_member_state_id'] = $item->id;
                    $request['limit'] = '';

                    $count = $controller->getDataStatistics($request)->count();
                    // remove request parameters
                    $request->request->remove('entity_status');
                    $request->request->remove('parent_member_state_id');

                    return [
                        'entity_status' => $item2->entity_status,
                        'entity_status_count' => $count,
                    ];
                }),

                'information_requests_incoming_count' => $item->information_requests_incoming_count,
                'information_requests_incoming' => $informationRequests->map(function ($item2, $key2) use($controller, $request, $item) {
                    $request['entity_status'] = $item2->entity_status;
                    $request['member_state_id'] = $item->id;
                    $request['limit'] = '';

                    $count = $controller->getDataStatistics($request)->count();
                    // remove request parameters
                    $request->request->remove('entity_status');
                    $request->request->remove('member_state_id');

                    return [
                        'entity_status' => $item2->entity_status,
                        'entity_status_count' => $count,
                    ];
                }),
            ];
        });

        $data['member_states'] = $arrayMemberStates;
        // dd( $data['member_states'] );


        // Get Organization's information request statistics
        $arrayOrganizations = [];
        $organizations = Organization::
            // with('information_requests')->
            withCount('information_requests')
            ->get();

        $arrayOrganizations = $organizations->map(function ($item, $key) use($controller, $request) {
            $informationRequests = $controller->getDataByEntityStatus($request);

            return [
                'id' => $item->id,
                'name' => $item->name,
                'information_requests_count' => $item->information_requests_count,
                'information_requests' => $informationRequests->map(function ($item2, $key2) use($controller, $request, $item) {
                    $request['entity_status'] = $item2->entity_status;
                    $request['organization_id'] = $item->id;
                    $request['limit'] = '';

                    $count = $controller->getDataStatistics($request)->count();
                    // remove request parameters
                    $request->request->remove('entity_status');
                    $request->request->remove('organization_id');

                    return [
                        'entity_status' => $item2->entity_status,
                        'entity_status_count' => $count,
                    ];
                }),
            ];
        });

        $data['organizations'] = $arrayOrganizations;
        // dd( $data['organizations'] );

        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Dashboard/Dashboard', ['data' => $data]);
        }
    }



    public function getCases()
    {
        $data = [];
        $data['count'] = CaseManagement::count();

        return $data;
    }

    public function getInformationRequests()
    {
        $data = [];
        $data['count'] = InformationRequest::count();

        return $data;
    }

    public function getContactPoints()
    {
        $data = [];
        $data['count'] = User::count();

        return $data;
    }




    public function getModuleEntities($module)
    {
        $entities = [];
        $allFiles = File::glob( base_path() . '/Modules/' . $module . '/Entities/*.php');
        // $allFiles = File::allFiles( base_path() . '/Modules/Content/Entities/');
        foreach ($allFiles as $entity) {
            $entities[] = pathinfo($entity, PATHINFO_FILENAME);
        }
        return $entities;
    }

    public function getContentStatistics()
    {
        $entitiesPath = '\\Modules\\Content\\Entities\\';
        $entities = $this->getModuleEntities('Content');
        $entityStatistics = [];

        foreach ($entities as $key => $value) {
            $classPath = $entitiesPath . $value;
            $module = new $classPath();

            if ($value != 'ContentGallery' && $value != 'ContentOurWork' && $value != 'ContentService' && $value != 'ContentTestimony') {
                $entityStatistics[$key]['name'] = str_replace('Content', '', $value);
                $entityStatistics[$key]['total'] = $module->count();
            }
            
        }

        return $entityStatistics;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
