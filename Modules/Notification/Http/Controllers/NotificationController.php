<?php

namespace Modules\Notification\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Notification\Entities\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Notification::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Notification/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMy(Request $request)
    {
        $request['notifiable_type'] = 'App\Models\User';
        $request['notifiable_id'] = Auth::user()->id;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Notification/IndexUser', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMarkAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        $statusText = 'All notifications have been marked as read';

        if(!$request->header('x-inertia') && $request->ajax() || $request->wantsJson())
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDeleteAll(Request $request)
    {
        Auth::user()->notifications()->delete();
        $statusText = 'All notifications have been deleted successfully';

        if(!$request->header('x-inertia') && $request->ajax() || $request->wantsJson())
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request, $userId)
    {
        // if ($request->user()->cannot('viewAny', Notification::class)) {
        //     return response(['message' => 'You are not authorized to access this page'], 403);
        // }

        $request['notifiable_type'] = 'App\Models\User';
        $request['notifiable_id'] = $userId;

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            $user = User::findOrFail($userId);
            $entity = [
                'data' => $user
            ];
            return Inertia::render('Core/User/IndexUserNotifications', $entity);
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

        $data = Notification::
            filter($request->all())
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
        if ($request->user()->cannot('create', Notification::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Notification/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Notification::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();
        $data['data'] = $request->data_;
        // Validate results
        Validator::make($data, [
            'data' => ['required', 'min:3'],
        ])->validate();

        $entity = Notification::create($data);
        $statusText = 'Notification "' . $entity['name'] . '" has been created';

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
        $entity = Notification::findOrFail($id);

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if ($entity->read_at == null && $entity->notifiable_id == $request->user()->id) {
            // Mark notification as read
            Auth::user()->notifications()->where('id', $entity->id)->first()->markAsRead();
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Notification/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = Notification::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Notification/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = Notification::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        $data['data'] = $request->data_;
        // Validate results
        Validator::make($data, [
            'data' => ['required', 'min:3'],
        ])->validate();

        $entity->fill($data)->save();
        $statusText = 'Notification "' . $entity['name'] . '" has been updated';

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
        $entity = Notification::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }

        $statusText = 'Notification "' . $entity['name'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }
}
