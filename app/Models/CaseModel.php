<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    use HasFactory;


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
