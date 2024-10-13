<?php

namespace Fersot\ApiDocGenerator;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Fersot\ApiDocGenerator\Console\Commands\GenerateApiDoc;


class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/api-doc-generator.php', 'api-doc-generator');
        $this->app->singleton('ApiDocGenerator', function ($app) {
            return new \ApiDocGenerator\ApiDocGenerator();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/api-doc-generator.php' => config_path('api-doc-generator.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'api-doc-generator');

        $this->commands([
            GenerateApiDoc::class,
        ]);
    }
}
