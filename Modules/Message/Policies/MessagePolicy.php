<?php

namespace Modules\Message\Policies;

use Modules\Message\Entities\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
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
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Message\Entities\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Message $message)
    {
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.view') || $user->id == $message->user_id || $user->id == $message->to_user_id) {
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
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Message\Entities\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Message $message)
    {
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.update') || $user->id == $message->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Message\Entities\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Message $message)
    {
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.delete') || $user->id == $message->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Message\Entities\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Message $message)
    {
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.restore') || $user->id == $message->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Message\Entities\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Message $message)
    {
        if ($user->can('manage.system') || $user->can('message.*') || $user->can('message.forcedelete') || $user->id == $message->user_id) {
            return true;
        }
        return false;
    }
}
