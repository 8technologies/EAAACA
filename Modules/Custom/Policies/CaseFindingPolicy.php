<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\CaseFinding;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaseFindingPolicy
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
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseFinding  $caseFinding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CaseFinding $caseFinding)
    {
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.view') || $user->id == $caseFinding->user_id) {
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
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseFinding  $caseFinding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CaseFinding $caseFinding)
    {
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.update') || $user->id == $caseFinding->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseFinding  $caseFinding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CaseFinding $caseFinding)
    {
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.delete') || $user->id == $caseFinding->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseFinding  $caseFinding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CaseFinding $caseFinding)
    {
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.restore') || $user->id == $caseFinding->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\CaseFinding  $caseFinding
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CaseFinding $caseFinding)
    {
        if ($user->can('manage.system') || $user->can('case_finding.*') || $user->can('case_finding.forcedelete') || $user->id == $caseFinding->user_id) {
            return true;
        }
        return false;
    }
}
