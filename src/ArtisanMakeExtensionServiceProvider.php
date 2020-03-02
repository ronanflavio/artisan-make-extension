<?php

namespace Ronanflavio\ArtisanMakeExtension;

use Illuminate\Support\ServiceProvider;

class ArtisanMakeExtensionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\MakeDto::class,
                Console\MakeService::class,
            ]);
        }
    }
}
