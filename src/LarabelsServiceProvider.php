<?php

declare(strict_types=1);

namespace Sandulat\Larabels;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

final class LarabelsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if (config('larabels.enabled')) {
            $this->registerRoutes();

            $this->registerViews();
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('larabels.php'),
            ], 'larabels-config');

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/larabels'),
            ], 'larabels-assets');

            $this->publishes([
                __DIR__.'/../stubs/LarabelsServiceProvider.stub' => app_path('Providers/LarabelsServiceProvider.php'),
            ], 'larabels-provider');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'larabels');

        $this->commands([
            Console\InstallCommand::class,
            Console\PublishCommand::class,
        ]);

        $this->app->singleton('larabels', function () {
            return new Larabels;
        });
    }


    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the main route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration(): array
    {
        return [
            'namespace' => 'Sandulat\Larabels\Http\Controllers',
            'prefix' => config('larabels.path'),
            'middleware' => array_merge(config('larabels.middleware'), ['web']),
        ];
    }

    /**
     * Register the package views.
     *
     * @return array
     */
    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'larabels');
    }
}
