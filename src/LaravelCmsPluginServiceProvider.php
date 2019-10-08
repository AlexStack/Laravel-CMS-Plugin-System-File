<?php

namespace Amila\LaravelCms\Plugins\SystemFile;

use Illuminate\Support\ServiceProvider;

class LaravelCmsPluginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Publish view
        $this->publishes([__DIR__.'/resources/views/plugins' => base_path('resources/views/vendor/laravel-cms/plugins')], 'system-file-views');

        // Publish lang
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/laravel-cms')], 'system-file-lang');

        // Publish assets
        $this->publishes([__DIR__.'/assets/plugins' => public_path('laravel-cms/plugins')], 'system-file-assets');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
