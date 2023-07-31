<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentPublication;

class ContentPublicationObserver
{
    /**
     * Handle the ContentPublication "created" event.
     *
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return void
     */
    public function created(ContentPublication $contentPublication)
    {
        //
    }

    /**
     * Handle the ContentPublication "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return void
     */
    public function updated(ContentPublication $contentPublication)
    {
        //
    }

    /**
     * Handle the ContentPublication "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return void
     */
    public function deleting(ContentPublication $contentPublication)
    {
        if (method_exists($contentPublication, 'media')) {
            $contentPublication->media()->detach();
        }

        if (method_exists($contentPublication, 'tags')) {
            $contentPublication->tags()->detach();
        }
    }

    /**
     * Handle the ContentPublication "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return void
     */
    public function deleted(ContentPublication $contentPublication)
    {
        //
    }

    /**
     * Handle the ContentPublication "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return void
     */
    public function restored(ContentPublication $contentPublication)
    {
        //
    }

    /**
     * Handle the ContentPublication "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return void
     */
    public function forceDeleted(ContentPublication $contentPublication)
    {
        //
    }
}
