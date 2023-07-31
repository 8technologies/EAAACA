<?php

namespace Modules\Content\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\Content\Traits\ContentModel;
use Modules\Media\Traits\HasMediaField;
use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;

class ContentEvent extends Model
{
    use HasFactory;
    use ContentModel;
    use HasMediaField;
    
    use Filterable;
    use SearchableTrait;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'starting_date', 
        'ending_date', 
        'location',
        'body', 
        'user_id', 
        'slug', 
        'metatag_settings', 
        'settings', 
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];

    protected $casts = [
        'metatag_settings' => 'array',
        'settings' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name', 
        'uuid',
        'thumbnail', 
        'entity_links',
        'media_image',
        'media_attachments',
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
            'content_events.title' => 10,
            'content_events.body' => 10,
        ],
    ];



    /**
     * RELATIONSHIPS
     */

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    /**
     * Get all of the tags for the blog post.
     */
    public function tags()
    {
        return $this->morphToMany(\Modules\Taxonomy\Entities\TaxonomyTerm::class, 'taxonomy_termable');
    }
    



    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->title;
    }

    public function getUuidAttribute($value)
    {
        return 'Event' . $this->id;
    }

    /**
     * Get / Set starting_date value.
     *
     * @var array
     */
    public function getStartingDateAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setStartingDateAttribute($value)
    {
        if ($value) {
            $this->attributes['starting_date'] = Carbon::parse($value);
        }
    }

    /**
     * Get / Set ending_date value.
     *
     * @var array
     */
    public function getEndingDateAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setEndingDateAttribute($value)
    {
        if ($value) {
            $this->attributes['ending_date'] = Carbon::parse($value);
        }
    }


    /**
     * Get Model Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        if (isset($this->attributes['slug'])) {
            $urlParam = $this->attributes['slug'];
        } else {
            $urlParam = $this->attributes['id'];
        }

        $links = [
            'url'  => route('event.show', [$urlParam]),
            'url_view'  => route('dashboard.events.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.events.edit', [$this->attributes['id']]),
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
        return $this->provideFilter(\Modules\Content\ModelFilters\EntityFilter::class);
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
                'source' => 'title',
                'separator' => '-',
                'method' => function ($string, $separator) {
                    return strtolower(trim(preg_replace('/[^a-zA-Z0-9\/s]+/', $separator, $string), '-'));
                }
            ]
        ];
    }

    protected static function newFactory()
    {
        return \Modules\Content\Database\factories\ContentEventFactory::new();
    }
}
