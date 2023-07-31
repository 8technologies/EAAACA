<?php

namespace Modules\RolePermission\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.view')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.update')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.restore')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Spatie\Permission\Models\Role  $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        if ($user->can('manage.role_permission') || $user->can('role.*') || $user->can('role.forcedelete')) {
            return true;
        }
        return false;
    }
}