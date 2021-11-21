<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Devices
    |--------------------------------------------------------------------------
    |
    | Add here the Device Service Providers that you would like to load.
    |
    | You can also toggle which devices will be loaded by the application
    | by adding true or false to each device. For example:
    |
    | Will be registered:
    | 'devices' => [
    |       'App\Devices\Example1\Providers\ExampleServiceProvider'
    |       'App\Devices\Example2\Providers\ExampleServiceProvider' => true
    | ]
    |
    | Will not be registered:
    | 'devices' => [
    |       'App\Devices\Example1\Providers\ExampleServiceProvider' => false
    | ]
    |
    | TIP: You can also use env variables to control how and when the devices
    | will be loaded. For example, you can disable certain devices for certain environments.
    |
    */
    'devices' => [

    ],

    /*
     | Control whether or not the FeatureStarted and JobStarted events will be fired.
     */
    'broadcast_events' => true,

    /*
     | Set where the vivid logger will output the logs.
     */
    'log_channel' => 'stack',

    /*
     | How long the cacheable Jobs should be kept for.
     */
    'default_cache_duration' => 600
];
