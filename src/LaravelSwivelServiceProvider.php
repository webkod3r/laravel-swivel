<?php

namespace Webkod3r\LaravelSwivel;

use \Illuminate\Support\ServiceProvider;
use \Illuminate\Http\Request as IlluminateRequest;

class LaravelSwivelServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot() {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__ . '/config/swivel.php', 'swivel'
        );

        // publish the assets
        $this->publishes([__DIR__ . '/config/swivel.php', 'swivel']);

        // to access later to a configuration value
        //config('swivel.LoaderAlias');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * @return void
     */
    public function register() {
        $this->registerClass();

        // use this if your package has a config file
//        config([
//            'config/swivel.php',
//        ]);
    }

    /**
     * Register single service provider
     *
     * @return void
     */
    private function registerClass() {
        $this->app->singleton('Swivel', function ($app) {
            $request = app(\Illuminate\Http\Request::class);
            return new SwivelComponent($request);
            //return new SwivelComponent($app->make(IlluminateRequest::class));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        //return [SwivelComponent::class];
        return ['Swivel'];
    }
}
