<?php 

namespace Modules\Layout\ModelFilters;

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
    public function user($value)
    {
        return $this->where(function($q) use ($value)
        {
            return $q->where('user_id', 'LIKE', "%$value%")
                ->orWhere('user_id', 'LIKE', "%$value");
        });
    }

}
