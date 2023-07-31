<?php

namespace Modules\Media\ModelFilters;

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
        return $this->where('name', 'LIKE', "$value%");
    }

    public function fileName($value)
    {
        return $this->where('file_name', 'LIKE', "$value%");
    }

    public function disk($value)
    {
        return $this->where('disk', 'LIKE', "$value%");
    }

    public function mimeType($value)
    {
        return $this->where('mime_type', 'LIKE', "$value%");
    }

    public function size($value)
    {
        return $this->where('size', 'LIKE', "$value%");
    }

    public function fileDescription($value)
    {
        return $this->where('file_description', 'LIKE', "$value%");
    }

    public function uploadFolder($value)
    {
        return $this->where('upload_folder', 'LIKE', "$value%");
    }

    public function user($value)
    {
        return $this->where('user_id', 'LIKE', "$value%");
    }
}
