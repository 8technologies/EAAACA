<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentPage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPagePolicy
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
        if ($user->can('manage.content') || $user->can('content_page.*') || $user->can('content_page.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentPage $contentPage)
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
        if ($user->can('manage.content') || $user->can('content_page.*') || $user->can('content_page.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentPage $contentPage)
    {
        if ($user->can('manage.content') || $user->can('content_page.*') || $user->can('content_page.update') || $user->id == $contentPage->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentPage $contentPage)
    {
        if ($user->can('manage.content') || $user->can('content_page.*') || $user->can('content_page.delete') || $user->id == $contentPage->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentPage $contentPage)
    {
        if ($user->can('manage.content') || $user->can('content_page.*') || $user->can('content_page.restore') || $user->id == $contentPage->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentPage $contentPage)
    {
        if ($user->can('manage.content') || $user->can('content_page.*') || $user->can('content_page.forcedelete') || $user->id == $contentPage->user_id) {
            return true;
        }
        return false;
    }
}
