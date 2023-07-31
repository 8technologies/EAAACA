<?php

namespace Modules\Content\Observers;

use Modules\Content\Entities\ContentPage;

class ContentPageObserver
{
    /**
     * Handle the ContentPage "created" event.
     *
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return void
     */
    public function created(ContentPage $contentPage)
    {
        //
    }

    /**
     * Handle the ContentPage "updated" event.
     *
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return void
     */
    public function updated(ContentPage $contentPage)
    {
        //
    }

    /**
     * Handle the ContentPage "deleting" event.
     *
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return void
     */
    public function deleting(ContentPage $contentPage)
    {
        if (method_exists($contentPage, 'media')) {
            $contentPage->media()->detach();
        }

        if (method_exists($contentPage, 'tags')) {
            $contentPage->tags()->detach();
        }
    }

    /**
     * Handle the ContentPage "deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return void
     */
    public function deleted(ContentPage $contentPage)
    {
        //
    }

    /**
     * Handle the ContentPage "restored" event.
     *
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return void
     */
    public function restored(ContentPage $contentPage)
    {
        //
    }

    /**
     * Handle the ContentPage "force deleted" event.
     *
     * @param  \Modules\Content\Entities\ContentPage  $contentPage
     * @return void
     */
    public function forceDeleted(ContentPage $contentPage)
    {
        //
    }
}
