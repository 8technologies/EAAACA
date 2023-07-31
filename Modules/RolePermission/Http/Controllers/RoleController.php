<?php

namespace Modules\RolePermission\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\RolePermission\Entities\Role;
use Modules\RolePermission\Entities\Permission;
use Modules\User\Http\Controllers\UserController;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Role::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/RolePermission/Role/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request, $id)
    {
        $request['role'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            $user = new UserController();
            $data = $user->getData($request);
            return $data;
        } else {
            $role = Role::withCount(['users', 'permissions'])->findOrFail($id);
            $entity = [
                'data' => $role
            ];
            return Inertia::render('Core/RolePermission/Role/IndexRoleUsers', $entity);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPermission(Request $request, $id)
    {
        $request['role'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            $role = Role::withCount(['users', 'permissions'])->findOrFail($id);
            $entity = [
                'data' => $role
            ];
            return Inertia::render('Core/RolePermission/Role/IndexRolePermissions', $entity);
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
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'asc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = Role::
                with('permissions')
                ->withCount(['users', 'permissions'])
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
        if ($request->user()->cannot('create', Role::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        $data['model_permissions'] = Permission::with('model')->whereHas('model')->get()->toArray();
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/RolePermission/Role/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Role::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:30'],
            'permission' => 'required',
        ])->validate();

        $entity = Role::create($data);
        $entity->syncPermissions($request->input('permission'));
        $statusText = 'Role "' . $entity['name'] . '" has been created';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = Role::withCount(['users', 'permissions'])->findOrFail($id);
        
        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/RolePermission/Role/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = Role::with(['permissions'])->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $entity['model_permissions'] = Permission::with('model')->whereHas('model')->get()->toArray();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/RolePermission/Role/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = Role::with(['permissions'])->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:30'],
            'permission' => 'required',
        ])->validate();

        $entity->fill($data)->save();
        $entity->syncPermissions($request->input('permission'));
        $statusText = 'Role "' . $entity['name'] . '" has been updated';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
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
        $entity = Role::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Role "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
