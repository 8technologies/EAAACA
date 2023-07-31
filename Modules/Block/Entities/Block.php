<?php

namespace Modules\Block\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;
use Illuminate\Support\Facades\Request;

class Block extends Model
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
        'body', 
        'component_name',
        'controller_name', 
        'controller_method', 
        'show_on_pages',
        'display_style', 
        'user_id', 
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
        // 'controller_name',
        // 'controller_method',
        // 'show_on_pages',
        // 'user_id',
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
        'uuid',
        'model_name', 
        'entity_links',
        'block_data',
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
            'blocks.name' => 10,
            'blocks.component_name' => 10,
            'blocks.body' => 7,
            'blocks.controller_name' => 5,
            'blocks.controller_method' => 5,
            'blocks.show_on_pages' => 5,
        ]
    ];





    /**
     * RELATIONSHIPS
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
     * append the Block's dynamic.
     *
     * @param  string  $value
     * @return string
     */
    public function getBlockDataAttribute()
    {
        if ($this->controller_name && $this->controller_method) {
            $controller = new $this->controller_name;

            if (method_exists($controller, $this->controller_method)) {
                $func = $this->controller_method;
                $data = $controller->{$func}();
    
                return $data;
            }
            return null;
        }
        return null;
    }



    /**
     * Get the ModelName.
     *
     * @param  string  $value
     * @return string
     */
    public function getModelNameAttribute($value)
    {
        return 'Block';
    }
    public function getUuidAttribute($value)
    {
        return 'Block' . $this->id;
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
            'url'  => route('dashboard.blocks.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.blocks.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.blocks.edit', [$this->attributes['id']]),
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
        return $this->provideFilter(\Modules\Block\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Block\Database\factories\BlockFactory::new();
    }
}
