<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TeamFilter extends ModelFilter
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
     * user_id column filters
     *
     */
    public function user($value)
    {
        return $this->where('user_id', 'LIKE', "$value%");
    }
}
