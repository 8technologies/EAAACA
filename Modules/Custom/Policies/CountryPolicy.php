<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
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
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Country $country)
    {
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.view') ) {
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
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Country $country)
    {
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.update') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Country $country)
    {
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.delete') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Country $country)
    {
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.restore') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\Country  $country
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Country $country)
    {
        if ($user->can('manage.system') || $user->can('country.*') || $user->can('country.forcedelete') ) {
            return true;
        }
        return false;
    }
}
