<?php 

namespace Modules\Taxonomy\ModelFilters;

use EloquentFilter\ModelFilter;

class EntityFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    /**
     * Name Column filters
     *
     */
    public function name($value)
    {
        return $this->where(function($q) use ($value)
        {
            return $q->where('name', 'LIKE', "%$value%")
                ->orWhere('name', 'LIKE', "%$value");
        });
    }

    /**
     * taxonomy_type column filters
     *
     */
    public function taxonomyType($value)
    {
        return $this->where('taxonomy_type_id', "$value");
    }

    /**
     * created_at column filters
     *
     */
    public function createdAt($value)
    {
        return $this->where('created_at', 'LIKE', "$value");
    }

    /**
     * updated_at column filters
     *
     */
    public function updatedAt($value)
    {
        return $this->where('updated_at', 'LIKE', "$value");
    }
}
