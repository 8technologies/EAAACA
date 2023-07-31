<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Media\Traits\MediaVideoFields;

class MediaVideo extends Model
{
    use HasFactory;
    use Filterable;
    use SearchableTrait;
    use MediaVideoFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
        'provider_id', 
        'provider_url', 
        'user_id', 
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
            'media_videos.name' => 10,
            'media_videos.description' => 10,
            'users.name' => 5,
            'users.email' => 5,
        ],
        'joins' => [
            'users' => ['media_videos.user_id','users.id'],
        ],
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'thumbnail', 
        'video_url', 
        'video_id'
    ];







    /**
     * RELATIONSHIPS
     */
    
    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function provider(){
        return $this->belongsTo(\Modules\Media\Entities\MediaProvider::class, 'provider_id');
    }

    /**
     * Get all LayoutSections.
     */
    public function layout_sections()
    {
        return $this->morphedByMany(\Modules\Layout\Entities\LayoutSection::class, 'media_videoable');
    }

    /**
     * Get all LayoutSectionTop.
     */
    public function layout_section_tops()
    {
        return $this->morphedByMany(\Modules\Layout\Entities\LayoutSectionTop::class, 'media_videoable');
    }







    /**
     * Get Model Links.
     *
     * @param  string  $value
     * @return string
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.videos.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.videos.edit', [$this->attributes['id']]),
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
        return \Modules\Media\Database\factories\MediaVideoFactory::new();
    }
}
