<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentPublication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPublicationPolicy
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
        if ($user->can('manage.content') || $user->can('content_publication.*') || $user->can('content_publication.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentPublication $contentPublication)
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
        if ($user->can('manage.content') || $user->can('content_publication.*') || $user->can('content_publication.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentPublication $contentPublication)
    {
        if ($user->can('manage.content') || $user->can('content_publication.*') || $user->can('content_publication.update') || $user->id == $contentPublication->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentPublication $contentPublication)
    {
        if ($user->can('manage.content') || $user->can('content_publication.*') || $user->can('content_publication.delete') || $user->id == $contentPublication->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentPublication $contentPublication)
    {
        if ($user->can('manage.content') || $user->can('content_publication.*') || $user->can('content_publication.restore') || $user->id == $contentPublication->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPublication  $contentPublication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentPublication $contentPublication)
    {
        if ($user->can('manage.content') || $user->can('content_publication.*') || $user->can('content_publication.forcedelete') || $user->id == $contentPublication->user_id) {
            return true;
        }
        return false;
    }
}
