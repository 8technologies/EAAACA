<?php

namespace Modules\Taxonomy\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Taxonomy\Entities\TaxonomyType;
use App\Models\User;

class TaxonomyTypePolicy
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
        if ($user->can('permission.*') || $user->can('permission.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TaxonomyType $taxonomyType)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_type.*') || $user->can('taxonomy_type.view')  || $user->id == $taxonomyType->user_id) {
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
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_type.*') || $user->can('taxonomy_type.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TaxonomyType $taxonomyType)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_type.*') || $user->can('taxonomy_type.update') || $user->id == $taxonomyType->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TaxonomyType $taxonomyType)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_type.*') || $user->can('taxonomy_type.delete') || $user->id == $taxonomyType->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TaxonomyType $taxonomyType)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_type.*') || $user->can('taxonomy_type.restore') || $user->id == $taxonomyType->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TaxonomyType $taxonomyType)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_type.*') || $user->can('taxonomy_type.forcedelete') || $user->id == $taxonomyType->user_id) {
            return true;
        }
        return false;
    }
}
