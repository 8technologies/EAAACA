<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentGallery;

class ContentGalleryObserver
{
    /**
     * Handle the ContentGallery "created" event.
     *
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return void
     */
    public function created(ContentGallery $contentGallery)
    {
        //
    }

    /**
     * Handle the ContentGallery "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return void
     */
    public function updated(ContentGallery $contentGallery)
    {
        //
    }

    /**
     * Handle the ContentGallery "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return void
     */
    public function deleting(ContentGallery $contentGallery)
    {
        if (method_exists($contentGallery, 'media')) {
            $contentGallery->media()->detach();
        }

        if (method_exists($contentGallery, 'tags')) {
            $contentGallery->tags()->detach();
        }
    }

    /**
     * Handle the ContentGallery "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return void
     */
    public function deleted(ContentGallery $contentGallery)
    {
        //
    }

    /**
     * Handle the ContentGallery "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return void
     */
    public function restored(ContentGallery $contentGallery)
    {
        //
    }

    /**
     * Handle the ContentGallery "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return void
     */
    public function forceDeleted(ContentGallery $contentGallery)
    {
        //
    }
}
