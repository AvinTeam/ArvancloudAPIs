<?php

namespace Avinmedia\ArvancloudApis;

use Avinmedia\ArvancloudApis\Http\GuzzleClient;
use Illuminate\Support\ServiceProvider;

class ArvancloudApisServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('ArvancloudAPIs.php'),
        ], 'config');

    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ArvancloudAPIs');


        $this->app->singleton('ArvanVideoPlatform', function () {
            return new ArvanVideoPlatform;
        });

        $this->app->singleton(GuzzleClient::class, function () {
            return new GuzzleClient;
        });
    }
}