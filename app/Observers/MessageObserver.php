<?php

namespace App\Observers;

use App\Models\Modules\Message\Entities\Message;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     *
     * @param  \App\Models\Modules\Message\Entities\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        //
    }

    /**
     * Handle the Message "updated" event.
     *
     * @param  \App\Models\Modules\Message\Entities\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     *
     * @param  \App\Models\Modules\Message\Entities\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     *
     * @param  \App\Models\Modules\Message\Entities\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     *
     * @param  \App\Models\Modules\Message\Entities\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
