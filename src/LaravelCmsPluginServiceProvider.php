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
        // Publish admin view
        $this->publishes([__DIR__.'/resources/views/plugins' => base_path('resources/views/vendor/laravel-cms/plugins')], 'system-file-views');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
