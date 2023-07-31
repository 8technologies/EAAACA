<?php 

namespace Modules\Notification\ModelFilters;

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
     * type column filters
     *
     */
    public function type($value)
    {
        return $this->where('type', 'LIKE', "$value");
    }

    /**
     * notifiable_type column filters
     *
     */
    public function notifiableType($value)
    {
        return $this->where('notifiable_type', '=', "$value");
    }

    /**
     * notifiable_id column filters
     *
     */
    public function notifiable($value)
    {
        return $this->where('notifiable_id', 'LIKE', "$value");
    }

    /**
     * data column filters
     *
     */
    public function data($value)
    {
        return $this->where('data', 'LIKE', "$value");
    }

    /**
     * read_at column filters
     *
     */
    public function readAt($value)
    {
        return $this->where('read_at', 'LIKE', "$value");
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
