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
use Laravel\Jetstream\Actions\ValidateTeamDeletion;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Membership as JetstreamMembership;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function index(Request $request, $teamId)
    {
        if ($request->user()->cannot('viewAny', Membership::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

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

            return Inertia::render('Core/TeamGroup/Team/IndexMembers', $entity);
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

        $data = Membership::where('team_id', $teamId)
            // filter($request->all())
            //->search($query)
            ->with('team', 'user')
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
                ->withQueryString();

        // $data->each(function($model) {
        //     $model->append(['thumbnail']);
        // });

        return $data;
    }

    /**
     * Show the team creation screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Membership::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/TeamGroup/Member/Create', ['data' => $data]);
    }

    /**
     * Create a new team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Membership::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        // Validate results
        Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:30']
        ])->validate();

        $creator = app(CreatesTeams::class);
        $entity = $creator->create($request->user(), $request->all());
        $statusText = 'Team member "' . $entity['name'] . '" has been created';

        // return dd( $request->header('x-inertia') );
        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the team management screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teamId
     * @return \Inertia\Response
     */
    public function show(Request $request, $id)
    {
        $entity = Jetstream::newTeamModel()->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }
        // if (Gate::denies('view', $entity)) {
        //     abort(403);
        // }

        $entity['team'] = $entity->load('owner', 'users', 'teamInvitations');

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/TeamGroup/Team/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $entity = Jetstream::newTeamModel()->findOrFail($id)->load('owner');

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        // $entity->load('owner');

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/TeamGroup/Team/Edit', ['data' => $entity]);
    }

    /**
     * Update the given team's name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teamId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $entity = Jetstream::newTeamModel()->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        // Validate results
        Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:50']
        ])->validate();

        app(UpdatesTeamNames::class)->update($request->user(), $entity, $request->all());
        $statusText = 'Team member "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Delete the given team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $teamId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $entity = Jetstream::newTeamModel()->findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Team member "' . $entity['name'] . '" has been deleted';
        app(ValidateTeamDeletion::class)->validate($request->user(), $entity);
        $deleter = app(DeletesTeams::class);
        $deleter->delete($entity);

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
