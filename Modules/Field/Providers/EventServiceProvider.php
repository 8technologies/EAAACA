<?php

namespace Modules\Field\Providers;

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
        \Modules\Field\Entities\FieldBlock::observe(\Modules\Field\Observers\FieldBlockObserver::class);
        \Modules\Field\Entities\FieldHtml::observe(\Modules\Field\Observers\FieldHtmlObserver::class);
        \Modules\Field\Entities\FieldImage::observe(\Modules\Field\Observers\FieldImageObserver::class);
        \Modules\Field\Entities\FieldLink::observe(\Modules\Field\Observers\FieldLinkObserver::class);
        \Modules\Field\Entities\FieldText::observe(\Modules\Field\Observers\FieldTextObserver::class);
        \Modules\Field\Entities\FieldTitle::observe(\Modules\Field\Observers\FieldTitleObserver::class);

    }

}