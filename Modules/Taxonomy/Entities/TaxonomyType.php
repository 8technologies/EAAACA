<?php

namespace Modules\Taxonomy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class TaxonomyType extends Model
{
    use HasFactory;
    
    use Filterable;
    use SearchableTrait;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
        'slug', 
        'user_id', 
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
            'taxonomy_types.name' => 10,
            'taxonomy_types.description' => 10,
        ],
    ];







    /**
     * RELATIONSHIPS
     */

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    /**
     * Get the terms assigned to the Type.
     */
    public function taxonomy_terms()
    {
        return $this->hasMany(\Modules\Taxonomy\Entities\TaxonomyTerm::class, 'taxonomy_type_id');
    }






    /**
     * Get Entity Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.taxonomy_types.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.taxonomy_types.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.taxonomy_types.edit', [$this->attributes['id']]),
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
        return $this->provideFilter(\Modules\Taxonomy\ModelFilters\EntityFilter::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '-',
                'method' => function ($string, $separator) {
                    return strtolower(trim(preg_replace('/[^a-zA-Z0-9\/s]+/', $separator, $string), '-'));
                }
            ]
        ];
    }

    protected static function newFactory()
    {
        return \Modules\Taxonomy\Database\factories\TaxonomyTypeFactory::new();
    }
}
