<?php

namespace Jvdw\Analytics;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
        $this->registerRoutes();
    }
    
    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/Storage/migrations');
        }
    }

    /**
     * Register the package's routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function() {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Analytics route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration() {
        // TODO: Add middleware to this route configuration.
        return [
            'namespace' => 'Jvdw\Analytics\Http\Controllers',
            'prefix' => 'app-analytics-api'
        ];
    }
    
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Console\AddAppMetric::class,
        ]);
    }
}