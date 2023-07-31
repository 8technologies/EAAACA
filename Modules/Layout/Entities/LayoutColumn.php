<?php

namespace Modules\Layout\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;
use Modules\Media\Traits\HasMediaField;

class LayoutColumn extends Model
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
        'layout_row_id', 
        'width', 
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

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * Get all of the models that own LayoutRows.
     */
    public function fieldable()
    {
        return $this->morphTo();
    }

    public function layoutRow(){
        return $this->belongsTo(\Modules\Layout\Entities\LayoutRow::class, 'layout_row_id');
    }

    /**
     * Get MediaVideos.
     */
    public function media_videos()
    {
        return $this->morphToMany(\Modules\Media\Entities\MediaVideo::class, 'media_videoable');
    }

    /**
     * Column Field relationships
     */
    public function fieldTitles()
    {
        return $this->morphMany(\Modules\Field\Entities\FieldTitle::class, 'fieldable');
    }
    public function fieldTexts()
    {
        return $this->morphMany(\Modules\Field\Entities\FieldText::class, 'fieldable');
    }
    public function fieldLinks()
    {
        return $this->morphMany(\Modules\Field\Entities\FieldLink::class, 'fieldable');
    }
    public function fieldImages()
    {
        return $this->morphMany(\Modules\Field\Entities\FieldImage::class, 'fieldable');
    }
    public function fieldHtmls()
    {
        return $this->morphMany(\Modules\Field\Entities\FieldHtml::class, 'fieldable');
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
        return 'column' . $this->id;
    }

    public function getModelNameAttribute($value)
    {
        return 'LayoutColumn';
    }

    /**
     * Get all fields relationship data
     *
     * @param  string  $value
     * @return string
     */
    public function getFieldsAttribute($value)
    {
        $fieldTitles = $this->fieldTitles;
        $fieldTexts = $this->fieldTexts;
        $fieldLinks = $this->fieldLinks;
        $fieldImages = $this->fieldImages;
        $fieldHtmls = $this->fieldHtmls;
        $fieldBlocks = $this->fieldBlocks;

        return $fieldTitles->concat($fieldTexts)->concat($fieldLinks)->concat($fieldImages)->concat($fieldHtmls)->concat($fieldBlocks)->sortBy('position')->values();
    }

    /**
     * Set JSON attributes.
     *
     * @var array
     */
    public function setStylesAttribute($value)
    {
        $styles = [];
        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $styles[] = $array_item;
            }
        }
        $this->attributes['styles'] = json_encode($styles);
    }

    public function setAttributesAttribute($value)
    {
        $attributes = [];
        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $attributes[] = $array_item;
            }
        }
        $this->attributes['attributes'] = json_encode($attributes);
    }

    public function setSettingsAttribute($value)
    {
        $settings = [];
        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $settings[] = $array_item;
            }
        }
        $this->attributes['settings'] = json_encode($settings);
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
            'url'  => route('dashboard.layout_columns.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.layout_columns.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.layout_columns.edit', [$this->attributes['id']]),
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
        return \Modules\Layout\Database\factories\LayoutColumnFactory::new();
    }
}
