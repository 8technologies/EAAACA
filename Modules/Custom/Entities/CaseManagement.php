<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\Custom\Traits\CustomTrait;
use Modules\Media\Traits\HasMediaField;
use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class CaseManagement extends Model
{
    use HasFactory;
    use CustomTrait;
    use HasMediaField;
    
    use Filterable;
    use SearchableTrait;

    protected   $table = 'cases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_number',
        'description', 
        'date_created',
        'organization_id',
        'approved', 
        'approved_date', 
        'approved_by_id', 
        'status_id', 
        'user_id', 
        'deleted_at', 
        'created_at', 
        'updated_at',
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
            'cases.reference_number' => 10,
            'cases.approved_date' => 10,
            'cases.description' => 10,
        ],
    ];




    /**
     * RELATIONSHIPS
     */

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function organization(){
        return $this->belongsTo(\Modules\Custom\Entities\Organization::class, 'organization_id');
    }

    public function information_requests()
    {
        return $this->hasMany(
            \Modules\Custom\Entities\InformationRequest::class,
            'case_id', 
            'id',
        );
    }
    public function case_contributors()
    {
        return $this->hasMany(
            \Modules\Custom\Entities\CaseContributor::class,
            'case_id', 
            'id',
        );
    }
    public function case_coordinators()
    {
        return $this->hasMany(
            \Modules\Custom\Entities\CaseCoordinator::class,
            'case_id', 
            'id',
        );
    }

    public function case_investigations()
    {
        return $this->hasMany(
            \Modules\Custom\Entities\CaseInvestigation::class,
            'case_id', 
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
        return $this->reference_number;
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
            'url'  => route('dashboard.cases.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.cases.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.cases.edit', [$this->attributes['id']]),
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
        return \Modules\Custom\Database\factories\CaseManagementFactory::new();
    }
}
