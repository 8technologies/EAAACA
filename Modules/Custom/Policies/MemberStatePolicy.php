<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\MemberState;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberStatePolicy
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
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\MemberState  $memberState
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MemberState $memberState)
    {
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.view') || $user->id == $memberState->user_id) {
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
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\MemberState  $memberState
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MemberState $memberState)
    {
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.update') || $user->id == $memberState->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\MemberState  $memberState
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MemberState $memberState)
    {
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.delete') || $user->id == $memberState->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\MemberState  $memberState
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MemberState $memberState)
    {
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.restore') || $user->id == $memberState->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\MemberState  $memberState
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MemberState $memberState)
    {
        if ($user->can('manage.system') || $user->can('member_state.*') || $user->can('member_state.forcedelete') || $user->id == $memberState->user_id) {
            return true;
        }
        return false;
    }
}
