<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Country extends Model
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
        'name', 
        'body', 
        // 'user_id', 
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'entity_links'
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
            'countries.name' => 10,
            'countries.body' => 10,
        ],
    ];



    /**
     * RELATIONSHIPS
     */

    // public function user(){
    //     return $this->belongsTo(\App\Models\User::class, 'user_id');
    // }




    /**
     * Get Entity Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.countries.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.countries.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.countries.edit', [$this->attributes['id']]),
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
        return \Modules\Custom\Database\factories\CountryFactory::new();
    }
}
