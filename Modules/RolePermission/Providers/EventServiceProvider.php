<?php

namespace Modules\RolePermission\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            // SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Register Observers
        \Modules\RolePermission\Entities\Permission::observe(\Modules\RolePermission\Observers\PermissionObserver::class);
        \Modules\RolePermission\Entities\PermissionType::observe(\Modules\RolePermission\Observers\PermissionTypeObserver::class);
        \Modules\RolePermission\Entities\Role::observe(\Modules\RolePermission\Observers\RoleObserver::class);
        \Modules\RolePermission\Entities\SystemModel::observe(\Modules\RolePermission\Observers\SystemModelObserver::class);
    }

}