<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\ForumTopic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumTopicPolicy
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
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumTopic  $forumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ForumTopic $forumTopic)
    {
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.view') || $user->id == $forumTopic->user_id) {
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
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumTopic  $forumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ForumTopic $forumTopic)
    {
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.update') || $user->id == $forumTopic->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumTopic  $forumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ForumTopic $forumTopic)
    {
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.delete') || $user->id == $forumTopic->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumTopic  $forumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ForumTopic $forumTopic)
    {
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.restore') || $user->id == $forumTopic->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\ForumTopic  $forumTopic
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ForumTopic $forumTopic)
    {
        if ($user->can('manage.system') || $user->can('forum_topic.*') || $user->can('forum_topic.forcedelete') || $user->id == $forumTopic->user_id) {
            return true;
        }
        return false;
    }
}
