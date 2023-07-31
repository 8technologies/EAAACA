<?php

namespace Modules\Field\Policies;

use Modules\Field\Entities\FieldBlock;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldBlockPolicy
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
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FieldBlock $fieldBlock)
    {
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.view') || $user->id == $fieldBlock->user_id) {
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
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FieldBlock $fieldBlock)
    {
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.update') || $user->id == $fieldBlock->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FieldBlock $fieldBlock)
    {
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.delete') || $user->id == $fieldBlock->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FieldBlock $fieldBlock)
    {
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.restore') || $user->id == $fieldBlock->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldBlock  $fieldBlock
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FieldBlock $fieldBlock)
    {
        if ($user->can('manage.field') || $user->can('field_block.*') || $user->can('field_block.forcedelete') || $user->id == $fieldBlock->user_id) {
            return true;
        }
        return false;
    }
}
