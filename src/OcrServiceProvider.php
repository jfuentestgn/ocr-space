<?php

namespace JFuentesTgn\OcrSpace;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;
use Log;

class OcrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Setup config
        $source = realpath(__DIR__.'/../config/ocrspace.php');
        $this->publishes([$source => config_path('ocrspace.php')]);
        $this->mergeConfigFrom($source, 'ocrspace');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ocrspaceapi', function (Container $app) {
            $config = $app['config'];
            return new OcrAPI($config->get('ocrspace.apiKey'), $config->get('ocrspace.url'));
        });
        $this->app->alias('ocrspaceapi', OcrAPI::class);
    }
    
    public function provides()
    {
        return ['ocrspaceapi'];
    }
}
