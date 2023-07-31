<?php

namespace Modules\Custom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;
use Modules\Custom\Entities\JobAdvert;

class CustomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('custom::index');
    }



    /**
     * List all Job Adverts.
     */
    public function jobAdverts(Request $request)
    {
        $data = $this->getJobAdvertsData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Custom/JobAdvert/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function getJobAdvertsData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return JobAdvert::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Job Advert page.
     */
    public function showJobAdvert(Request $request, $id)
    {
        $entity = JobAdvert::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Custom/JobAdvert/Show', ['data' => $entity]);
    }

}
