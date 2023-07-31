<?php

namespace App\Observers;

use App\Models\Modules\Comment\Entities\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Modules\Comment\Entities\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "updated" event.
     *
     * @param  \App\Models\Modules\Comment\Entities\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param  \App\Models\Modules\Comment\Entities\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     *
     * @param  \App\Models\Modules\Comment\Entities\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     *
     * @param  \App\Models\Modules\Comment\Entities\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
