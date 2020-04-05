<?php

namespace LaravelSwivel;

use \Illuminate\Contracts\Container\Container;
use \Illuminate\Support\ServiceProvider;
use \Illuminate\Foundation\Application as LaravelApplication;
use \Laravel\Lumen\Application as LumenApplication;

class SwivelServiceProvider extends ServiceProvider
{
    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '1.1.0';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('swivel', function (Container $app) {
            $request = $app->make(\Illuminate\Http\Request::class);
            return new SwivelComponent($request);
        });

        $this->app->alias('swivel', SwivelComponent::class);
    }

    /**
     * Returns the configuration path for the component
     *
     * @return string
     */
    private function configPath()
    {
        return realpath($raw = __DIR__ . '/../config/swivel.php') ?: $raw;
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app The container
     * @return void
     */
    protected function setupConfig(Container $app)
    {
        $source = $this->configPath();

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('swivel.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('swivel');
        }

        $this->mergeConfigFrom($source, 'swivel');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['swivel'];
    }
}
