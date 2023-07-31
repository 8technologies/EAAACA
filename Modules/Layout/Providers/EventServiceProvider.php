<?php

namespace Modules\Layout\Providers;

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
        \Modules\Layout\Entities\LayoutColumn::observe(\Modules\Layout\Observers\LayoutColumnObserver::class);
        \Modules\Layout\Entities\LayoutRow::observe(\Modules\Layout\Observers\LayoutRowObserver::class);
        \Modules\Layout\Entities\LayoutSection::observe(\Modules\Layout\Observers\LayoutSectionObserver::class);
        \Modules\Layout\Entities\LayoutSectionTop::observe(\Modules\Layout\Observers\LayoutSectionTopObserver::class);

    }

}