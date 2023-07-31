<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\Custom\Traits\CustomTrait;
use Modules\Media\Traits\HasMediaField;
use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class RequestResponse extends Model
{
    use HasFactory;
    use CustomTrait;
    use HasMediaField;
    
    use Filterable;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'information_request_id',
        'response',
        'date_of_response',

        'feedback_on', 
        'feedback_by_id', 
        'feedback_notes', 
        'feedback_status_id',

        // 'is_approved', 
        // 'is_approved_on',
        // 'is_approved_by_id',

        // 'response_accepted', 
        // 'response_accepted_on',
        // 'response_accepted_by_id', 

        'user_id', 
        'deleted_at', 
        'created_at', 
        'updated_at' 
    ];

    // protected $casts = [
    //     'settings' => 'array',
    // ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name', 
        'entity_links',
        // 'media_attachments',
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
            'request_responses.response' => 10,
            'request_responses.date_of_response' => 10,
            'request_responses.is_approved_on' => 10,
            'request_responses.response_accepted_on' => 10,
        ],
    ];





    /**
     * RELATIONSHIPS
     */

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function information_request(){
        return $this->belongsTo(\Modules\Custom\Entities\InformationRequest::class, 'information_request_id');
    }
    public function feedback_by(){
        return $this->belongsTo(\App\Models\User::class, 'feedback_by_id');
    }
    public function feedback_status(){
        return $this->belongsTo(\Modules\Custom\Entities\Status::class, 'feedback_status_id');
    }



    


    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return 'Response#' . $this->id;
    }

    public function getUuidAttribute($value)
    {
        return 'RequestResponse' . $this->id;
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
            'url'  => route('dashboard.request-responses.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.request-responses.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.request-responses.edit', [$this->attributes['id']]),
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
        return $this->provideFilter(\Modules\Custom\ModelFilters\RequestResponseFilter::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Custom\Database\factories\RequestResponseFactory::new();
    }
}
