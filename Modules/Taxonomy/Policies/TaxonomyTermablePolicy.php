<?php

namespace Modules\Taxonomy\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Taxonomy\Entities\TaxonomyTermable;
use App\Models\User;

class TaxonomyTermablePolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTermable  $taxonomyTermable
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TaxonomyTermable $taxonomyTermable)
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
     * @param  \Modules\Taxonomy\Entities\TaxonomyTermable  $taxonomyTermable
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TaxonomyTermable $taxonomyTermable)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTermable  $taxonomyTermable
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TaxonomyTermable $taxonomyTermable)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTermable  $taxonomyTermable
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TaxonomyTermable $taxonomyTermable)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Taxonomy\Entities\TaxonomyTermable  $taxonomyTermable
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TaxonomyTermable $taxonomyTermable)
    {
        //
    }
}
