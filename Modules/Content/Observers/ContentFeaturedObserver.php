<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentFeatured;

class ContentFeaturedObserver
{
    /**
     * Handle the ContentFeatured "created" event.
     *
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return void
     */
    public function created(ContentFeatured $contentFeatured)
    {
        //
    }

    /**
     * Handle the ContentFeatured "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return void
     */
    public function updated(ContentFeatured $contentFeatured)
    {
        //
    }

    /**
     * Handle the ContentEvent "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return void
     */
    public function deleting(ContentFeatured $contentFeatured)
    {
        if (method_exists($contentFeatured, 'media')) {
            $contentFeatured->media()->detach();
        }
    }

    /**
     * Handle the ContentFeatured "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return void
     */
    public function deleted(ContentFeatured $contentFeatured)
    {
        //
    }

    /**
     * Handle the ContentFeatured "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return void
     */
    public function restored(ContentFeatured $contentFeatured)
    {
        //
    }

    /**
     * Handle the ContentFeatured "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return void
     */
    public function forceDeleted(ContentFeatured $contentFeatured)
    {
        //
    }
}
