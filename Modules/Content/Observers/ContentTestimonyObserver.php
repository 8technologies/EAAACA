<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentTestimony;

class ContentTestimonyObserver
{
    /**
     * Handle the ContentTestimony "created" event.
     *
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return void
     */
    public function created(ContentTestimony $contentTestimony)
    {
        //
    }

    /**
     * Handle the ContentTestimony "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return void
     */
    public function updated(ContentTestimony $contentTestimony)
    {
        //
    }

    /**
     * Handle the ContentTestimony "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return void
     */
    public function deleting(ContentTestimony $contentTestimony)
    {
        if (method_exists($contentTestimony, 'media')) {
            $contentTestimony->media()->detach();
        }
    }

    /**
     * Handle the ContentTestimony "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return void
     */
    public function deleted(ContentTestimony $contentTestimony)
    {
        //
    }

    /**
     * Handle the ContentTestimony "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return void
     */
    public function restored(ContentTestimony $contentTestimony)
    {
        //
    }

    /**
     * Handle the ContentTestimony "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return void
     */
    public function forceDeleted(ContentTestimony $contentTestimony)
    {
        //
    }
}
