<?php

namespace Modules\Field\Policies;

use Modules\Field\Entities\FieldTitle;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldTitlePolicy
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
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FieldTitle $fieldTitle)
    {
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.view') || $user->id == $fieldTitle->user_id) {
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
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FieldTitle $fieldTitle)
    {
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.update') || $user->id == $fieldTitle->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FieldTitle $fieldTitle)
    {
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.delete') || $user->id == $fieldTitle->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FieldTitle $fieldTitle)
    {
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.restore') || $user->id == $fieldTitle->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldTitle  $fieldTitle
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FieldTitle $fieldTitle)
    {
        if ($user->can('manage.field') || $user->can('field_title.*') || $user->can('field_title.forcedelete') || $user->id == $fieldTitle->user_id) {
            return true;
        }
        return false;
    }
}
