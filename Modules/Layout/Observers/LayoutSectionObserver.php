<?php

namespace Modules\Layout\Observers;

use Modules\Layout\Entities\LayoutSection;

class LayoutSectionObserver
{
    /**
     * Handle the LayoutSection "created" event.
     *
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return void
     */
    public function created(LayoutSection $layoutSection)
    {
        //
    }

    /**
     * Handle the LayoutSection "updated" event.
     *
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return void
     */
    public function updated(LayoutSection $layoutSection)
    {
        //
    }

    /**
     * Handle the LayoutSection "deleted" event.
     *
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return void
     */
    public function deleted(LayoutSection $layoutSection)
    {
        //
    }

    /**
     * Handle the LayoutSection "restored" event.
     *
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return void
     */
    public function restored(LayoutSection $layoutSection)
    {
        //
    }

    /**
     * Handle the LayoutSection "force deleted" event.
     *
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return void
     */
    public function forceDeleted(LayoutSection $layoutSection)
    {
        //
    }
}
