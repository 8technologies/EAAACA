<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentGallery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentGalleryPolicy
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
        if ($user->can('manage.content') || $user->can('content_gallery.*') || $user->can('content_gallery.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentGallery $contentGallery)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->can('manage.content') || $user->can('content_gallery.*') || $user->can('content_gallery.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentGallery $contentGallery)
    {
        if ($user->can('manage.content') || $user->can('content_gallery.*') || $user->can('content_gallery.update') || $user->id == $contentGallery->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentGallery $contentGallery)
    {
        if ($user->can('manage.content') || $user->can('content_gallery.*') || $user->can('content_gallery.delete') || $user->id == $contentGallery->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentGallery $contentGallery)
    {
        if ($user->can('manage.content') || $user->can('content_gallery.*') || $user->can('content_gallery.restore') || $user->id == $contentGallery->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentGallery  $contentGallery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentGallery $contentGallery)
    {
        if ($user->can('manage.content') || $user->can('content_gallery.*') || $user->can('content_gallery.forcedelete') || $user->id == $contentGallery->user_id) {
            return true;
        }
        return false;
    }
}
