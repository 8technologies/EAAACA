<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\JobAdvert;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobAdvertPolicy
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
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\JobAdvert  $jobAdvert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, JobAdvert $jobAdvert)
    {
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.view') || $user->id == $jobAdvert->user_id) {
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
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\JobAdvert  $jobAdvert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, JobAdvert $jobAdvert)
    {
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.update') || $user->id == $jobAdvert->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\JobAdvert  $jobAdvert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, JobAdvert $jobAdvert)
    {
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.delete') || $user->id == $jobAdvert->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\JobAdvert  $jobAdvert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, JobAdvert $jobAdvert)
    {
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.restore') || $user->id == $jobAdvert->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\JobAdvert  $jobAdvert
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, JobAdvert $jobAdvert)
    {
        if ($user->can('manage.system') || $user->can('job_advert.*') || $user->can('job_advert.forcedelete') || $user->id == $jobAdvert->user_id) {
            return true;
        }
        return false;
    }
}
