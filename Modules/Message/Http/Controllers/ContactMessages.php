<?php

namespace Modules\Message\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use Modules\Message\Entities\ContactMessage;
use App\Models\User;

class ContactMessages extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        // if ($request->user()->cannot('create', ContactMessage::class)) {
        //     return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        // }

        $data = [];
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Message/ContactMessage/Create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // // dd( $request );
        // if ($request->user()->cannot('create', ContactMessage::class)) {
        //     return response(['message' => getUnAuthorizedAccessMessage('create')], 403);
        // }

        $data = $request->all();

        // Validate results
        Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required'],
        ])->validate();

        $entity = ContactMessage::create($data);
        $statusText = 'Contact Message has been recieved';

        if(checkAjaxJsonRequest($request))
        {
            return response($entity)->setStatusCode(200, $statusText);
        }
        return Redirect::back()->with('success', $statusText);
    }

}
