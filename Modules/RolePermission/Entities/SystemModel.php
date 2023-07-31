<?php

namespace Modules\RolePermission\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

class SystemModel extends Model
{
    use HasFactory;
    use SearchableTrait;
    use Filterable;

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    protected $table = 'models';

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'description' => 10,
            'name' => 10,
        ],
    ];






    /**
     * RELATIONSHIPS
     */

    /**
     * Reverse Relationships
     */

    public function model_permissions()
    {
        return $this->hasMany(\Modules\RolePermission\Entities\Permission::class, 'model_id');
    }







    
    /**
     * Get Model Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.models.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.models.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.models.edit', [$this->attributes['id']]),
        ];

        return $links;
    }

    /**
     * Get User Entity Permissions.
     *
     * @param  string  $value
     * @return array
     */
    public function getEntityPermissionsAttribute($value)
    {
        $permissions = array();

        $permissions['view'] = Auth::user()->can('view', $this) ? true : false;
        $permissions['edit'] = Auth::user()->can('update', $this) ? true : false;
        $permissions['delete'] = Auth::user()->can('delete', $this) ? true : false;

        return $permissions;
    }

    /**
     * Model Filter Class.
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\RolePermission\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\RolePermission\Database\factories\ModelFactory::new();
    }
}
