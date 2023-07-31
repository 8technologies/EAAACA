<?php

namespace Modules\Field\Policies;

use Modules\Field\Entities\FieldLink;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldLinkPolicy
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
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FieldLink $fieldLink)
    {
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.view') || $user->id == $fieldLink->user_id) {
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
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FieldLink $fieldLink)
    {
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.update') || $user->id == $fieldLink->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FieldLink $fieldLink)
    {
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.delete') || $user->id == $fieldLink->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FieldLink $fieldLink)
    {
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.restore') || $user->id == $fieldLink->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldLink  $fieldLink
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FieldLink $fieldLink)
    {
        if ($user->can('manage.field') || $user->can('field_link.*') || $user->can('field_link.forcedelete') || $user->id == $fieldLink->user_id) {
            return true;
        }
        return false;
    }
}
