<?php

namespace Modules\Content\Providers;

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
        \Modules\Content\Entities\ContentBlogPost::observe(\Modules\Content\Observers\ContentBlogPostObserver::class);
        \Modules\Content\Entities\ContentEvent::observe(\Modules\Content\Observers\ContentEventObserver::class);
        \Modules\Content\Entities\ContentFeatured::observe(\Modules\Content\Observers\ContentFeaturedObserver::class);
        \Modules\Content\Entities\ContentGallery::observe(\Modules\Content\Observers\ContentGalleryObserver::class);
        \Modules\Content\Entities\ContentNews::observe(\Modules\Content\Observers\ContentNewsObserver::class);
        \Modules\Content\Entities\ContentOurWork::observe(\Modules\Content\Observers\ContentOurWorkObserver::class);
        \Modules\Content\Entities\ContentPage::observe(\Modules\Content\Observers\ContentPageObserver::class);
        \Modules\Content\Entities\ContentBlogPost::observe(\Modules\Content\Observers\ContentBlogPostObserver::class);
        \Modules\Content\Entities\ContentPublication::observe(\Modules\Content\Observers\ContentPublicationObserver::class);
        \Modules\Content\Entities\ContentService::observe(\Modules\Content\Observers\ContentServiceObserver::class);
        \Modules\Content\Entities\ContentTestimony::observe(\Modules\Content\Observers\ContentTestimonyObserver::class);
    }

}