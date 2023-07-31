<?php

namespace Modules\Media\Policies;

use Modules\Media\Entities\MediaProvider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaProviderPolicy
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
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MediaProvider $mediaProvider)
    {
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.view') || $user->id == $mediaProvider->user_id) {
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
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MediaProvider $mediaProvider)
    {
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.update') || $user->id == $mediaProvider->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MediaProvider $mediaProvider)
    {
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.delete') || $user->id == $mediaProvider->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MediaProvider $mediaProvider)
    {
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.restore') || $user->id == $mediaProvider->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Media\Entities\MediaProvider  $mediaProvider
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MediaProvider $mediaProvider)
    {
        if ($user->can('manage.media') || $user->can('media_provider.*') || $user->can('media_provider.forcedelete') || $user->id == $mediaProvider->user_id) {
            return true;
        }
        return false;
    }
}
