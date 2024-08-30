<?php

namespace Jatri\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // Register routes
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        // Publish config
        $this->publishes([
            __DIR__.'/config/crudgenerator.php' => config_path('crudgenerator.php'),
        ], 'config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/Migrations/' => database_path('migrations'),
        ], 'migrations');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\GenerateCrud::class,
            ]);
        }
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/crudgenerator.php',
            'crudgenerator'
        );
    }
}
