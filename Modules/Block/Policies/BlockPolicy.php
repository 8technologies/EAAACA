<?php

namespace Modules\Block\Policies;

use \Modules\Block\Entities\Block;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockPolicy
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
        if ($user->can('manage.block')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \\Modules\Block\Entities\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Block $block)
    {
        if ($user->can('manage.block')) {
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
        if ($user->can('manage.block')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \\Modules\Block\Entities\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Block $block)
    {
        if ($user->can('manage.block')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \\Modules\Block\Entities\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Block $block)
    {
        if ($user->can('manage.block')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \\Modules\Block\Entities\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Block $block)
    {
        if ($user->can('manage.block')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \\Modules\Block\Entities\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Block $block)
    {
        if ($user->can('manage.block')) {
            return true;
        }
        return false;
    }
}
