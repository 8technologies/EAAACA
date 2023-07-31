<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Team extends JetstreamTeam
{
    use HasFactory;
    use Filterable;
    use SearchableTrait;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
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
            'teams.name' => 10,
            'users.name' => 5,
            'users.email' => 5,
        ],
        'joins' => [
            'users' => ['teams.user_id','users.id'],
        ],
    ];
    
    /**
     * Custom modelFilter class.
     *
     * @var EloquentFilter\Filterable::class
     */
    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\TeamFilter::class);
    }

    /**
     * Get the Permissions.
     *
     * @param  string  $value
     * @return string
     */
    public function getEntityPermissionsAttribute($value)
    {
        $permissions = array();

        $permissions['view'] = \Auth::user()->can('view', $this) ? true : false;
        $permissions['edit'] = \Auth::user()->can('update', $this) ? true : false;
        $permissions['delete'] = \Auth::user()->can('delete', $this) ? true : false;

        return $permissions;
    }
    
}
