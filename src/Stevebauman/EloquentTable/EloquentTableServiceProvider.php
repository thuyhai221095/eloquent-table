<?php

namespace Stevebauman\EloquentTable;

use Illuminate\Support\ServiceProvider;

/**
 * Class EloquentTableServiceProvider
 * @package Stevebauman\EloquentTable
 */
class EloquentTableServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The configuration separator for packages.
     * Allows compatibility with Laravel 4 and 5
     *
     * @var string
     */
    public static $configSeparator = '::';

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if(method_exists($this, 'package'))
        {
            /*
             * Looks like we're using Laravel 4, let's use the
             * package method to easily register everything
             */
            $this->package('stevebauman/eloquenttable');
        } else
        {
            /*
             * Looks like we're using Laravel 5, let's set
             * our configuration file to be publishable
             */
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('eloquenttable.php'),
            ], 'config');

            /*
             * Load our views
             */
            $this->loadViewsFrom(__DIR__.'/../../views', 'eloquenttable');

            /*
             * Set the configuration separator to single dot since
             * configuration retrieval for packages changed from Laravel 4 to 5
             */
            $this->configSeparator = '.';
        }

        // Include the helpers so we can output sortable links
        include __DIR__ .'/../../helpers.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {}

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
            return array('eloquenttable');
    }
}