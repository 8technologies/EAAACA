<?php

namespace Modules\Field\Observers;

use Modules\Field\Entities\FieldTitle;

class FieldTitleObserver
{
    /**
     * Handle the FieldTitle "created" event.
     *
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return void
     */
    public function created(FieldTitle $fieldTitle)
    {
        //
    }

    /**
     * Handle the FieldTitle "updated" event.
     *
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return void
     */
    public function updated(FieldTitle $fieldTitle)
    {
        //
    }

    /**
     * Handle the FieldTitle "deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return void
     */
    public function deleted(FieldTitle $fieldTitle)
    {
        //
    }

    /**
     * Handle the FieldTitle "restored" event.
     *
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return void
     */
    public function restored(FieldTitle $fieldTitle)
    {
        //
    }

    /**
     * Handle the FieldTitle "force deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return void
     */
    public function forceDeleted(FieldTitle $fieldTitle)
    {
        //
    }
}
