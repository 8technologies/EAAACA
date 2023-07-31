<?php

namespace Modules\TeamGroup\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use App\Models\Team;
use App\Models\Membership;
use App\Models\TeamInvitation;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\RedirectsActions;

class TeamInviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function index(Request $request, $teamId)
    {
        // if ($request->user()->cannot('viewAny', TeamInvitation::class)) {
        //     return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        // }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request, $teamId);
            return $data;
        } else {
            $team = Jetstream::newTeamModel()
                    ->with('owner', 'users', 'teamInvitations')
                    ->withCount('users', 'teamInvitations')
                    ->findOrFail($teamId);
            $data = $team;
            $entity = [
                'data' => $data,
            ];

            return Inertia::render('Core/TeamGroup/Team/IndexInvites', $entity);
        }
    }

    /**
     * Get resource listing from the database..
     *
     * @return \$data
     */
    public function getData(Request $request, $teamId)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'created_at';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = TeamInvitation::where('team_id', $teamId)
            // filter($request->all())
            //->search($query)
            ->with('team')
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
                ->withQueryString();

        // $data->each(function($model) {
        //     $model->append(['thumbnail']);
        // });

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request, $teamId)
    {
        // if ($request->user()->cannot('create', TeamInvitation::class)) {
        //     return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        // }

        $entity = Jetstream::newTeamModel()->findOrFail($teamId);
        $entity['availableRoles'] = array_values(Jetstream::$roles);
        
        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/TeamGroup/Invite/Create', ['data' => $entity]);
    }
}
