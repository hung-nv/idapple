<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Interfaces\ImageInterface::class, \App\Repositories\ImageRepository::class);
        $this->app->bind(\App\Interfaces\ExcelInterface::class, \App\Repositories\ExcelRepositories::class);
        //:end-bindings:
    }
}
