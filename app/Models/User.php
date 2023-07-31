<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Fortify\TwoFactorAuthenticatable;
// use Laravel\Jetstream\HasProfilePhoto;
// // use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use EloquentFilter\Filterable;
// use App\Traits\Jetstream\HasTeams;
// use Laravel\Jetstream\Jetstream;

// use Laravolt\Avatar\Avatar;
// use Illuminate\Support\Facades\Storage;
// use Laravel\Jetstream\Features;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\DB;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laravolt\Avatar\Avatar;

use Modules\Media\Traits\HasMediaField;
use Modules\User\Traits\UserTrait;
use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    // use HasProfilePhoto;
    // use HasTeams;
    use Notifiable;
    // use TwoFactorAuthenticatable;
    use HasRoles;

    use Filterable;
    use SearchableTrait;

    use HasMediaField;
    use UserTrait;
    use \Awobaz\Compoships\Compoships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'provider', 
        'provider_id', 

        'organization_id', 

        'designation',
        'telephone_number',
        'personal_email',
        'date_joined',
        'dob',
        'passport_number',
        'date_joined_organization',
        'area_of_expertise',
        'area_of_training_of_trainer',

        'access_token', 
        'enabled', 
        'email_verified_at',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'thumbnail',
        'entity_links',
        'media_image',
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
            'users.name' => 10,
            'users.email' => 10,
            // 'roles.name' => 5,
        ],
        // 'joins' => [
        //     'model_has_roles' => ['users.id','model_has_roles.model_id'],
        //     'roles' => ['model_has_roles.role_id','roles.id'],
        // ],
    ];








    /**
     * RELATIONSHIPS
     */

    // /**
    //  * Get all of the organizations for the contact point.
    //  */
    // public function contact_points()
    // {
    //     return $this->hasMany(
    //         \Modules\Custom\Entities\ContactPoint::class, 
    //         'user_account_id',
    //         'id',
    //         // ['user_account_id', 'user_account_id'], 
    //         // ['user_account_id', 'user_account_id'], 
    //     );
    // }

    public function organization(){
        return $this->belongsTo(\Modules\Custom\Entities\Organization::class, 'organization_id');
    }
    // public function user_profile(){
    //     return $this->hasOne(\Modules\User\Entities\UserProfile::class, 'user_id');
    // }



    // public function organizations()
    // {
    //     return $this->hasManyThrough(
    //         \Modules\Custom\Entities\Organization::class, 
    //         \Modules\Custom\Entities\ContactPoint::class, 
    //         // Deployment::class,
    //         // Environment::class,
    //         'organization_id', // Foreign key on the environments table...
    //         'id', // Foreign key on the deployments table...
    //         'id', // Local key on the projects table...
    //         'user_account_id' // Local key on the environments table...
    //     )
    //     ->where('user_account_id', Auth::user()->id);
    // }




    public function getUserOnlineAttribute()
    {
        if (Cache::has('user-is-online-' . $this->id)) {
            return true;
        }
        return false;
    }

    /**
     * Get / Set updated_at value.
     *
     * @var array
     */
    public function getLastSeenAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->diffForHumans();
        }
        return '';
    }



    /**
     * Get the Thumbnail.
     *
     * @param  string  $value
     * @return string
     */
    public function getThumbnailAttribute($value)
    {
        if ($this->getImageURL('images', 'thumb')) {
            return $this->getImageURL('images', 'thumb');
        }

        // dd( $defaultAvatar );
        $avatarPath = storage_path('app/public/profile-photos/' . $this->id . '.png');
        $avatarUrl = Storage::disk($this->profilePhotoDisk())->url('profile-photos/' . $this->id . '.png');
        
        if (file_exists($avatarPath)) {
            return $avatarUrl;
        } else {
            // Generate default avatar
            $avatar = new Avatar(getAvatarConfig());
            $avatarObj = $avatar->create($this->name)
                ->setShape('square')
                ->setTheme('*')
                ->setFontSize(140)
                ->setFont(public_path('fonts/OpenSans/OpenSans-Regular-webfont.ttf'))
                ->save(storage_path('app/public/profile-photos/' . $this->id . '.png'), $quality = 90);

            $avatarObj->save();
            return $avatarUrl;
        }

        return null;
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
            'url'  => route('dashboard.users.show', [$this->attributes['id']]),
            'url_view'  => route('dashboard.users.show', [$this->attributes['id']]),
            'url_edit'  => route('dashboard.users.edit', [$this->attributes['id']]),
        ];

        return $links;
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

        $permissions['view'] = Auth::user()->can('view', $this) ? true : false;
        $permissions['edit'] = Auth::user()->can('update', $this) ? true : false;
        $permissions['delete'] = Auth::user()->can('delete', $this) ? true : false;

        return $permissions;
    }

    /**
     * Custom modelFilter class.
     *
     * @var EloquentFilter\Filterable::class
     */
    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\UserFilter::class);
    }
}
