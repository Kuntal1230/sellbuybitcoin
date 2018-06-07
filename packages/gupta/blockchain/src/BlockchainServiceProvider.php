<?php

namespace Gupta\Blockchain;

use Illuminate\Support\ServiceProvider;

class BlockchainServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../resources/config/blockchain.php');

        $this->publishes([
            $config => config_path('blockchain.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('blockchain', function() {
            return new Blockchain;
        });
    }

    /**
    * Get the services provided by the provider
    * @return array
    */
    public function provides()
    {
        return ['blockchain'];
    }
}
