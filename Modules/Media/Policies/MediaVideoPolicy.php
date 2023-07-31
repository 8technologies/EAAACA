<?php

namespace Modules\Media\Policies;

use Modules\Media\Entities\MediaVideo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaVideoPolicy
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
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MediaVideo $mediaVideo)
    {
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.view') || $user->id == $mediaVideo->user_id) {
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
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MediaVideo $mediaVideo)
    {
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.update') || $user->id == $mediaVideo->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MediaVideo $mediaVideo)
    {
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.delete') || $user->id == $mediaVideo->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MediaVideo $mediaVideo)
    {
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.restore') || $user->id == $mediaVideo->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaVideo  $mediaVideo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MediaVideo $mediaVideo)
    {
        if ($user->can('manage.media') || $user->can('media_video.*') || $user->can('media_video.forcedelete') || $user->id == $mediaVideo->user_id) {
            return true;
        }
        return false;
    }
}
