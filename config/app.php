<?php

use App\ServiceProviders\AuthServiceProvider;
use App\ServiceProviders\DatabaseServiceProvider;
use App\ServiceProviders\ExceptionsServiceProvider;
use App\ServiceProviders\RouteServiceProvider;
use App\ServiceProviders\ViewServiceProvider;

return [

    'name' => 'MVC',
    'debug' => true,
    'auth' => [
        'admin' => [
            'username' => 'Hello world!'
        ]
    ],

    'providers' => [
        ExceptionsServiceProvider::class,
        DatabaseServiceProvider::class,
        AuthServiceProvider::class,
        ViewServiceProvider::class,
        RouteServiceProvider::class,
    ]

];
