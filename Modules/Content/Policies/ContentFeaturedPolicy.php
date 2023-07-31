<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentFeatured;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentFeaturedPolicy
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
        if ($user->can('manage.content') || $user->can('content_featured.*') || $user->can('content_featured.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentFeatured $contentFeatured)
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
        if ($user->can('manage.content') || $user->can('content_featured.*') || $user->can('content_featured.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentFeatured $contentFeatured)
    {
        if ($user->can('manage.content') || $user->can('content_featured.*') || $user->can('content_featured.update') || $user->id == $contentFeatured->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentFeatured $contentFeatured)
    {
        if ($user->can('manage.content') || $user->can('content_featured.*') || $user->can('content_featured.delete') || $user->id == $contentFeatured->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentFeatured $contentFeatured)
    {
        if ($user->can('manage.content') || $user->can('content_featured.*') || $user->can('content_featured.restore') || $user->id == $contentFeatured->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentFeatured  $contentFeatured
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentFeatured $contentFeatured)
    {
        if ($user->can('manage.content') || $user->can('content_featured.*') || $user->can('content_featured.forcedelete') || $user->id == $contentFeatured->user_id) {
            return true;
        }
        return false;
    }
}
