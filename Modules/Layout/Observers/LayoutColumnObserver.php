<?php

namespace Modules\Layout\Observers;

use Modules\Layout\Entities\LayoutColumn;

class LayoutColumnObserver
{
    /**
     * Handle the LayoutColumn "created" event.
     *
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return void
     */
    public function created(LayoutColumn $layoutColumn)
    {
        //
    }

    /**
     * Handle the LayoutColumn "updated" event.
     *
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return void
     */
    public function updated(LayoutColumn $layoutColumn)
    {
        //
    }

    /**
     * Handle the LayoutColumn "deleted" event.
     *
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return void
     */
    public function deleted(LayoutColumn $layoutColumn)
    {
        //
    }

    /**
     * Handle the LayoutColumn "restored" event.
     *
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return void
     */
    public function restored(LayoutColumn $layoutColumn)
    {
        //
    }

    /**
     * Handle the LayoutColumn "force deleted" event.
     *
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return void
     */
    public function forceDeleted(LayoutColumn $layoutColumn)
    {
        //
    }
}
