<?php

namespace Modules\Taxonomy\Observers;

use Modules\Taxonomy\Entities\TaxonomyType;

class TaxonomyTypeObserver
{
    /**
     * Handle the TaxonomyType "created" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return void
     */
    public function created(TaxonomyType $taxonomyType)
    {
        //
    }

    /**
     * Handle the TaxonomyType "updated" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return void
     */
    public function updated(TaxonomyType $taxonomyType)
    {
        //
    }

    /**
     * Handle the TaxonomyType "deleted" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return void
     */
    public function deleted(TaxonomyType $taxonomyType)
    {
        //
    }

    /**
     * Handle the TaxonomyType "restored" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return void
     */
    public function restored(TaxonomyType $taxonomyType)
    {
        //
    }

    /**
     * Handle the TaxonomyType "force deleted" event.
     *
     * @param  \Modules\Taxonomy\Entities\TaxonomyType  $taxonomyType
     * @return void
     */
    public function forceDeleted(TaxonomyType $taxonomyType)
    {
        //
    }
}
