<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
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
     * Email Column filters
     *
     */
    public function role($value)
    {
        return $this->whereHas('roles', function($query) use ($value) {
            $query->where('model_type', '=', 'App\Models\User')
                ->where('role_id', 'LIKE', $value);
        });
    }

    /**
     * Email Column filters
     *
     */
    public function email($value)
    {
        return $this->where('email', 'LIKE', "$value%");
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
