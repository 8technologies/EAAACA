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
use App\Models\User;
use Laravel\Jetstream\Actions\ValidateTeamDeletion;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\RedirectsActions;

class TeamController extends Controller
{
    use RedirectsActions;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Team::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/TeamGroup/Team/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function myIndex(Request $request)
    {
        $request['user'] = Auth::user()->id;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Profile/IndexMyTeams', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function indexUser(Request $request, $userId)
    {   
        if ($request->user()->cannot('viewAny', Team::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $request['user'] = $userId;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            $user = User::findOrFail($userId);
            $entity = [
                'data' => $user
            ];
            return Inertia::render('Core/User/IndexUserTeams', $entity);
        }
    }

    /**
     * Get resource listing from the database..
     *
     * @return \$data
     */
    public function getData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : '25';

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'created_at';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = Team::
            with('owner')
            ->withCount('users', 'teamInvitations')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
                ->withQueryString();

        $data->each(function($model) {
            $model->append(['entity_permissions']);
        });

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
        if ($request->user()->cannot('create', Team::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/TeamGroup/Team/Create', ['data' => $data]);
    }

    /**
     * Create a new team.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Team::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        // Validate results
        Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:30']
        ])->validate();

        $creator = app(CreatesTeams::class);
        $entity = $creator->create($request->user(), $request->all());
        $statusText = 'Team "' . $entity['name'] . '" has been created';

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
    public function show(Request $request, $teamId)
    {
        $entity = Jetstream::newTeamModel()
                ->with('owner')
                ->withCount('users', 'teamInvitations')
                ->findOrFail($teamId);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

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
    public function edit(Request $request, $teamId)
    {
        $entity = Jetstream::newTeamModel()->with('owner')->findOrFail($teamId);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

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
        $statusText = 'Team "' . $entity['name'] . '" has been updated';

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

        $statusText = 'Team "' . $entity['name'] . '" has been deleted';
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