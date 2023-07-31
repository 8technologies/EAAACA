<?php

namespace Modules\Layout\Observers;

use Modules\Layout\Entities\LayoutRow;

class LayoutRowObserver
{
    /**
     * Handle the LayoutRow "created" event.
     *
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return void
     */
    public function created(LayoutRow $layoutRow)
    {
        //
    }

    /**
     * Handle the LayoutRow "updated" event.
     *
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return void
     */
    public function updated(LayoutRow $layoutRow)
    {
        //
    }

    /**
     * Handle the LayoutRow "deleted" event.
     *
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return void
     */
    public function deleted(LayoutRow $layoutRow)
    {
        //
    }

    /**
     * Handle the LayoutRow "restored" event.
     *
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return void
     */
    public function restored(LayoutRow $layoutRow)
    {
        //
    }

    /**
     * Handle the LayoutRow "force deleted" event.
     *
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return void
     */
    public function forceDeleted(LayoutRow $layoutRow)
    {
        //
    }
}
