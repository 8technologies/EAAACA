<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentNews;

class ContentNewsObserver
{
    /**
     * Handle the ContentNews "created" event.
     *
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return void
     */
    public function created(ContentNews $contentNews)
    {
        //
    }

    /**
     * Handle the ContentNews "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return void
     */
    public function updated(ContentNews $contentNews)
    {
        //
    }

    /**
     * Handle the ContentNews "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return void
     */
    public function deleting(ContentNews $contentNews)
    {
        if (method_exists($contentNews, 'media')) {
            $contentNews->media()->detach();
        }

        if (method_exists($contentNews, 'tags')) {
            $contentNews->tags()->detach();
        }
    }

    /**
     * Handle the ContentNews "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return void
     */
    public function deleted(ContentNews $contentNews)
    {
        //
    }

    /**
     * Handle the ContentNews "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return void
     */
    public function restored(ContentNews $contentNews)
    {
        //
    }

    /**
     * Handle the ContentNews "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return void
     */
    public function forceDeleted(ContentNews $contentNews)
    {
        //
    }
}
