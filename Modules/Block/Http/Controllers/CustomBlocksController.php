<?php

namespace Modules\Block\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\ContentFeatured;
use Modules\Content\Entities\ContentNews;
use Modules\Content\Entities\ContentService;
use Modules\Content\Entities\ContentTestimony;

class CustomBlocksController extends Controller
{
    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function latestNews()
    {
        $data = ContentNews::
            with('media')
            ->orderBy('id', 'asc')
            ->limit(4)
            ->get();
        
        return ['data' => $data];
    }

    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function services()
    {
        $data = ContentService::
            with('media')
            ->orderBy('id', 'asc')
            ->limit(8)
            ->get();
        
        return ['data' => $data];
    }

    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function frontSlider()
    {
        $data = ContentFeatured::
            with('media')
            ->orderBy('id', 'asc')
            ->limit(4)
            ->get();
        
        return ['data' => $data];
    }

    /**
     * Fetch resources from the database.
     *
     * @return
     */
    public function testimonies()
    {
        $data = ContentTestimony::
            with('media')
            ->orderBy('id', 'asc')
            ->limit(4)
            ->get();
        
        return ['data' => $data];
    }

}
