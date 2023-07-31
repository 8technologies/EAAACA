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

class ContentService extends Model
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
        'introduction_text',
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
        'media_image',
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
            'content_services.title' => 10,
            'content_services.body' => 10,
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

    public function Layouts()
    {
        return $this->with(
            'layoutSections', 
            'layoutSections.layoutRows',
            'layoutSections.layoutRows.layoutColumns',
            'layoutSections.layoutRows.layoutColumns.fieldTitles',
            'layoutSections.layoutRows.layoutColumns.fieldTexts',
            'layoutSections.layoutRows.layoutColumns.fieldImages',
            'layoutSections.layoutRows.layoutColumns.fieldHtmls',
            'layoutSections.layoutRows.layoutColumns.fieldBlocks',
            'layoutSectionTops', 
            'layoutSectionTops.layoutRows',
            'layoutSectionTops.layoutRows.layoutColumns',
            'layoutSectionTops.layoutRows.layoutColumns.fieldTitles',
            'layoutSectionTops.layoutRows.layoutColumns.fieldTexts',
            'layoutSectionTops.layoutRows.layoutColumns.fieldImages',
            'layoutSectionTops.layoutRows.layoutColumns.fieldHtmls',
            'layoutSectionTops.layoutRows.layoutColumns.fieldBlocks',
        );
    }

    /**
     * Get all of the Page's Layouts.
     */
    public function layoutSections()
    {
        return $this->morphMany(\Modules\Layout\Entities\LayoutSection::class, 'fieldable')->orderBy('position', 'asc')->orderBy('created_at', 'asc');
    }
    public function layoutSectionTops()
    {
        return $this->morphMany(\Modules\Layout\Entities\LayoutSectionTop::class, 'fieldable')->orderBy('position', 'asc')->orderBy('created_at', 'asc');
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
        return 'Service' . $this->id;
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
            'url'  => route('service.show', [$urlParam]),
            'url_view'  => route('dashboard.services.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.services.edit', [$this->attributes['id']]),
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
        return \Modules\Content\Database\factories\ContentServiceFactory::new();
    }

}
