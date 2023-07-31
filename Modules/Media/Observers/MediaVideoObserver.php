<?php

namespace Modules\Media\Observers;

use Modules\Media\Entities\MediaVideo;

class MediaVideoObserver
{
    /**
     * Handle the MediaVideo "created" event.
     *
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return void
     */
    public function created(MediaVideo $mediaVideo)
    {
        //
    }

    /**
     * Handle the MediaVideo "updated" event.
     *
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return void
     */
    public function updated(MediaVideo $mediaVideo)
    {
        //
    }

    /**
     * Handle the MediaVideo "deleted" event.
     *
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return void
     */
    public function deleted(MediaVideo $mediaVideo)
    {
        //
    }

    /**
     * Handle the MediaVideo "restored" event.
     *
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return void
     */
    public function restored(MediaVideo $mediaVideo)
    {
        //
    }

    /**
     * Handle the MediaVideo "force deleted" event.
     *
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return void
     */
    public function forceDeleted(MediaVideo $mediaVideo)
    {
        //
    }
}
