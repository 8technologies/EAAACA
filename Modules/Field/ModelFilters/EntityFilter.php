<?php 

namespace Modules\Field\ModelFilters;

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
     * user_id column filters
     *
     */
    public function user($value)
    {
        return $this->where('user_id', 'LIKE', "$value");
    }
}
