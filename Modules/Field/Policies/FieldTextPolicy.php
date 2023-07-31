<?php

namespace Modules\Field\Policies;

use Modules\Field\Entities\FieldText;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldTextPolicy
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
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FieldText $fieldText)
    {
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.view') || $user->id == $fieldText->user_id) {
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
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FieldText $fieldText)
    {
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.update') || $user->id == $fieldText->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FieldText $fieldText)
    {
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.delete') || $user->id == $fieldText->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FieldText $fieldText)
    {
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.restore') || $user->id == $fieldText->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldText  $fieldText
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FieldText $fieldText)
    {
        if ($user->can('manage.field') || $user->can('field_text.*') || $user->can('field_text.forcedelete') || $user->id == $fieldText->user_id) {
            return true;
        }
        return false;
    }
}
