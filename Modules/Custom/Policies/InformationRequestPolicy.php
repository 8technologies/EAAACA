<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\InformationRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InformationRequestPolicy
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
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRequest  $informationRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InformationRequest $informationRequest)
    {
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.view') || $user->id == $informationRequest->user_id) {
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
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRequest  $informationRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InformationRequest $informationRequest)
    {
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.update') || $user->id == $informationRequest->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRequest  $informationRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InformationRequest $informationRequest)
    {
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.delete') || $user->id == $informationRequest->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRequest  $informationRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InformationRequest $informationRequest)
    {
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.restore') || $user->id == $informationRequest->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\InformationRequest  $informationRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InformationRequest $informationRequest)
    {
        if ($user->can('manage.system') || $user->can('information_request.*') || $user->can('information_request.forcedelete') || $user->id == $informationRequest->user_id) {
            return true;
        }
        return false;
    }
}
