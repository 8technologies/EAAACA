<?php

namespace Modules\Block\Observers;

use Modules\Block\Entities\Block;

class BlockObserver
{
    /**
     * Handle the Block "created" event.
     *
     * @param  \Modules\Block\Entities\Block  $block
     * @return void
     */
    public function created(Block $block)
    {
        //
    }

    /**
     * Handle the Block "updated" event.
     *
     * @param  \Modules\Block\Entities\Block  $block
     * @return void
     */
    public function updated(Block $block)
    {
        //
    }

    /**
     * Handle the Block "deleting" event.
     *
     * @param  \Modules\Block\Entities\Block  $block
     * @return void
     */
    public function deleting(Block $block)
    {
        //
    }

    /**
     * Handle the Block "deleted" event.
     *
     * @param  \Modules\Block\Entities\Block  $block
     * @return void
     */
    public function deleted(Block $block)
    {
        //
    }

    /**
     * Handle the Block "restored" event.
     *
     * @param  \Modules\Block\Entities\Block  $block
     * @return void
     */
    public function restored(Block $block)
    {
        //
    }

    /**
     * Handle the Block "force deleted" event.
     *
     * @param  \Modules\Block\Entities\Block  $block
     * @return void
     */
    public function forceDeleted(Block $block)
    {
        //
    }
}
