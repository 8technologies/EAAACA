<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class MediaProvider extends Model
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
        'description', 
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
            'name' => 10,
            'description' => 10,
        ]
    ];

    /**
     * Get Model Links.
     *
     * @param  string  $value
     * @return string
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.media.providers.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.media.providers.edit', [$this->attributes['id']]),
        ];

        return $links;
    }

    /**
     * Get the Permissions.
     *
     * @param  string  $value
     * @return string
     */
    public function getEntityPermissionsAttribute($value)
    {
        $permissions = array();

        $permissions['view'] = Auth::user()->can('view', $this) ? true : false;
        $permissions['edit'] = Auth::user()->can('update', $this) ? true : false;
        $permissions['delete'] = Auth::user()->can('delete', $this) ? true : false;

        return $permissions;
    }

    public function modelFilter()
    {
        return $this->provideFilter(\Modules\Media\ModelFilters\EntityFilter::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\MediaProviderFactory::new();
    }
}
