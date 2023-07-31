<?php

namespace Modules\Field\Observers;

use Modules\Field\Entities\FieldLink;

class FieldLinkObserver
{
    /**
     * Handle the FieldLink "created" event.
     *
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return void
     */
    public function created(FieldLink $fieldLink)
    {
        //
    }

    /**
     * Handle the FieldLink "updated" event.
     *
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return void
     */
    public function updated(FieldLink $fieldLink)
    {
        //
    }

    /**
     * Handle the FieldLink "deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return void
     */
    public function deleted(FieldLink $fieldLink)
    {
        //
    }

    /**
     * Handle the FieldLink "restored" event.
     *
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return void
     */
    public function restored(FieldLink $fieldLink)
    {
        //
    }

    /**
     * Handle the FieldLink "force deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return void
     */
    public function forceDeleted(FieldLink $fieldLink)
    {
        //
    }
}
