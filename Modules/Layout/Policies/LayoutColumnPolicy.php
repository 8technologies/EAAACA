<?php

namespace Modules\Layout\Policies;

use Modules\Layout\Entities\LayoutColumn;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayoutColumnPolicy
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
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, LayoutColumn $layoutColumn)
    {
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.view') || $user->id == $layoutColumn->user_id) {
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
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, LayoutColumn $layoutColumn)
    {
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.update') || $user->id == $layoutColumn->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, LayoutColumn $layoutColumn)
    {
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.delete') || $user->id == $layoutColumn->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, LayoutColumn $layoutColumn)
    {
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.restore') || $user->id == $layoutColumn->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutColumn  $layoutColumn
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, LayoutColumn $layoutColumn)
    {
        if ($user->can('manage.layout') || $user->can('layout_column.*') || $user->can('layout_column.forcedelete') || $user->id == $layoutColumn->user_id) {
            return true;
        }
        return false;
    }
}
