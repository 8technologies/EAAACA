<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\Content\Traits\ContentModel;
use Modules\Media\Traits\HasMediaField;
use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class CaseCoordinator extends Model
{
    use HasFactory;
    use ContentModel;
    use HasMediaField;
    
    use Filterable;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'case_id', 
        'contact_point_id', 
        'is_inactive', 
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
        'name',
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
            'case_coordinators.case_id' => 10,
        ],
    ];



    /**
     * RELATIONSHIPS
     */

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function case(){
        return $this->belongsTo(\Modules\Custom\Entities\CaseManagement::class, 'case_id');
    }
    public function contact_point(){
        return $this->belongsTo(
            \App\Models\User::class, 
            'contact_point_id',
            'id',
        );
    }



    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->contact_point->name;
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
            'url'  => route('dashboard.case-coordinators.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.case-coordinators.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.case-coordinators.edit', [$this->attributes['id']]),
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
        return \Modules\Custom\Database\factories\CaseCoordinatorFactory::new();
    }
}
