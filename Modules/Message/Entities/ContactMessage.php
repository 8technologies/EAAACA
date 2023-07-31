<?php

namespace Modules\Message\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Nicolaslopezj\Searchable\SearchableTrait;
use EloquentFilter\Filterable;
use Illuminate\Notifications\Notifiable;

class ContactMessage extends Model
{
    use HasFactory;
    use SearchableTrait;
    use Filterable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone_number',
        'message',
        'user_id', 
        'read_at', 
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'model_name', 
        'entity_links',
        'uuid'
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
            'blocks.name' => 10,
            'blocks.email' => 10,
            'blocks.phone_number' => 7,
            'blocks.message' => 5,
        ]
    ];

    /**
     * Get the ModelName.
     *
     * @param  string  $value
     * @return string
     */
    public function getModelNameAttribute($value)
    {
        return 'ContactMessage';
    }
    public function getUuidAttribute($value)
    {
        return $this->id . '-ContactMessage';
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    
    /**
     * Get Model Links.
     *
     * @param  null
     * @return array
     */
    public function getEntityLinksAttribute()
    {
        $links = [
            'url'  => route('dashboard.contact_messages.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.contact_messages.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.contact_messages.edit', [$this->attributes['id']]),
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

    /**
     * ModelFilters Class.
     */
    public function modelFilter()
    {
        return $this->provideFilter(\Modules\Message\ModelFilters\EntityFilter::class);
    }

    protected static function newFactory()
    {
        return \Modules\Message\Database\factories\ContactMessageFactory::new();
    }
}
