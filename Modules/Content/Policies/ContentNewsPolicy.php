<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentNews;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentNewsPolicy
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
        if ($user->can('manage.content') || $user->can('content_news.*') || $user->can('content_news.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentNews $contentNews)
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
        if ($user->can('manage.content') || $user->can('content_news.*') || $user->can('content_news.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentNews $contentNews)
    {
        if ($user->can('manage.content') || $user->can('content_news.*') || $user->can('content_news.update') || $user->id == $contentNews->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentNews $contentNews)
    {
        if ($user->can('manage.content') || $user->can('content_news.*') || $user->can('content_news.delete') || $user->id == $contentNews->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentNews $contentNews)
    {
        if ($user->can('manage.content') || $user->can('content_news.*') || $user->can('content_news.restore') || $user->id == $contentNews->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentNews  $contentNews
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentNews $contentNews)
    {
        if ($user->can('manage.content') || $user->can('content_news.*') || $user->can('content_news.forcedelete') || $user->id == $contentNews->user_id) {
            return true;
        }
        return false;
    }
}
