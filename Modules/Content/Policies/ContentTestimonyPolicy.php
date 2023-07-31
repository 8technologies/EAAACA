<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentTestimony;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentTestimonyPolicy
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
        if ($user->can('manage.content') || $user->can('content_testimony.*') || $user->can('content_testimony.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentTestimony $contentTestimony)
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
        if ($user->can('manage.content') || $user->can('content_testimony.*') || $user->can('content_testimony.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentTestimony $contentTestimony)
    {
        if ($user->can('manage.content') || $user->can('content_testimony.*') || $user->can('content_testimony.update') || $user->id == $contentTestimony->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentTestimony $contentTestimony)
    {
        if ($user->can('manage.content') || $user->can('content_testimony.*') || $user->can('content_testimony.delete') || $user->id == $contentTestimony->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentTestimony $contentTestimony)
    {
        if ($user->can('manage.content') || $user->can('content_testimony.*') || $user->can('content_testimony.restore') || $user->id == $contentTestimony->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentTestimony  $contentTestimony
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentTestimony $contentTestimony)
    {
        if ($user->can('manage.content') || $user->can('content_testimony.*') || $user->can('content_testimony.forcedelete') || $user->id == $contentTestimony->user_id) {
            return true;
        }
        return false;
    }
}
