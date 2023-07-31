<?php

namespace Modules\Field\Policies;

use Modules\Field\Entities\FieldImage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldImagePolicy
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
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FieldImage $fieldImage)
    {
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.view') || $user->id == $fieldImage->user_id) {
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
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FieldImage $fieldImage)
    {
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.update') || $user->id == $fieldImage->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FieldImage $fieldImage)
    {
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.delete') || $user->id == $fieldImage->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FieldImage $fieldImage)
    {
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.restore') || $user->id == $fieldImage->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldImage  $fieldImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FieldImage $fieldImage)
    {
        if ($user->can('manage.field') || $user->can('field_image.*') || $user->can('field_image.forcedelete') || $user->id == $fieldImage->user_id) {
            return true;
        }
        return false;
    }
}
