<?php

namespace Modules\Layout\Policies;

use Modules\Layout\Entities\LayoutSectionTop;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayoutSectionTopPolicy
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
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSectionTop  $layoutSectionTop
     * @return mixed
     */
    public function view(User $user, LayoutSectionTop $layoutSectionTop)
    {
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.view') || $user->id == $layoutSectionTop->user_id) {
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
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSectionTop  $layoutSectionTop
     * @return mixed
     */
    public function update(User $user, LayoutSectionTop $layoutSectionTop)
    {
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.update') || $user->id == $layoutSectionTop->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSectionTop  $layoutSectionTop
     * @return mixed
     */
    public function delete(User $user, LayoutSectionTop $layoutSectionTop)
    {
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.delete') || $user->id == $layoutSectionTop->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSectionTop  $layoutSectionTop
     * @return mixed
     */
    public function restore(User $user, LayoutSectionTop $layoutSectionTop)
    {
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.restore') || $user->id == $layoutSectionTop->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSectionTop  $layoutSectionTop
     * @return mixed
     */
    public function forceDelete(User $user, LayoutSectionTop $layoutSectionTop)
    {
        if ($user->can('manage.layout') || $user->can('layout_section_top.*') || $user->can('layout_section_top.forcedelete') || $user->id == $layoutSectionTop->user_id) {
            return true;
        }
        return false;
    }
}
