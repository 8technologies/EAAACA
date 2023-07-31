<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\ForumCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumCategoryPolicy
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
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumCategory  $forumCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ForumCategory $forumCategory)
    {
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.view') || $user->id == $forumCategory->user_id) {
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
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumCategory  $forumCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ForumCategory $forumCategory)
    {
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.update') || $user->id == $forumCategory->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumCategory  $forumCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ForumCategory $forumCategory)
    {
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.delete') || $user->id == $forumCategory->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumCategory  $forumCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ForumCategory $forumCategory)
    {
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.restore') || $user->id == $forumCategory->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumCategory  $forumCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ForumCategory $forumCategory)
    {
        if ($user->can('manage.system') || $user->can('forum_category.*') || $user->can('forum_category.forcedelete') || $user->id == $forumCategory->user_id) {
            return true;
        }
        return false;
    }
}
