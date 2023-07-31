<?php

namespace Modules\Field\Observers;

use Modules\Field\Entities\FieldHtml;

class FieldHtmlObserver
{
    /**
     * Handle the FieldHtml "created" event.
     *
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return void
     */
    public function created(FieldHtml $fieldHtml)
    {
        //
    }

    /**
     * Handle the FieldHtml "updated" event.
     *
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return void
     */
    public function updated(FieldHtml $fieldHtml)
    {
        //
    }

    /**
     * Handle the FieldHtml "deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return void
     */
    public function deleted(FieldHtml $fieldHtml)
    {
        //
    }

    /**
     * Handle the FieldHtml "restored" event.
     *
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return void
     */
    public function restored(FieldHtml $fieldHtml)
    {
        //
    }

    /**
     * Handle the FieldHtml "force deleted" event.
     *
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return void
     */
    public function forceDeleted(FieldHtml $fieldHtml)
    {
        //
    }
}
