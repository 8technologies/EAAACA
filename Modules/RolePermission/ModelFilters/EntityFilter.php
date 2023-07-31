<?php 

namespace Modules\RolePermission\ModelFilters;

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
     * role column filters
     *
     */
    public function role($value)
    {
        return $this->whereHas('roles', function($query) use ($value) {
            $query->where('role_id', '=', $value);
        });
    }

    /**
     * model_id column filters
     *
     */
    public function model($value)
    {
        return $this->where('model_id', 'LIKE', "$value");
    }

    /**
     * description column filters
     *
     */
    public function description($value)
    {
        return $this->where('description', 'LIKE', "$value");
    }

    /**
     * type column filters
     *
     */
    public function type($value)
    {
        return $this->where('type', 'LIKE', "$value");
    }


}
