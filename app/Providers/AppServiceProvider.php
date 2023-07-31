<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

use Intervention\Image\Image;
use Optix\Media\Facades\Conversion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('config.app', function() {
            return [
                'name' => config('app.name'),
            ];
        });

        Conversion::register('thumb', function (Image $image) {
            return $image->fit(100, 100);
        });
        // Conversion::register('thumb-medium', function (Image $image) {
        //     $width = 350; // your max width
        //     $height = 350; // your max height

        //     $image->height() > $image->width() ? $width=null : $height=null;
        //     return $image->resize($width, $height, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        // });
        Conversion::register('preview', function (Image $image) {
            $width = 900; // your max width
            $height = 400; // your max height

            $image->height() > $image->width() ? $width=null : $height=null;
            return $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        });
        Conversion::register('preview-sm', function (Image $image) {
            $width = 500; // your max width
            $height = 500; // your max height

            $image->height() > $image->width() ? $width=null : $height=null;
            return $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        });
        Conversion::register('preview-md', function (Image $image) {
            $width = 1200; // your max width
            $height = 700; // your max height

            $image->height() > $image->width() ? $width=null : $height=null;
            return $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        });
        Conversion::register('preview-lg', function (Image $image) {
            $width = 1400; // your max width
            $height = 900; // your max height

            $image->height() > $image->width() ? $width=null : $height=null;
            return $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        });


        Conversion::register('slider', function (Image $image) {
            return $image->fit(1400, 720);
        });
        Conversion::register('slider-md', function (Image $image) {
            return $image->fit(900, 500);
        });


        // 
        Conversion::register('thumbnail-landscape', function (Image $image) {
            return $image->fit(500, 280);
        });
        // Conversion::register('list-landscape-xs', function (Image $image) {
        //     return $image->fit(80, 50);
        // });
        // Conversion::register('list-landscape-sm', function (Image $image) {
        //     return $image->fit(200, 120);
        // });
        // Conversion::register('list-landscape-md', function (Image $image) {
        //     return $image->fit(500, 300);
        // });
        Conversion::register('landscape-lg', function (Image $image) {
            return $image->fit(800, 500);
        });
        Conversion::register('landscape-xl', function (Image $image) {
            return $image->fit(1200, 800);
        });



        // 
        
        Conversion::register('thumbnail-portrait', function (Image $image) {
            return $image->fit(250, 350);
        });
        // Conversion::register('list-portrait-xs', function (Image $image) {
        //     return $image->fit(50, 70);
        // });
        // Conversion::register('list-portrait-sm', function (Image $image) {
        //     return $image->fit(120, 150);
        // });
        // Conversion::register('list-portrait-md', function (Image $image) {
        //     return $image->fit(300, 350);
        // });
        Conversion::register('list-portrait-lg', function (Image $image) {
            return $image->fit(500, 650);
        });
        Conversion::register('list-portrait-xl', function (Image $image) {
            return $image->fit(800, 1000);
        });

    }
}
