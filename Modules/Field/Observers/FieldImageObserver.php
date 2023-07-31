<?php

namespace Modules\Field\Observers;

use Modules\Field\Entities\FieldImage;

class FieldImageObserver
{
    /**
     * Handle the FieldImage "created" event.
     *
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return void
     */
    public function created(FieldImage $fieldImage)
    {
        //
    }

    /**
     * Handle the FieldImage "updated" event.
     *
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return void
     */
    public function updated(FieldImage $fieldImage)
    {
        //
    }

    /**
     * Handle the FieldImage "deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return void
     */
    public function deleted(FieldImage $fieldImage)
    {
        //
    }

    /**
     * Handle the FieldImage "restored" event.
     *
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return void
     */
    public function restored(FieldImage $fieldImage)
    {
        //
    }

    /**
     * Handle the FieldImage "force deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return void
     */
    public function forceDeleted(FieldImage $fieldImage)
    {
        //
    }
}
