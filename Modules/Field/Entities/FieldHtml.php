<?php

namespace Modules\Field\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;

class FieldHtml extends Model
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
        'body', 
        'user_id', 
        'position', 
        'attributes', 
        'styles', 
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];

    protected $casts = [
        'attributes' => 'array',
        'styles' => 'array',
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name', 
        'model_name',
        'entity_links',
        'uuid',
    ];
    





    /**
     * RELATIONSHIPS
     */

	/**
     * Get all of the models that own LayoutRows.
     */
    public function fieldable()
    {
        return $this->morphTo();
    }







    
    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return Str::limit(strip_tags($this->body), 40);
    }
    public function getModelNameAttribute($value)
    {
        return 'FieldHtml';
    }
    public function getUuidAttribute($value)
    {
        return $this->id . '-FieldHtml';
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
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
    
    /**
     * Get Model Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.field_htmls.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.field_htmls.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.field_htmls.edit', [$this->attributes['id']]),
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
        return $this->provideFilter(\Modules\Field\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Field\Database\factories\FieldHtmlFactory::new();
    }
}
