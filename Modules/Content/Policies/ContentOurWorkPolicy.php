<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentOurWork;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentOurWorkPolicy
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
        if ($user->can('manage.content') || $user->can('content_our_work.*') || $user->can('content_our_work.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentOurWork $contentOurWork)
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
        if ($user->can('manage.content') || $user->can('content_our_work.*') || $user->can('content_our_work.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentOurWork $contentOurWork)
    {
        if ($user->can('manage.content') || $user->can('content_our_work.*') || $user->can('content_our_work.update') || $user->id == $contentOurWork->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentOurWork $contentOurWork)
    {
        if ($user->can('manage.content') || $user->can('content_our_work.*') || $user->can('content_our_work.delete') || $user->id == $contentOurWork->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentOurWork $contentOurWork)
    {
        if ($user->can('manage.content') || $user->can('content_our_work.*') || $user->can('content_our_work.restore') || $user->id == $contentOurWork->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentOurWork  $contentOurWork
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentOurWork $contentOurWork)
    {
        if ($user->can('manage.content') || $user->can('content_our_work.*') || $user->can('content_our_work.forcedelete') || $user->id == $contentOurWork->user_id) {
            return true;
        }
        return false;
    }
}
