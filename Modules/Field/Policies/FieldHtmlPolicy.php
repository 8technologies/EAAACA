<?php

namespace Modules\Field\Policies;

use Modules\Field\Entities\FieldHtml;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldHtmlPolicy
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
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FieldHtml $fieldHtml)
    {
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.view') || $user->id == $fieldHtml->user_id) {
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
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FieldHtml $fieldHtml)
    {
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.update') || $user->id == $fieldHtml->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FieldHtml $fieldHtml)
    {
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.delete') || $user->id == $fieldHtml->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FieldHtml $fieldHtml)
    {
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.restore') || $user->id == $fieldHtml->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Field\Entities\FieldHtml  $fieldHtml
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FieldHtml $fieldHtml)
    {
        if ($user->can('manage.field') || $user->can('field_html.*') || $user->can('field_html.forcedelete') || $user->id == $fieldHtml->user_id) {
            return true;
        }
        return false;
    }
}
