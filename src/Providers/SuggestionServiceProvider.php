<?php

namespace Suggestion\Providers;

use Suggestion\SuggestionClient;
use Suggestion\Facades\Suggestion;
use Illuminate\Support\ServiceProvider;

class SuggestionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(Suggestion::class, function ($app) {
            return new SuggestionClient();
        });
        $this->mergeConfigFrom(__DIR__.'/../../config/suggestion.php', 'suggestion');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/suggestion.php' => $this->getConfigPath(),
            ], 'config');
        }
    }

    protected function getConfigPath()
    {
        if (function_exists('config_path')) {
            return config_path('suggestion.php');
        }

        return $this->app->basePath('config/suggestion.php');
    }

}