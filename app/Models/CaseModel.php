<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    use HasFactory;



    //cases to array for select dropdown
    public static function casesToArray()
    {
        $cases = CaseModel::all();
        $casesArray = [];
        foreach ($cases as $case) {
            $casesArray[$case->id] = $case->title;
        }
        return $casesArray;
    }

    //has many CaseContributor
    public function contributors()
    {
        return $this->hasMany(CaseContributor::class);
    }
    //has many CaseModelAttachment
    public function attachments()
    {
        return $this->hasMany(CaseModelAttachments::class);
    }

    //has many CaseModelFinding
    public function findings()
    {
        return $this->hasMany(CaseModelFinding::class);
    }
}
