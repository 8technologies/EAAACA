<?php

namespace Modules\Media\Observers;

use Modules\Media\Entities\MediaProvider;

class MediaProviderObserver
{
    /**
     * Handle the MediaProvider "created" event.
     *
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return void
     */
    public function created(MediaProvider $mediaProvider)
    {
        //
    }

    /**
     * Handle the MediaProvider "updated" event.
     *
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return void
     */
    public function updated(MediaProvider $mediaProvider)
    {
        //
    }

    /**
     * Handle the MediaProvider "deleted" event.
     *
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return void
     */
    public function deleted(MediaProvider $mediaProvider)
    {
        //
    }

    /**
     * Handle the MediaProvider "restored" event.
     *
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return void
     */
    public function restored(MediaProvider $mediaProvider)
    {
        //
    }

    /**
     * Handle the MediaProvider "force deleted" event.
     *
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return void
     */
    public function forceDeleted(MediaProvider $mediaProvider)
    {
        //
    }
}
