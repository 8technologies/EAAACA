<?php

namespace Modules\RolePermission\Policies;

use Modules\RolePermission\Entities\SystemModel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemModelPolicy
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
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemModel  $systemModel
     * @return mixed
     */
    public function view(User $user, SystemModel $systemModel)
    {
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.view')) {
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
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemModel  $systemModel
     * @return mixed
     */
    public function update(User $user, SystemModel $systemModel)
    {
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.update')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemModel  $systemModel
     * @return mixed
     */
    public function delete(User $user, SystemModel $systemModel)
    {
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemModel  $systemModel
     * @return mixed
     */
    public function restore(User $user, SystemModel $systemModel)
    {
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.restore')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SystemModel  $systemModel
     * @return mixed
     */
    public function forceDelete(User $user, SystemModel $systemModel)
    {
        if ($user->can('manage.role_permission') || $user->can('model.*') || $user->can('model.forcedelete')) {
            return true;
        }
        return false;
    }
}
