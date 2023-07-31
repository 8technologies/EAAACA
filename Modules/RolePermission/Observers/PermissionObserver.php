<?php

namespace Modules\RolePermission\Observers;

use Modules\RolePermission\Entities\Permission;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \Modules\RolePermission\Entities\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "updated" event.
     *
     * @param  \Modules\RolePermission\Entities\Permission  $permission
     * @return void
     */
    public function updated(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\Permission  $permission
     * @return void
     */
    public function deleted(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "restored" event.
     *
     * @param  \Modules\RolePermission\Entities\Permission  $permission
     * @return void
     */
    public function restored(Permission $permission)
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\Permission  $permission
     * @return void
     */
    public function forceDeleted(Permission $permission)
    {
        //
    }
}
