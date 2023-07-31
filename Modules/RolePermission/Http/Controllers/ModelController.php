<?php

namespace Modules\RolePermission\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\RolePermission\Entities\SystemModel as Model;
use Modules\RolePermission\Http\Controllers\PermissionController;
use Modules\RolePermission\Entities\PermissionType;
use Spatie\Permission\Models\Permission;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Model::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/RolePermission/Model/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPermission(Request $request, $id)
    {
        if ($request->user()->cannot('viewAny', Model::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        $request['model'] = $id;

        if(checkAjaxJsonRequest($request))
        {
            $permission = new PermissionController();
            $data = $permission->getData($request);
            return $data;
        } else {
            $model = Model::withCount(['model_permissions'])->findOrFail($id);
            $entity = [
                'data' => $model
            ];
            return Inertia::render('Core/RolePermission/Model/Show', $entity);
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

        $data = Model::with('model_permissions')
                ->withCount(['model_permissions'])
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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Model::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        $data['permission_types'] = PermissionType::select('id', 'name')->get()->toArray();

        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/RolePermission/Model/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Model::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        // Validate results
        Validator::make($data, [
            'name' => ['required', 'min:3', 'max:30'],
        ])->validate();

        $entity = Model::create($data);
        $this->updateModelPermissions($request, $entity);
        $statusText = 'Model "' . $entity['name'] . '" has been created';

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
        $entity = Model::withCount(['model_permissions'])->findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/RolePermission/Model/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = Model::with('model_permissions')->findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }
        
        $modelPermissions = $entity['model_permissions']->pluck('name')->toArray();
        $permissions = PermissionType::select('id', 'name')->get()->toArray();

        $availablePermissions = array_filter($permissions, function($array) use ($modelPermissions, $entity) {
            $value = $entity['name'] . $array['name'];
            return in_array($value, $modelPermissions);
        });

        $entity['permission_types'] = $permissions;
        $entity['permissions'] = array_values($availablePermissions);

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/RolePermission/Model/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = Model::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        
        // Validate results
        Validator::make($data, [
            'name' => ['required', 'min:3', 'max:255'],
        ])->validate();

        $entity->fill($data)->save();
        $this->updateModelPermissions($request, $entity);
        $statusText = 'Model "' . $entity['name'] . '" has been updated';

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
        $entity = Model::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Model "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  
     * @return 
     */
    public function updateModelPermissions(Request $request, $entity)
    {
        if (isset($request['permissions'][0])) {
            $permissions = PermissionType::whereIn('id', $request['permissions'])
                ->select('name', 'description')
                ->get()
                ->toArray();
            // prepend model name
            foreach($permissions as $key => $value) {
                $permissions[$key]['name'] = $entity['name'] . $value['name'];
            }

            foreach($permissions as $key => $value) {
                $permission_data = [
                    'name' => $value['name'],
                    'model_id' => $entity['id'],
                    'description' => $value['description'],
                ];

                // check if the permission exists. if not, create that permission
                $exists = Permission::where('name', $permission_data['name'])->first();
                if ($exists == false) {
                    Permission::create($permission_data);
                }
            }
        }

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function syncPermissions($entity, $permissions)
    {
        $permissionIds = [];

        // dd($permissions);
        if(is_array($permissions))
        {
            foreach($permissions as $item)
            {
                if (is_numeric($item)) {
                    $permissionIds[] = $item;
                } elseif(is_array($item)) {
                    // dd($item);

                    if (isset($item['name'])) {
                        $permissionIds[] = Permission::create([
                            'model_id'=>$entity->id,
                            'name'=>$item['name'],
                            'description'=>$item['description'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ])->id;
                    }
                } 

            }
        }
    }
}
