<?php

namespace Modules\Field\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FieldController extends Controller
{
    /**
     * Show module landing page.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Core/Field/Index', []);
    }
}
