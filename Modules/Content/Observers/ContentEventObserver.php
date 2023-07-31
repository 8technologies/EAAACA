<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentEvent;

class ContentEventObserver
{
    /**
     * Handle the ContentEvent "created" event.
     *
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return void
     */
    public function created(ContentEvent $contentEvent)
    {
        //
    }

    /**
     * Handle the ContentEvent "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return void
     */
    public function updated(ContentEvent $contentEvent)
    {
        //
    }

    /**
     * Handle the ContentEvent "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return void
     */
    public function deleting(ContentEvent $contentEvent)
    {
        if (method_exists($contentEvent, 'media')) {
            $contentEvent->media()->detach();
        }

        if (method_exists($contentEvent, 'tags')) {
            $contentEvent->tags()->detach();
        }
    }

    /**
     * Handle the ContentEvent "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return void
     */
    public function deleted(ContentEvent $contentEvent)
    {
        //
    }

    /**
     * Handle the ContentEvent "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return void
     */
    public function restored(ContentEvent $contentEvent)
    {
        //
    }

    /**
     * Handle the ContentEvent "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return void
     */
    public function forceDeleted(ContentEvent $contentEvent)
    {
        //
    }
}
