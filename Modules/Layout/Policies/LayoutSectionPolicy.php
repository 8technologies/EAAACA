<?php

namespace Modules\Layout\Policies;

use Modules\Layout\Entities\LayoutSection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayoutSectionPolicy
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
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return mixed
     */
    public function view(User $user, LayoutSection $layoutSection)
    {
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.view') || $user->id == $layoutSection->user_id) {
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
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return mixed
     */
    public function update(User $user, LayoutSection $layoutSection)
    {
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.update') || $user->id == $layoutSection->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return mixed
     */
    public function delete(User $user, LayoutSection $layoutSection)
    {
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.delete') || $user->id == $layoutSection->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return mixed
     */
    public function restore(User $user, LayoutSection $layoutSection)
    {
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.restore') || $user->id == $layoutSection->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Layout\Entities\LayoutSection  $layoutSection
     * @return mixed
     */
    public function forceDelete(User $user, LayoutSection $layoutSection)
    {
        if ($user->can('manage.layout') || $user->can('layout_section.*') || $user->can('layout_section.forcedelete') || $user->id == $layoutSection->user_id) {
            return true;
        }
        return false;
    }
}
