<?php

namespace Munza\Serviceman;

use Illuminate\Support\ServiceProvider;

class ServicemanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/config/serviceman.php' => config_path('serviceman.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeService::class,
                Commands\MakeServiceCommand::class,
                Commands\MakeServiceHandler::class,
                Commands\MakeServiceMiddleware::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../resources/config/serviceman.php', 'serviceman'
        );
    }
}
