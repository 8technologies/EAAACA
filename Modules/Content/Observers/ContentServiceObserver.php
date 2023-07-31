<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentService;

class ContentServiceObserver
{
    /**
     * Handle the ContentService "created" event.
     *
     * @param  \Modules\Content\Entities\ContentService  $contentService
     * @return void
     */
    public function created(ContentService $contentService)
    {
        //
    }

    /**
     * Handle the ContentService "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentService  $contentService
     * @return void
     */
    public function updated(ContentService $contentService)
    {
        //
    }

    /**
     * Handle the ContentService "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentService  $contentService
     * @return void
     */
    public function deleting(ContentService $contentService)
    {
        if (method_exists($contentService, 'media')) {
            $contentService->media()->detach();
        }

        if (method_exists($contentService, 'tags')) {
            $contentService->tags()->detach();
        }
    }

    /**
     * Handle the ContentService "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentService  $contentService
     * @return void
     */
    public function deleted(ContentService $contentService)
    {
        //
    }

    /**
     * Handle the ContentService "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentService  $contentService
     * @return void
     */
    public function restored(ContentService $contentService)
    {
        //
    }

    /**
     * Handle the ContentService "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentService  $contentService
     * @return void
     */
    public function forceDeleted(ContentService $contentService)
    {
        //
    }
}
