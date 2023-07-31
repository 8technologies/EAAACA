<?php

namespace Modules\Media\Policies;

use Modules\Media\Entities\Media;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\Media  $Media
     * @return mixed
     */
    public function view(User $user, Media $Media)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.view') || $user->id == $Media->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\Media  $Media
     * @return mixed
     */
    public function update(User $user, Media $Media)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.update') || $user->id == $Media->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\Media  $Media
     * @return mixed
     */
    public function delete(User $user, Media $Media)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.delete') || $user->id == $Media->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\Media  $Media
     * @return mixed
     */
    public function restore(User $user, Media $Media)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.restore') || $user->id == $Media->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\Media  $Media
     * @return mixed
     */
    public function forceDelete(User $user, Media $Media)
    {
        if ($user->can('manage.media') || $user->can('file.*') || $user->can('file.forcedelete') || $user->id == $Media->user_id) {
            return true;
        }
        return false;
    }
}