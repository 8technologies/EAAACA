<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\CaseManagement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaseManagementPolicy
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
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseManagement  $caseManagement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CaseManagement $caseManagement)
    {
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.view') || $user->id == $caseManagement->user_id) {
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
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseManagement  $caseManagement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CaseManagement $caseManagement)
    {
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.update') || $user->id == $caseManagement->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseManagement  $caseManagement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CaseManagement $caseManagement)
    {
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.delete') || $user->id == $caseManagement->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseManagement  $caseManagement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CaseManagement $caseManagement)
    {
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.restore') || $user->id == $caseManagement->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseManagement  $caseManagement
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CaseManagement $caseManagement)
    {
        if ($user->can('manage.system') || $user->can('case_management.*') || $user->can('case_management.forcedelete') || $user->id == $caseManagement->user_id) {
            return true;
        }
        return false;
    }
}
