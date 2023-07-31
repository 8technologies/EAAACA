<?php

namespace Modules\Taxonomy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaxonomyController extends Controller
{
    /**
     * Show module landing page.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Core/Taxonomy/Index', []);
    }


    /**
     * Taxonomy terms.
     */
    public function terms (Request $request)
    {
        $data = $this->getTermData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Taxonomy/Term/_FrontEnd/Index', ['data' => $data]);
        }
    }

    /**
     * Fetch resources from the database.
     *
     * @return \$data
     */
    public function getTermData(Request $request)
    {
        if ( !isset($request['limit']) ) {
            $request['limit'] = 10;
        }
        
        $controller = new \Modules\Taxonomy\Http\Controllers\TaxonomyTermController();
        return $controller->getData($request);
    }

    /**
     * Detailed showResource page.
     */
    public function showTerm(Request $request, $id)
    {
        $data = \Modules\Taxonomy\Entities\TaxonomyTerm::
            // with('user', 'user.media', 'media')
            where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $data;
        }
        return Inertia::render('Core/Taxonomy/Term/Show', ['data' => $data]);
    }

}
