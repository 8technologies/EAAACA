<?php

namespace Modules\Layout\Policies;

use Modules\Layout\Entities\LayoutRow;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayoutRowPolicy
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
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, LayoutRow $layoutRow)
    {
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.view') || $user->id == $layoutRow->user_id) {
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
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, LayoutRow $layoutRow)
    {
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.update') || $user->id == $layoutRow->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, LayoutRow $layoutRow)
    {
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.delete') || $user->id == $layoutRow->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, LayoutRow $layoutRow)
    {
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.restore') || $user->id == $layoutRow->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutRow  $layoutRow
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, LayoutRow $layoutRow)
    {
        if ($user->can('manage.layout') || $user->can('layout_row.*') || $user->can('layout_row.forcedelete') || $user->id == $layoutRow->user_id) {
            return true;
        }
        return false;
    }
}
