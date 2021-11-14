<?php

/*
 * This file is part of the vivid-foundation project.
 *
 * Copyright for portions of project lucid-foundation are held by VineLab, 2016 as part of Lucid Architecture.
 * All other copyright for project Vivid Architecture are held by Meletios Flevarakis, 2021.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vivid\Foundation;

use Illuminate\Support\ServiceProvider;

class VividServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
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
     */
    public function boot(): void
    {
        // Register the configuration file
        $this->publishes([
            __DIR__ . '/../config/vivid.php' => config_path('vivid.php'),
        ], 'vivid-config');
    }

    /**
     * Register an array of Devices.
     */
    private function registerDevices(array $devices): void
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
