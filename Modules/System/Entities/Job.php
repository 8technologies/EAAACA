<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Job extends Model
{
    use Filterable;
    use SearchableTrait;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'reserved_at',
        'available_at',
        'created_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'reserved_at',
        'available_at',
        'created_at',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'queue',
        'payload',
        'attempts',
        'reserved_at',
    ];

    // protected $casts = [
    //     'methodType'    => 'string',
    // ];

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
            'jobs.queue' => 10,
            'jobs.payload' => 10,
            'jobs.attempts' => 10,
        ]
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name', 
        // 'entity_links',
    ];




    /**
     * Get the Name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return 'Job' . $this->id;
    }
    public function getModelNameAttribute($value)
    {
        return 'Job';
    }
    public function getUuidAttribute($value)
    {
        return $this->id . '-Job';
    }

    public function modelFilter()
    {
        return $this->provideFilter(\Modules\System\ModelFilters\EntityFilter::class);
    }


}
