<?php

namespace Modules\System\Policies;

use Modules\System\Entities\SystemModel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemModelPolicy
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
        if ($user->can('manage.system')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\System\Entities\SystemModel  $systemModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SystemModel $systemModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\System\Entities\SystemModel  $systemModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SystemModel $systemModel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\System\Entities\SystemModel  $systemModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SystemModel $systemModel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\System\Entities\SystemModel  $systemModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SystemModel $systemModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\System\Entities\SystemModel  $systemModel
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SystemModel $systemModel)
    {
        //
    }
}
