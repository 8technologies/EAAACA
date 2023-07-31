<?php

namespace Modules\Content\Http\Controllers;

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
use Modules\Content\Entities\ContentBlogPost;
use Modules\Content\Entities\ContentEvent;
use Modules\Content\Entities\ContentFeatured;
use Modules\Content\Entities\ContentGallery;
use Modules\Content\Entities\ContentNews;
use Modules\Content\Entities\ContentOurWork;
use Modules\Content\Entities\ContentPage;
use Modules\Content\Entities\ContentPublication;
use Modules\Content\Entities\ContentService;
use Modules\Content\Entities\ContentTestimony;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return Inertia::render('Core/Content/Index', []);
    }





    /**
     * Display the specified page.
     */
    public function homePage(Request $request)
    {
        $id = $request->id;
        $entity = ContentPage::with(
            array_merge(
                ['media'],
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships()
            ),
        )
        ->where('id', $id)
        ->orWhere('slug', $id)
        ->first();
    
        SEOMeta::setTitle('Home Page');

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Page/Show', ['data' => $entity]);
    }

    /**
     * Display the specified page.
     */
    public function showPage(Request $request, $id)
    {
        $entity = ContentPage::with(
            array_merge(
                ['media'],
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships()
            ),
        )
        ->where('id', $id)
        ->orWhere('slug', $id)
        ->first();
        
        if ($entity == null) {
            abort(404, 'NOT FOUND');
        }

        SEOMeta::setTitle($entity->name);

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Page/Show', ['data' => $entity]);
    }



    /**
     * List all News.
     */
    public function news(Request $request)
    {
        $data = $this->getNewsData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/News/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getNewsData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentNews::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed News page.
     */
    public function showNews(Request $request, $id)
    {
        $entity = ContentNews::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/News/Show', ['data' => $entity]);
    }





    /**
     * List Blog Posts.
     */
    public function blog (Request $request)
    {
        $request['limit'] = 12;
        $data = $this->getBlogData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/BlogPost/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getBlogData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentBlogPost::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed blog page.
     */
    public function showBlog(Request $request, $id)
    {
        $entity = ContentBlogPost::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/BlogPost/Show', ['data' => $entity]);

    }




    /**
     * List all publications.
     */
    public function testimonies(Request $request)
    {
        $data = $this->getTestimonyData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/Testimony/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getTestimonyData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentTestimony::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Publication page.
     */
    public function showTestimony(Request $request, $id)
    {
        $entity = ContentTestimony::
            with('media')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Testimony/Show', ['data' => $entity]);
    }





    /**
     * List all publications.
     */
    public function publications(Request $request)
    {
        $data = $this->getPublicationsData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/Publication/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function getPublicationsData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentPublication::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Publication page.
     */
    public function showPublication(Request $request, $id)
    {
        $entity = ContentPublication::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Publication/Show', ['data' => $entity]);
    }





    /**
     * List all Event.
     */
    public function events(Request $request)
    {
        $data = $this->getEventsData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/Event/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function getEventsData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentEvent::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Publication page.
     */
    public function showEvent(Request $request, $id)
    {
        $entity = ContentEvent::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Event/Show', ['data' => $entity]);
    }





    /**
     * List all Galleries.
     */
    public function gallery(Request $request)
    {
        $data = $this->getGalleryData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/Gallery/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getGalleryData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentGallery::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Gallery page.
     */
    public function showGallery(Request $request, $id)
    {
        $entity = ContentGallery::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Gallery/Show', ['data' => $entity]);
    }






    /**
     * List all Featured.
     */
    public function featured(Request $request)
    {
        $data = $this->getFeaturedData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/Featured/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getFeaturedData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentFeatured::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Gallery page.
     */
    public function showFeatured(Request $request, $id)
    {
        $entity = ContentFeatured::
            with('media', 'tags')
            ->where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Featured/Show', ['data' => $entity]);
    }






    /**
     * List all Services.
     */
    public function services(Request $request)
    {
        $data = $this->getServicesData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/Service/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getServicesData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        $data = ContentService::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();

        return $data;
    }
    /**
     * Detailed Service page.
     */
    public function showService(Request $request, $id)
    {
        $entity = ContentService::with(
            array_merge(
                ['media'],
                getPageLayoutSectionRelationships(),
                getPageLayoutSectionTopRelationships()
            ),
        )
        ->where('id', $id)
        ->orWhere('slug', $id)
        ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/Service/Show', ['data' => $entity]);
    }





    /**
     * List all OurWork.
     */
    public function ourWork(Request $request)
    {
        $data = $this->getOurWorkData($request);
        if(checkAjaxJsonRequest($request))
        {
            return $data;
        } else {
            return Inertia::render('Core/Content/OurWork/_FrontEnd/Index', ['data' => $data]);
        }
    }
    /**
     * Fetch resources from the database.
     *
     * @return 
     */
    public function getOurWorkData(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;

        $sort_by = $request->get('sortby') ? $request->get('sortby') : 'id';
        $sort_type = $request->get('sorttype') ? $request->get('sorttype') : 'desc';
        $query = $request->get('query');
        $query = str_replace(" ", "%", $query);

        return ContentOurWork::
            with('media')
            ->filter($request->all())
            ->search($query)
            ->orderBy($sort_by, $sort_type)
            ->paginate($limit)
            ->withQueryString();
    }
    /**
     * Detailed Ourwork page.
     */
    public function showOurWork(Request $request, $id)
    {
        $entity = ContentOurWork::with(
            'media',
            'tags',
        )
        ->where('id', $id)
        ->orWhere('slug', $id)
        ->first();

        if(checkAjaxJsonRequest($request))
        {
            return $entity;
        }
        return Inertia::render('Core/Content/OurWork/Show', ['data' => $entity]);
    }

}
