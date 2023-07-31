<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\CaseType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaseTypePolicy
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
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseType  $caseType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CaseType $caseType)
    {
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.view') || $user->id == $caseType->user_id) {
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
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseType  $caseType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CaseType $caseType)
    {
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.update') || $user->id == $caseType->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseType  $caseType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CaseType $caseType)
    {
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.delete') || $user->id == $caseType->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseType  $caseType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CaseType $caseType)
    {
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.restore') || $user->id == $caseType->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseType  $caseType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CaseType $caseType)
    {
        if ($user->can('manage.system') || $user->can('case_type.*') || $user->can('case_type.forcedelete') || $user->id == $caseType->user_id) {
            return true;
        }
        return false;
    }
}
