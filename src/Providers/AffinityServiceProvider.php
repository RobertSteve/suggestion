<?php

use Illuminate\Support\ServiceProvider;

class AffinityServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(Affinity::class, function ($app) {
            return new Affinity();
        });
        $this->mergeConfigFrom(__DIR__.'/../../config/affinity.php', 'affinity');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/affinity.php' => $this->getConfigPath(),
            ], 'config');
        }
    }

    protected function getConfigPath()
    {
        if (function_exists('config_path')) {
            return config_path('affinity.php');
        }

        return $this->app->basePath('config/affinity.php');
    }

}