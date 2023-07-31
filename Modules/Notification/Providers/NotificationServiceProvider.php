<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Notification';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'notification';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('notifications', function() {
            if (!Auth::user()) {
                return;
            }

            $notificationsSummary = DB::table('notifications')
            ->select(DB::raw('category, count(*) as count, MAX(created_at) as created_at'))
            ->where('notifiable_type', '=', 'App\Models\User')
            ->where('notifiable_id', '=', Auth::user()->id)
            ->whereNull('read_at')
            ->orderBy('created_at', 'desc')
            ->groupBy('category')
            ->get();

            // dd( $notificationsSummary );

            $unreadNotifications = $notificationsSummary
                ->map(function ($item, $key) {
                    $keys = explode("\\", $item->category);
                    $lastKey = end($keys);
                    $notifWords = preg_split('/(?=[A-Z])/', $lastKey);

                    return [
                        'text' => trim(implode(" ", $notifWords)),
                        'count' => $item->count,
                        'date' => $item->created_at,
                    ];
                })->toArray();

            return [
                'total' => 0,
                'unread' => array_sum(array_column($unreadNotifications, 'count')),
                'unreadNotifications' => $unreadNotifications,
            ];
        });

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
