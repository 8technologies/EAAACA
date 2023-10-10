<?php

namespace App\Models;

use Carbon\Carbon;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationRequest extends Model
{
    use HasFactory;

    //toSelectArray
    public static function toSelectArray()
    {
        $data = [];
        $information_requests = self::where([])->orderBy('id', 'desc')->get();
        foreach ($information_requests as $information_request) {
            $data[$information_request->id] = "Request #" . $information_request->id;
        }
        return $data;
    }

    //boot
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($m) {
            $m->status = 'Pending';
            return self::prepare($m);
        });
        static::updating(function ($m) {
            return self::prepare($m);
        });
    }


    //organization
    public function organization()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    //sender
    public function sender()
    {
        return $this->belongsTo(Administrator::class, 'sender_id');
    }

    //receiver 
    public function receiver()
    {
        return $this->belongsTo(Administrator::class, 'receiver_id');
    }

    public static function prepare($m)
    {
        $u = Administrator::find($m->sender_id);
        if ($u == null) {
            throw new \Exception("Sender not found");
        }
        $m->sender_country_id = $u->country_id;
        $m->organization_id = $u->company_id;
        $m->member_state_id = $u->country_id;
        $m->date_time_of_request = Carbon::now();

        return $m;
    }

    //change to snake case type_of_crimes_investigated
    public function getTypeOfCrimesInvestigatedAttribute($value)
    {
        return explode(',', $value);
    }
    //make setter for type_of_crimes_investigated
    public function setTypeOfCrimesInvestigatedAttribute($value)
    {
        $this->attributes['type_of_crimes_investigated'] = implode(',', $value);
    }

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    //administrator
    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'administrator_id');
    }
    public function review_by()
    {
        return $this->belongsTo(Administrator::class, 'review_by_id');
    }

    //has manay InformationRequestReponse
    public function information_request_reponses()
    {
        return $this->hasMany(InformationRequestReponse::class, 'information_request_id');
    }
}
