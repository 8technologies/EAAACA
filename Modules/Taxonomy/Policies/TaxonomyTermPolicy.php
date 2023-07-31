<?php

namespace Modules\Taxonomy\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Taxonomy\Entities\TaxonomyTerm;
use App\Models\User;

class TaxonomyTermPolicy
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
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.index')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TaxonomyTerm $taxonomyTerm)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.view')  || $user->id == $taxonomyTerm->user_id) {
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
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.create')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TaxonomyTerm $taxonomyTerm)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.update') || $user->id == $taxonomyTerm->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TaxonomyTerm $taxonomyTerm)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.delete') || $user->id == $taxonomyTerm->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TaxonomyTerm $taxonomyTerm)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.restore') || $user->id == $taxonomyTerm->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TaxonomyTerm $taxonomyTerm)
    {
        if ($user->can('manage.taxonomy') || $user->can('taxonomy_term.*') || $user->can('taxonomy_term.forcedelete') || $user->id == $taxonomyTerm->user_id) {
            return true;
        }
        return false;
    }
}
