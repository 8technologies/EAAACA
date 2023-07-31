<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
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
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Status  $status
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Status $status)
    {
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.view')) {
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
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Status  $status
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Status $status)
    {
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.update')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Status  $status
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Status $status)
    {
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Status  $status
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Status $status)
    {
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.restore')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Status  $status
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Status $status)
    {
        if ($user->can('manage.system') || $user->can('status.*') || $user->can('status.forcedelete')) {
            return true;
        }
        return false;
    }
}
