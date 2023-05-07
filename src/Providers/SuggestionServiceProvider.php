<?php

namespace Suggestion\Providers;

use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Config\Repository as Config;
use Suggestion\SuggestionClient;
use Suggestion\Facades\Suggestion;
use Illuminate\Support\ServiceProvider;

class SuggestionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(Suggestion::class, function ($app) {
            $client = $app->make(ClientInterface::class);
            $config = $app->make(Config::class);

            return new SuggestionClient($client, $config);
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