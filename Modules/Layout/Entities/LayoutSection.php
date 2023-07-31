<?php

namespace Modules\Layout\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;
use Modules\Media\Traits\HasMediaField;

class LayoutSection extends Model
{
    use HasFactory;
    use HasMediaField;
    use SearchableTrait;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position', 
        'styles', 
        'attributes', 
        'css_classes', 
        'css_styles', 
        'settings', 
        'user_id', 
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];

    protected $casts = [
        'styles' => 'array',
        'attributes' => 'array',
        'settings' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name', 
        'fields',
        'model_name',
        'bg_thumbnail', 
        'bg_image',
        'entity_links',
    ];







    /**
     * RELATIONSHIPS
     */

    /**
     * Get Author.
     */
	public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    /**
     * Get all of the models that own LayoutRows.
     */
    public function fieldable()
    {
        return $this->morphTo();
    }

    /**
     * Get LayoutRows.
     */
    public function layoutRows()
    {
        return $this->morphMany(\Modules\Layout\Entities\layoutRow::class, 'fieldable')->orderBy('position', 'asc')->orderBy('created_at', 'asc');
    }

    /**
     * Get MediaVideos.
     */
    public function media_videos()
    {
        return $this->morphToMany(\Modules\Media\Entities\MediaVideo::class, 'media_videoable');
    }

    /**
     * Get all of the pages that are assigned this section.
     */
    public function page()
    {
        return $this->morphedByMany(\Modules\Content\Entities\Page::class, 'fieldable');
    }
    public function fieldBlocks()
    {
        return $this->morphMany(\Modules\Field\Entities\FieldBlock::class, 'fieldable')->with('block');
    }









    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return 'section' . $this->id;
    }

    public function getModelNameAttribute($value)
    {
        return 'LayoutSection';
    }
    
    /**
     * Get all attached columns
     *
     * @param  string  $value
     * @return string
     */
    public function getRowsAttribute($value)
    {
        return $this->layoutRows->sortBy('position')->values();
    }

    /**
     * Set JSON attributes.
     *
     * @var array
     */
    public function setStylesAttribute($value)
    {
        if ($value == null) { return; }

        $styles = [];
        foreach ($value as $item) {
            if (!is_null($item['key']) && !is_null($item['value']) && $item['value'] != 'null') {
                $styles[] = $item;
            }
        }
        $this->attributes['styles'] = count($styles) ? json_encode($styles) : null;
    }

    public function setAttributesAttribute($value)
    {
        if ($value == null) { return; }

        $attributes = [];
        foreach ($value as $item) {
            if (!is_null($item['key']) && !is_null($item['value']) && $item['value'] != 'null') {
                $attributes[] = $item;
            }
        }
        $this->attributes['attributes'] = count($attributes) ? json_encode($attributes) : null;
    }

    public function setSettingsAttribute($value)
    {
        if ($value == null) { return; }

        $settings = [];
        foreach ($value as $item) {
            if (!is_null($item['key']) && !is_null($item['value']) && $item['value'] != 'null') {
                $settings[] = $item;
            }
        }
        $this->attributes['settings'] = count($settings) ? json_encode($settings) : null;
    }

    /**
     * Get all fields relationship data
     *
     * @param  string  $value
     * @return string
     */
    public function getFieldsAttribute($value)
    {
        $layoutRows = $this->layoutRows;
        $fieldBlocks = $this->fieldBlocks;

        return $layoutRows->concat($fieldBlocks)->sortBy('position')->values();
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
            'url'  => route('dashboard.layout_sections.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.layout_sections.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.layout_sections.edit', [$this->attributes['id']]),
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
     * Model Filter Class.
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\Layout\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Layout\Database\factories\LayoutSectionFactory::new();
    }
}
