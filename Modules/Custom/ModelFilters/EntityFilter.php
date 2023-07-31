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

    // Filter 'case_id' OR 'case'
    public function case($id)
    {
        return $this->where('case_id', $id);
    }
    public function case_id($id)
    {
        return $this->where('case_id', $id);
    }

    public function organization($id)
    {
        return $this->where('organization_id', $id);
    }
    public function organization_id($id)
    {
        return $this->where('organization_id', $id);
    }

}