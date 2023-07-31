<?php

namespace Modules\RolePermission\Policies;

use Modules\RolePermission\Entities\PermissionType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class PermissionTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PermissionType $permissionType)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.view')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PermissionType $permissionType)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.update')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PermissionType $permissionType)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PermissionType $permissionType)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.restore')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\RolePermission\Entities\PermissionType  $permissionType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PermissionType $permissionType)
    {
        if ($user->can('manage.role_permission') || $user->can('permission_type.*') || $user->can('permission_type.forcedelete')) {
            return true;
        }
        return false;
    }
}
