<?php

namespace Modules\Field\Observers;

use Modules\Field\Entities\FieldBlock;

class FieldBlockObserver
{
    /**
     * Handle the FieldBlock "created" event.
     *
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return void
     */
    public function created(FieldBlock $fieldBlock)
    {
        //
    }

    /**
     * Handle the FieldBlock "updated" event.
     *
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return void
     */
    public function updated(FieldBlock $fieldBlock)
    {
        //
    }

    /**
     * Handle the FieldBlock "deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return void
     */
    public function deleted(FieldBlock $fieldBlock)
    {
        //
    }

    /**
     * Handle the FieldBlock "restored" event.
     *
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return void
     */
    public function restored(FieldBlock $fieldBlock)
    {
        //
    }

    /**
     * Handle the FieldBlock "force deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return void
     */
    public function forceDeleted(FieldBlock $fieldBlock)
    {
        //
    }
}
