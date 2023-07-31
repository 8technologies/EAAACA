<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentOurWork;

class ContentOurWorkObserver
{
    /**
     * Handle the ContentOurWork "created" event.
     *
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return void
     */
    public function created(ContentOurWork $contentOurWork)
    {
        //
    }

    /**
     * Handle the ContentOurWork "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return void
     */
    public function updated(ContentOurWork $contentOurWork)
    {
        //
    }

    /**
     * Handle the ContentOurWork "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return void
     */
    public function deleting(ContentOurWork $contentOurWork)
    {
        if (method_exists($contentOurWork, 'media')) {
            $contentOurWork->media()->detach();
        }

        if (method_exists($contentOurWork, 'tags')) {
            $contentOurWork->tags()->detach();
        }
    }

    /**
     * Handle the ContentOurWork "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return void
     */
    public function deleted(ContentOurWork $contentOurWork)
    {
        //
    }

    /**
     * Handle the ContentOurWork "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return void
     */
    public function restored(ContentOurWork $contentOurWork)
    {
        //
    }

    /**
     * Handle the ContentOurWork "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return void
     */
    public function forceDeleted(ContentOurWork $contentOurWork)
    {
        //
    }
}
