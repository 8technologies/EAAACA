<?php

namespace Modules\Taxonomy\Observers;

use Modules\Taxonomy\Entities\TaxonomyTerm;

class TaxonomyTermObserver
{
    /**
     * Handle the TaxonomyTerm "created" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return void
     */
    public function created(TaxonomyTerm $taxonomyTerm)
    {
        //
    }

    /**
     * Handle the TaxonomyTerm "updated" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return void
     */
    public function updated(TaxonomyTerm $taxonomyTerm)
    {
        //
    }

    /**
     * Handle the TaxonomyTerm "deleted" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return void
     */
    public function deleted(TaxonomyTerm $taxonomyTerm)
    {
        //
    }

    /**
     * Handle the TaxonomyTerm "restored" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return void
     */
    public function restored(TaxonomyTerm $taxonomyTerm)
    {
        //
    }

    /**
     * Handle the TaxonomyTerm "force deleted" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyTerm  $taxonomyTerm
     * @return void
     */
    public function forceDeleted(TaxonomyTerm $taxonomyTerm)
    {
        //
    }
}
