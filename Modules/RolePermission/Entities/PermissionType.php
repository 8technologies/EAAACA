<?php

namespace Modules\RolePermission\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

class PermissionType extends Model
{
    use HasFactory;
    use SearchableTrait;
    use Filterable;

    protected $fillable = [
        'name',
        'description',
        'position',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

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

    // /**
    //  * Get the Name.
    //  *
    //  * @param  string  $value
    //  * @return string
    //  */
    // public function getNameAttribute($value)
    // {
    //     return $this->title;
    // }
    

    /**
     * Get Model Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.permissions.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.permissions.edit', [$this->attributes['id']]),
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
     * ModelFilters Class.
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\RolePermission\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\RolePermission\Database\factories\PermissionTypeFactory::new();
    }
}
