<?php

namespace Macki\Providers;

use Illuminate\Support\ServiceProvider;

use Macki\AmazonProductApiClient;
use Macki\Factory\AmazonProductApiFactory;

class AmazonProductApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/amazon-product-api.php' => config_path('amazon-product-api.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/amazon-product-api.php', 'amazon-product-api'
        );

        $this->app->singleton(AmazonProductApiClient::class, function ($app) {
            return AmazonProductApiFactory::createForConfig($app['config']['amazon-product-api']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [AmazonProductApiClient::class];
    }
}
