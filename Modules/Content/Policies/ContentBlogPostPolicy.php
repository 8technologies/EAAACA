<?php

namespace Modules\Content\Policies;

use Modules\Content\Entities\ContentBlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentBlogPostPolicy
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
        if ($user->can('manage.content') || $user->can('content_blog_post.*') || $user->can('content_blog_post.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ContentBlogPost $contentBlogPost)
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
        if ($user->can('manage.content') || $user->can('content_blog_post.*') || $user->can('content_blog_post.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ContentBlogPost $contentBlogPost)
    {
        if ($user->can('manage.content') || $user->can('content_blog_post.*') || $user->can('content_blog_post.update') || $user->id == $contentBlogPost->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ContentBlogPost $contentBlogPost)
    {
        if ($user->can('manage.content') || $user->can('content_blog_post.*') || $user->can('content_blog_post.delete') || $user->id == $contentBlogPost->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ContentBlogPost $contentBlogPost)
    {
        if ($user->can('manage.content') || $user->can('content_blog_post.*') || $user->can('content_blog_post.restore') || $user->id == $contentBlogPost->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ContentBlogPost $contentBlogPost)
    {
        if ($user->can('manage.content') || $user->can('content_blog_post.*') || $user->can('content_blog_post.forcedelete') || $user->id == $contentBlogPost->user_id) {
            return true;
        }
        return false;
    }
}
