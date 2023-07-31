<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;
use Illuminate\Support\Facades\Request;

class Status extends Model
{
    use HasFactory;
    use SearchableTrait;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'status_category',
        'body',
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'deleted_at',
        // 'created_at',
        // 'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'entity_links',
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
            'statuses.name' => 10,
            'statuses.status_category' => 10,
            'statuses.body' => 10,
        ]
    ];




    /**
     * RELATIONSHIPS
     */
    
    // public function user(){
    //     return $this->belongsTo(\App\Models\User::class, 'user_id');
    // }




    /**
     * Get the ModelName.
     *
     * @param  string  $value
     * @return string
     */
    public function getModelNameAttribute($value)
    {
        return 'Status';
    }
    public function getUuidAttribute($value)
    {
        return 'Status' . $this->id;
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
            'url'  => route('dashboard.statuses.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.statuses.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.statuses.edit', [$this->attributes['id']]),
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
        return $this->provideFilter(\Modules\Custom\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Custom\Database\factories\StatusFactory::new();
    }
}
