<?php

namespace Modules\Message\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Message\Entities\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', Message::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('viewAny')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            $data = $this->getData($request);
            return $data;
        } else {
            return Inertia::render('Core/Message/Message/Index', []);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Inertia
     */
    public function indexUser(Request $request, $userId)
    {   
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
            return Inertia::render('Core/User/IndexUserMessages', $entity);
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

        $data = Message::
                search($query)
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
        if ($request->user()->cannot('create', Message::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Message/Message/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // dd( $request );
        if ($request->user()->cannot('create', Message::class)) {
            return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        }

        $data = $request->all();

        // Validate results
        Validator::make($data, [
            'message' => ['required'],
            'to_user_id' => ['required'],
        ])->validate();

        $entity = Message::create($data);
        $statusText = 'Message has been sent';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.messages.index')->with('success', $statusText);
        // return Redirect::back()->with('success', $statusText);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $id)
    {
        $entity = Message::findOrFail($id);

        // mark message as read if to_user_id
        if (!$entity->read_at && $request->user()->id == $entity->to_user_id) {
            $entity->fill(['read_at' => now()])->save();
        }

        if ($request->user()->cannot('view', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('view')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Message/Message/Show', ['data' => $entity]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $entity = Message::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Message/Message/Edit', ['data' => $entity]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $entity = Message::findOrFail($id);

        if ($request->user()->cannot('update', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('update')], 403);
        }

        $data = $request->all();
        // Validate results
        Validator::make($data, [
            'message' => ['required'],
            'to_user_id' => ['required'],
        ])->validate();

        $entity->fill($data)->save();
        $statusText = 'Message "' . $entity['id'] . '" has been updated';

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
        $entity = Message::findOrFail($id);

        if ($request->user()->cannot('delete', $entity)) {
            return response(['message' => getUnAuthorizedAccessMessage('delete')], 403);
        }
        $statusText = 'Message "' . $entity['id'] . '" has been deleted';
        $entity->delete();

        if(checkAjaxJsonRequest($request))
        {
            return response()->setStatusCode(200, $statusText);
        }
        return redirect()->route('dashboard.messages.index')->with('success', $statusText);
        // return Redirect::back()->with('success', $statusText);
    }
}
