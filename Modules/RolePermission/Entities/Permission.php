<?php

namespace Modules\RolePermission\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;
    use SearchableTrait;
    use Filterable;

    protected $fillable = [
        'name', 
        'guard_name', 
        'description', 
        'model_id', 
        'created_at', 
        'updated_at'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * @var array
         */
        'columns' => [
            'permissions.name' => 10,
            'permissions.guard_name' => 10,
            'permissions.description' => 7,
            'models.name' => 5,
            // 'models.description' => 5,
        ],
        'joins' => [
            'models' => ['permissions.model_id','models.id'],
        ],
    ];






    /**
     * RELATIONSHIPS
     */

    /**
     * Permission can belong to a System Model.
     */
    public function model(){
        return $this->belongsTo(\Modules\RolePermission\Entities\SystemModel::class, 'model_id');
    }





    
    /**
     * ModelFilter class.
     *
     * @var EloquentFilter\Filterable::class
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\RolePermission\ModelFilters\EntityFilter::class);
    }

}
