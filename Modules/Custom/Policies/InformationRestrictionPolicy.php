<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\InformationRestriction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InformationRestrictionPolicy
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
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRestriction  $informationRestriction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InformationRestriction $informationRestriction)
    {
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.view') || $user->id == $informationRestriction->user_id) {
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
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRestriction  $informationRestriction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InformationRestriction $informationRestriction)
    {
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.update') || $user->id == $informationRestriction->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRestriction  $informationRestriction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InformationRestriction $informationRestriction)
    {
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.delete') || $user->id == $informationRestriction->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRestriction  $informationRestriction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InformationRestriction $informationRestriction)
    {
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.restore') || $user->id == $informationRestriction->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRestriction  $informationRestriction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InformationRestriction $informationRestriction)
    {
        if ($user->can('manage.system') || $user->can('information_restriction.*') || $user->can('information_restriction.forcedelete') || $user->id == $informationRestriction->user_id) {
            return true;
        }
        return false;
    }
}
