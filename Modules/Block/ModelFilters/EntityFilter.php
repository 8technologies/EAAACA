<?php 

namespace Modules\Custom\ModelFilters;

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

    // Filter 'user_id' OR 'user'
    public function user($id)
    {
        return $this->where('user_id', $id);
    }

}