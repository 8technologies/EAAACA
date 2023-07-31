<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\NatureOfOffence;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NatureOfOffencePolicy
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
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\NatureOfOffence  $natureOfOffence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, NatureOfOffence $natureOfOffence)
    {
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.view') || $user->id == $natureOfOffence->user_id) {
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
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\NatureOfOffence  $natureOfOffence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, NatureOfOffence $natureOfOffence)
    {
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.update') || $user->id == $natureOfOffence->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\NatureOfOffence  $natureOfOffence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, NatureOfOffence $natureOfOffence)
    {
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.delete') || $user->id == $natureOfOffence->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\NatureOfOffence  $natureOfOffence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, NatureOfOffence $natureOfOffence)
    {
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.restore') || $user->id == $natureOfOffence->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\NatureOfOffence  $natureOfOffence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, NatureOfOffence $natureOfOffence)
    {
        if ($user->can('manage.system') || $user->can('nature_of_offence.*') || $user->can('nature_of_offence.forcedelete') || $user->id == $natureOfOffence->user_id) {
            return true;
        }
        return false;
    }
}
