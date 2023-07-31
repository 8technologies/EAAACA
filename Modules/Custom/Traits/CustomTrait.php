<?php

namespace Modules\Custom\Traits;

use Illuminate\Support\Str;
use EloquentFilter\Filterable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait CustomTrait
{
    use Filterable;


    /**
     * Get / Set date_created value.
     *
     * @var array
     */
    public function getDateCreatedAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setDateCreatedAttribute($value)
    {
        if ($value) {
            $this->attributes['date_created'] = Carbon::parse($value);
        } else {
            $this->attributes['date_created'] = now();
        }
    }




    /**
     * Get / Set approved_date value.
     *
     * @var array
     */
    public function getApprovedDateAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setApprovedDateAttribute($value)
    {
        if ($value) {
            $this->attributes['approved_date'] = Carbon::parse($value);
        } else {
            $this->attributes['approved_date'] = now();
        }
    }





    /**
     * Get / Set date_time_of_request value.
     *
     * @var array
     */
    public function getDateTimeOfRequestAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setDateTimeOfRequestAttribute($value)
    {
        if ($value) {
            $this->attributes['date_time_of_request'] = Carbon::parse($value);
        } else {
            $this->attributes['date_time_of_request'] = now();
        }
    }




    /**
     * Get / Set date_of_response value.
     *
     * @var array
     */
    public function getDateOfResponseAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setDateOfResponseAttribute($value)
    {
        if ($value) {
            $this->attributes['date_of_response'] = Carbon::parse($value);
        } else {
            $this->attributes['date_of_response'] = now();
        }
    }




    
    /**
     * Get / Set assigned_on value.
     *
     * @var array
     */
    public function getAssignedOnAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setAssignedOnAttribute($value)
    {
        if ($value) {
            $this->attributes['assigned_on'] = Carbon::parse($value);
        } else {
            $this->attributes['assigned_on'] = now();
        }
    }




    /**
     * Get / Set date_of_submission value.
     *
     * @var array
     */
    public function getDateOfSubmissionAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setDateOfSubmissionAttribute($value)
    {
        if ($value) {
            $this->attributes['date_of_submission'] = Carbon::parse($value);
        } else {
            $this->attributes['date_of_submission'] = now();
        }
    }



    /**
     * Update Related Entities.
     *
     * @var array
     */
    public function updateRelatedEntities($request)
    {
        $data = $request->all();
        
        if (method_exists($this, 'nature_of_offences') && isset($data['nature_of_offences'])) {
            $this->nature_of_offences()->sync($data['nature_of_offences']);
        }
        if (method_exists($this, 'information_restrictions') && isset($data['information_restrictions'])) {
            $this->information_restrictions()->sync($data['information_restrictions']);
        }
        
        
        if (method_exists($this, 'countries') && isset($data['countries'])) {
            $this->countries()->sync($data['countries']);
        }

        if (method_exists($this, 'key_issues') && isset($data['key_issues'])) {
            $this->key_issues()->sync($data['key_issues']);
        }

        if (method_exists($this, 'core_tools') && isset($data['core_tools'])) {
            $this->core_tools()->syncWithPivotValues($data['core_tools'], ['tool_type_id' => 1]);
        }

        if (method_exists($this, 'additional_tools') && isset($data['additional_tools'])) {
            $this->additional_tools()->syncWithoutDetaching($data['additional_tools']);
        }
        
        if ( method_exists($this, 'uploadOrAttachMedia') ) {
            $this->uploadOrAttachMedia($request);
        }
        
    }


    /**
     * Get / Set created_at value.
     *
     * @var array
     */
    public function getCreatedAtAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setCreatedAtAttribute($value)
    {
        if ($value) {
            $this->attributes['created_at'] = Carbon::parse($value);
        } else {
            $this->attributes['created_at'] = now();
        }
    }


    /**
     * Get / Set updated_at value.
     *
     * @var array
     */
    public function getUpdatedAtAttribute($value)
    {
        if ($value) {
            return date('m/d/Y g:i A', strtotime($value));
        }
        return ;
    }
    public function setUpdatedAtAttribute($value)
    {
        if ($value) {
            $this->attributes['updated_at'] = Carbon::parse($value);
        } else {
            $this->attributes['updated_at'] = now();
        }
    }


    
    public function setUserIdAttribute($value)
    {
        // dd( $value );
        if ($value == null) {
            $this->attributes['user_id'] = Auth::user()->id;
        } else {
            $this->attributes['user_id'] = $value;
        }
    }

}
