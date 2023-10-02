<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    //boot function
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($country) {
            //stop deleting if country id == 1
            if ($country->id == 1) {
                return false;
            }
            //set all case_modes under this to country id 1
            $country->cases()->update(['country_id' => 1]);
        });

        static::creating(function ($country) {
        });
    }


    //relationship for case_modes 
    public function cases()
    {
        return $this->hasMany(CaseModel::class, 'country_id');
    }
}
