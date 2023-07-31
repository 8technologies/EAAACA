<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\CaseCoordinator;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaseCoordinatorPolicy
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
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseCoordinator  $caseCoordinator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CaseCoordinator $caseCoordinator)
    {
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.view') || $user->id == $caseCoordinator->user_id) {
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
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseCoordinator  $caseCoordinator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CaseCoordinator $caseCoordinator)
    {
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.update') || $user->id == $caseCoordinator->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseCoordinator  $caseCoordinator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CaseCoordinator $caseCoordinator)
    {
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.delete') || $user->id == $caseCoordinator->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseCoordinator  $caseCoordinator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CaseCoordinator $caseCoordinator)
    {
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.restore') || $user->id == $caseCoordinator->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseCoordinator  $caseCoordinator
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CaseCoordinator $caseCoordinator)
    {
        if ($user->can('manage.system') || $user->can('case_coordinator.*') || $user->can('case_coordinator.forcedelete') || $user->id == $caseCoordinator->user_id) {
            return true;
        }
        return false;
    }
}
