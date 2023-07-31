<?php

namespace Modules\RolePermission\Observers;

use Modules\RolePermission\Entities\Role;

class RoleObserver
{
    /**
     * Handle the Role "created" event.
     *
     * @param  \Modules\RolePermission\Entities\Role  $role
     * @return void
     */
    public function created(Role $role)
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \Modules\RolePermission\Entities\Role  $role
     * @return void
     */
    public function updated(Role $role)
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \Modules\RolePermission\Entities\Role  $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \Modules\RolePermission\Entities\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
