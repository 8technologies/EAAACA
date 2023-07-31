<?php

namespace Modules\Message\Observers;

use Modules\Message\Entities\ContactMessage;
use Illuminate\Support\Facades\Notification;
use Modules\Message\Notifications\{
    NewContactMessageNofifyAdmin,
    NewContactMessageNofifySender,
};

class ContactMessageObserver
{
    /**
     * Handle the ContactMessage "created" event.
     *
     * @param  \Modules\Message\Entities\ContactMessage  $contactMessage
     * @return void
     */
    public function created(ContactMessage $contactMessage)
    {
        $entity = $contactMessage;
        
        // Notify account owner
        Notification::send($entity, new NewContactMessageNofifySender($entity));
        // Notify Administrators
        Notification::send(getAdministrators(), new NewContactMessageNofifyAdmin($entity));
    }

    /**
     * Handle the ContactMessage "updated" event.
     *
     * @param  \Modules\Message\Entities\ContactMessage  $contactMessage
     * @return void
     */
    public function updated(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Handle the ContactMessage "deleted" event.
     *
     * @param  \Modules\Message\Entities\ContactMessage  $contactMessage
     * @return void
     */
    public function deleted(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Handle the ContactMessage "restored" event.
     *
     * @param  \Modules\Message\Entities\ContactMessage  $contactMessage
     * @return void
     */
    public function restored(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Handle the ContactMessage "force deleted" event.
     *
     * @param  \Modules\Message\Entities\ContactMessage  $contactMessage
     * @return void
     */
    public function forceDeleted(ContactMessage $contactMessage)
    {
        //
    }
}
