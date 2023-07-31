<?php

namespace Modules\RolePermission\Observers;

use Modules\RolePermission\Entities\PermissionType;

class PermissionTypeObserver
{
    /**
     * Handle the PermissionType "created" event.
     *
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return void
     */
    public function created(PermissionType $permissionType)
    {
        //
    }

    /**
     * Handle the PermissionType "updated" event.
     *
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return void
     */
    public function updated(PermissionType $permissionType)
    {
        //
    }

    /**
     * Handle the PermissionType "deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return void
     */
    public function deleted(PermissionType $permissionType)
    {
        //
    }

    /**
     * Handle the PermissionType "restored" event.
     *
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return void
     */
    public function restored(PermissionType $permissionType)
    {
        //
    }

    /**
     * Handle the PermissionType "force deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return void
     */
    public function forceDeleted(PermissionType $permissionType)
    {
        //
    }
}
