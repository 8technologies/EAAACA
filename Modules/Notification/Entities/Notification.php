<?php

namespace Modules\Notification\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

class Notification extends Model
{
    use HasFactory;
    use Filterable;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'type', 
        'notifiable_type', 
        'notifiable_id', 
        'category', 
        'data', 
        'read_at', 
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Allow usage on non integer id.
     *
     */
    public $incrementing = false;

    protected $appends = ['name'];

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
            'notifications.type' => 10,
            'notifications.notifiable_type' => 10,
            'notifications.category' => 10,
            'notifications.data' => 5,
        ],
    ];


    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->id;
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
            'url'  => route('dashboard.notifications.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.notifications.edit', [$this->attributes['id']]),
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
     * ModelFilter class.
     *
     * @var EloquentFilter\Filterable::class
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\Notification\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Notification\Database\factories\NotificationFactory::new();
    }
}
