<?php

namespace Modules\Custom\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Modules\Custom\Traits\CustomTrait;
use Modules\Media\Traits\HasMediaField;
use EloquentFilter\Filterable;
use Illuminate\Support\Facades\DB;
use Nicolaslopezj\Searchable\SearchableTrait;

class InformationRequest extends Model
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
        'organization_id',
        'member_state_id',
        'date_time_of_request',
        'request_reference_no',
        'case_id',
        // 'previous_requests', // one-to-many relationship
        'type_of_crimes_investigated', // textarea
        'description_of_circumstances', // textarea
        // 'nature_of_offences', // one-to-many relationship
        'purpose_for_information_request', 
        'connection_btw_information_request', 
        'identity_of_the_persons', 
        'reasons_tobe_in_member_state', 
        // 'information_restrictions', // one-to-many relationship
        'review_on', 
        'review_by_id', 
        'review_notes', 
        'review_status_id',
        // 'status_id', 
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
        // 'uuid',
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
            'information_requests.full_name' => 10,
            'information_requests.description' => 10,
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
    public function member_state(){
        return $this->belongsTo(\Modules\Custom\Entities\MemberState::class, 'member_state_id');
    }
    public function case(){
        return $this->belongsTo(\Modules\Custom\Entities\CaseManagement::class, 'case_id');
    }
    public function review_by(){
        return $this->belongsTo(\App\Models\User::class, 'is_approved_by_id');
    }
    public function review_status(){
        return $this->belongsTo(\Modules\Custom\Entities\Status::class, 'review_status_id');
    }
    public function status(){
        return $this->belongsTo(\Modules\Custom\Entities\Status::class, 'status_id');
    }



    
    public function previous_requests()
    {
        return $this->morphToMany(\Modules\Custom\Entities\InformationRequest::class, 'informationrequestable');
    }
    public function request_responses()
    {
        return $this->hasMany(
            \Modules\Custom\Entities\RequestResponse::class, 
            'information_request_id',
            'id',
        );
    }
    public function nature_of_offences()
    {
        return $this->belongsToMany(
            \Modules\Custom\Entities\NatureOfOffence::class,
            'informationrequest_natureofoffence',
            'information_request_id', 
            'nature_of_offence_id',
        );
    }
    public function information_restrictions()
    {
        return $this->belongsToMany(
            \Modules\Custom\Entities\InformationRestriction::class,
            'informationrequest_informationrestriction',
            'information_request_id', 
            'information_restriction_id',
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
        return $this->request_reference_no;
    }

    public function getUuidAttribute($value)
    {
        return 'InformationRequest' . $this->id;
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
            'url'  => route('dashboard.information-requests.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.information-requests.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.information-requests.edit', [$this->attributes['id']]),
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






    // 
    public function scopeWithEntityStatus($query) 
    {
        $query->addSelect(['entity_status' => RequestResponse::select(
            DB::raw('(CASE 
                WHEN information_requests.review_status_id IS NULL THEN "NEW" 
                WHEN information_requests.review_status_id = 2 THEN "PENDING" 

                WHEN information_requests.review_status_id = 1 AND COUNT(DISTINCT(request_responses.id)) = 0 THEN "AWAITING RESPONSE" 
                WHEN information_requests.review_status_id = 1 AND COUNT(DISTINCT(request_responses.id)) > 0 AND request_responses.feedback_status_id IS NULL THEN "AWAITING FEEDBACK" 

                WHEN information_requests.review_status_id = 1 AND COUNT(DISTINCT(request_responses.id)) > 0 AND SUM(if(request_responses.feedback_status_id = 4, 1, 0)) THEN "COMPLETED" 
                WHEN information_requests.review_status_id = 1 AND COUNT(DISTINCT(request_responses.id)) > 0 AND SUM(if(request_responses.feedback_status_id = 5, 1, 0)) THEN "MORE INFORMATION NEEDED" 

                ELSE "UNKNOWN STATUS" END) 
                AS entity_status')
            )
            ->rightJoin('information_requests as xxxx', 'request_responses.information_request_id', '=', 'xxxx.id')
            ->whereColumn('information_requests.id', 'xxxx.id')
            ->groupBy('information_requests.id')
            ->take(1)
        ]);
    }

    public function scopeWithEntityStatusCount($query) 
    {
        $query->addSelect(['entity_status_count' => RequestResponse::select(
            DB::raw('
                COUNT(DISTINCT(information_requests.id))
                AS entity_status_count')
            )
            ->rightJoin('information_requests as xxxx', 'request_responses.information_request_id', '=', 'xxxx.id')
            
            // ->groupBy('resolution.id')
            // ->take(1)
        ]);
    }






    /**
     * ModelFilters Class.
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\Custom\ModelFilters\InformationRequestFilter::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Custom\Database\factories\InformationRequestFactory::new();
    }
}
