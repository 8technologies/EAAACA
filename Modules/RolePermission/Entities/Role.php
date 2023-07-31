<?php

namespace Modules\RolePermission\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    use SearchableTrait;
    use Filterable;

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
            'roles.name' => 10,
            'roles.guard_name' => 10,
        ]
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
            'url'  => route('dashboard.roles.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.roles.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.roles.edit', [$this->attributes['id']]),
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
