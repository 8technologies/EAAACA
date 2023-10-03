<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationRequest extends Model
{
    use HasFactory;

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
}
