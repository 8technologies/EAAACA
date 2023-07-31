<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\InternalCommunication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalCommunicationPolicy
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
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InternalCommunication  $internalCommunication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InternalCommunication $internalCommunication)
    {
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.view') || $user->id == $internalCommunication->user_id) {
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
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InternalCommunication  $internalCommunication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InternalCommunication $internalCommunication)
    {
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.update') || $user->id == $internalCommunication->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InternalCommunication  $internalCommunication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InternalCommunication $internalCommunication)
    {
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.delete') || $user->id == $internalCommunication->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InternalCommunication  $internalCommunication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InternalCommunication $internalCommunication)
    {
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.restore') || $user->id == $internalCommunication->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InternalCommunication  $internalCommunication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InternalCommunication $internalCommunication)
    {
        if ($user->can('manage.system') || $user->can('internal_communication.*') || $user->can('internal_communication.forcedelete') || $user->id == $internalCommunication->user_id) {
            return true;
        }
        return false;
    }
}
