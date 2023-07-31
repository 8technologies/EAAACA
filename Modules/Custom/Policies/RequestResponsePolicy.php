<?php

namespace Modules\Custom\Policies;

use Modules\Custom\Entities\RequestResponse;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestResponsePolicy
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
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RequestResponse $requestResponse)
    {
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.view') || $user->id == $requestResponse->user_id) {
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
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RequestResponse $requestResponse)
    {
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.update') || $user->id == $requestResponse->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RequestResponse $requestResponse)
    {
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.delete') || $user->id == $requestResponse->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RequestResponse $requestResponse)
    {
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.restore') || $user->id == $requestResponse->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Custom\Entities\RequestResponse  $requestResponse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RequestResponse $requestResponse)
    {
        if ($user->can('manage.system') || $user->can('request_response.*') || $user->can('request_response.forcedelete') || $user->id == $requestResponse->user_id) {
            return true;
        }
        return false;
    }
}
