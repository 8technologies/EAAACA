<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentEvent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentEventPolicy
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
        if ($user->can('manage.content') || $user->can('content_event.*') || $user->can('content_event.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentEvent $contentEvent)
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
        if ($user->can('manage.content') || $user->can('content_event.*') || $user->can('content_event.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentEvent $contentEvent)
    {
        if ($user->can('manage.content') || $user->can('content_event.*') || $user->can('content_event.update') || $user->id == $contentEvent->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentEvent $contentEvent)
    {
        if ($user->can('manage.content') || $user->can('content_event.*') || $user->can('content_event.delete') || $user->id == $contentEvent->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentEvent $contentEvent)
    {
        if ($user->can('manage.content') || $user->can('content_event.*') || $user->can('content_event.restore') || $user->id == $contentEvent->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentEvent  $contentEvent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentEvent $contentEvent)
    {
        if ($user->can('manage.content') || $user->can('content_event.*') || $user->can('content_event.forcedelete') || $user->id == $contentEvent->user_id) {
            return true;
        }
        return false;
    }
}
