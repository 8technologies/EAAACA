<?php

namespace Modules\RolePermission\Observers;

use Modules\RolePermission\Entities\SystemModel;

class SystemModelObserver
{
    /**
     * Handle the SystemModel "created" event.
     *
     * @param  \Modules\RolePermission\Entities\SystemModel  $systemModel
     * @return void
     */
    public function created(SystemModel $systemModel)
    {
        //
    }

    /**
     * Handle the SystemModel "updated" event.
     *
     * @param  \Modules\RolePermission\Entities\SystemModel  $systemModel
     * @return void
     */
    public function updated(SystemModel $systemModel)
    {
        //
    }

    /**
     * Handle the SystemModel "deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\SystemModel  $systemModel
     * @return void
     */
    public function deleted(SystemModel $systemModel)
    {
        //
    }

    /**
     * Handle the SystemModel "restored" event.
     *
     * @param  \Modules\RolePermission\Entities\SystemModel  $systemModel
     * @return void
     */
    public function restored(SystemModel $systemModel)
    {
        //
    }

    /**
     * Handle the SystemModel "force deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\SystemModel  $systemModel
     * @return void
     */
    public function forceDeleted(SystemModel $systemModel)
    {
        //
    }
}
