<?php

namespace Webkod3r\LaravelSwivel;

use \Illuminate\Contracts\Container\Container;
use \Illuminate\Support\ServiceProvider;
use \Illuminate\Foundation\Application as LaravelApplication;
use \Laravel\Lumen\Application as LumenApplication;

class LaravelSwivelServiceProvider extends ServiceProvider {

    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '0.2.2';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot() {
        $this->setupConfig($this->app);

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    private function configPath() {
        return realpath($raw = __DIR__ . '/../config/swivel.php') ?: $raw;
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     * @return void
     */
    protected function setupConfig(Container $app) {
        $source = $this->configPath();

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('swivel.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('swivel');
        }

        // merge specific configurations
        $source = $app->getConfigurationPath('swivel') ?: $source;
        $this->mergeConfigFrom($source, 'swivel');
    }

    /**
     * Publish swivel assets.
     */
    private function publishAssets() {
        app()->make('config')->set('swivel', app()->getConfigurationPath('swivel'));
        app()->configure('swivel');
    }

    /**
     * @return void
     */
    public function register() {
        $this->registerClass();
    }

    /**
     * Register single service provider
     *
     * @return void
     */
    private function registerClass() {
        $this->app->singleton('Swivel', function (Container $app) {
            $request = app(\Illuminate\Http\Request::class);
            return new SwivelComponent($request);
        });

        $this->app->alias('Swivel', SwivelComponent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return ['Swivel'];
    }
}
