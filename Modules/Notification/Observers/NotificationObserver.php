<?php

namespace Modules\Notification\Observers;

use Modules\Notification\Entities\Notification;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     *
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return void
     */
    public function created(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "updated" event.
     *
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return void
     */
    public function updated(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     *
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return void
     */
    public function deleted(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     *
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return void
     */
    public function restored(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     *
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return void
     */
    public function forceDeleted(Notification $notification)
    {
        //
    }
}
