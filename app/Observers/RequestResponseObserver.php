<?php

namespace App\Observers;

use App\Models\Modules\Custom\Entities\RequestResponse;

class RequestResponseObserver
{
    /**
     * Handle the RequestResponse "created" event.
     *
     * @param  \App\Models\Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return void
     */
    public function created(RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Handle the RequestResponse "updated" event.
     *
     * @param  \App\Models\Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return void
     */
    public function updated(RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Handle the RequestResponse "deleted" event.
     *
     * @param  \App\Models\Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return void
     */
    public function deleted(RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Handle the RequestResponse "restored" event.
     *
     * @param  \App\Models\Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return void
     */
    public function restored(RequestResponse $requestResponse)
    {
        //
    }

    /**
     * Handle the RequestResponse "force deleted" event.
     *
     * @param  \App\Models\Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return void
     */
    public function forceDeleted(RequestResponse $requestResponse)
    {
        //
    }
}
