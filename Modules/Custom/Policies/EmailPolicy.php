<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\Email;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailPolicy
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
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Email  $email
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Email $email)
    {
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.view') || $user->id == $email->user_id) {
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
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Email  $email
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Email $email)
    {
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.update') || $user->id == $email->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Email  $email
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Email $email)
    {
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.delete') || $user->id == $email->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Email  $email
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Email $email)
    {
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.restore') || $user->id == $email->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Email  $email
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Email $email)
    {
        if ($user->can('manage.system') || $user->can('email.*') || $user->can('email.forcedelete') || $user->id == $email->user_id) {
            return true;
        }
        return false;
    }
}
