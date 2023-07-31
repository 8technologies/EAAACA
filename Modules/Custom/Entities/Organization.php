<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\Content\Traits\ContentModel;
use Modules\Media\Traits\HasMediaField;
use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Organization extends Model
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
        'name', 
        'description', 
        'member_state_id', 
        'address',
        'telephone',
        'fax',
        'email',
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
            'organizations.name' => 10,
            'organizations.description' => 10,
        ],
    ];



    /**
     * RELATIONSHIPS
     */

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function member_state(){
        return $this->belongsTo(\Modules\Custom\Entities\MemberState::class, 'member_state_id');
    }
    public function cases()
    {
        return $this->hasMany(\Modules\Custom\Entities\CaseManagement::class);
    }
    public function information_requests()
    {
        return $this->hasMany(\Modules\Custom\Entities\InformationRequest::class);
    }

    public function contact_points()
    {
        return $this->hasMany(
            \App\Models\User::class,
            'organization_id', 
            'id',
        );
    }
    // public function contact_points()
    // {
    //     return $this->hasMany(\Modules\Custom\Entities\ContactPoint::class);
    // }



    // /**
    //  * Get the Name.
    //  *
    //  * @param  string  $value
    //  * @return string
    //  */
    // public function getNameAttribute($value)
    // {
    //     return $this->title;
    // }



    /**
     * Get Entity Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.organizations.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.organizations.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.organizations.edit', [$this->attributes['id']]),
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
        return \Modules\Custom\Database\factories\OrganizationFactory::new();
    }
}
