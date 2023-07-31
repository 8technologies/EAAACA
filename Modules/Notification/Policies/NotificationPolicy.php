<?php

namespace Modules\Notification\Policies;

use App\Models\User;
use Modules\Notification\Entities\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return mixed
     */
    public function view(User $user, Notification $notification)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.view') || $user->id == $notification->notifiable_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return mixed
     */
    public function update(User $user, Notification $notification)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.update')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return mixed
     */
    public function delete(User $user, Notification $notification)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.delete')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return mixed
     */
    public function restore(User $user, Notification $notification)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.restore')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Notification\Entities\Notification  $notification
     * @return mixed
     */
    public function forceDelete(User $user, Notification $notification)
    {
        if ($user->can('manage.notification') || $user->can('notification.*') || $user->can('notification.forcedelete')) {
            return true;
        }
        return false;
    }
}
