<?php

namespace Vivid\Foundation;

use Illuminate\Support\ServiceProvider;

class VividServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Add the Instance class to the container
        $this->app->singleton('Vivid\Foundation\Instance', function ($app) {
            return new Instance();
        });

        $devices = config('vivid.devices');

        if (is_array($devices)) {
            $this->registerDevices($devices);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the configuration file
        $this->publishes([
            __DIR__.'/../config/vivid.php' => config_path('vivid.php'),
        ], 'vivid-config');
    }

    /**
     * Register an array of Devices.
     *
     * @return void
     */
    private function registerDevices(array $devices)
    {
        foreach ($devices as $k => $v) {
            if ($v !== false && is_string($k)) {
                $this->app->register($k);
            } elseif (is_int($k)) {
                $this->app->register($v);
            }
        }
    }
}
