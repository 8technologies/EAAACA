<?php

namespace Modules\Field\Observers;

use Modules\Field\Entities\FieldText;

class FieldTextObserver
{
    /**
     * Handle the FieldText "created" event.
     *
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return void
     */
    public function created(FieldText $fieldText)
    {
        //
    }

    /**
     * Handle the FieldText "updated" event.
     *
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return void
     */
    public function updated(FieldText $fieldText)
    {
        //
    }

    /**
     * Handle the FieldText "deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return void
     */
    public function deleted(FieldText $fieldText)
    {
        //
    }

    /**
     * Handle the FieldText "restored" event.
     *
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return void
     */
    public function restored(FieldText $fieldText)
    {
        //
    }

    /**
     * Handle the FieldText "force deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return void
     */
    public function forceDeleted(FieldText $fieldText)
    {
        //
    }
}
