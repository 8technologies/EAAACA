<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentBlogPost;

class ContentBlogPostObserver
{
    /**
     * Handle the ContentBlogPost "created" event.
     *
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return void
     */
    public function created(ContentBlogPost $contentBlogPost)
    {
        //
    }

    /**
     * Handle the ContentBlogPost "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return void
     */
    public function updated(ContentBlogPost $contentBlogPost)
    {
        //
    }

    /**
     * Handle the ContentBlogPost "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return void
     */
    public function deleting(ContentBlogPost $contentBlogPost)
    {
        if (method_exists($contentBlogPost, 'media')) {
            $contentBlogPost->media()->detach();
        }

        if (method_exists($contentBlogPost, 'tags')) {
            $contentBlogPost->tags()->detach();
        }
    }

    /**
     * Handle the ContentBlogPost "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return void
     */
    public function deleted(ContentBlogPost $contentBlogPost)
    {
        //
    }

    /**
     * Handle the ContentBlogPost "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return void
     */
    public function restored(ContentBlogPost $contentBlogPost)
    {
        //
    }

    /**
     * Handle the ContentBlogPost "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentBlogPost  $contentBlogPost
     * @return void
     */
    public function forceDeleted(ContentBlogPost $contentBlogPost)
    {
        //
    }
}
