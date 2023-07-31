<?php

namespace Modules\Content\Traits;

use Illuminate\Support\Str;
use EloquentFilter\Filterable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait ContentModel
{
    use Filterable;

    /**
     * Update Related Entities.
     *
     * @var array
     */
    public function updateRelatedEntities($request)
    {
        $data = $request->all();
        
        if (method_exists($this, 'tags') && isset($data['tags'])) {
            syncTags($this, $data['tags']);
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
