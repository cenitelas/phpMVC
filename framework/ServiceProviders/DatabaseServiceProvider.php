<?php


namespace App\ServiceProviders;


use ActiveRecord\Config;

class DatabaseServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Config::initialize(function (Config $config) {
            $path = path("app/Models");
            $connections = config("db.connections");
            $default = config("db.default");

            $config->set_model_directory($path);
            $config->set_default_connection($default);
            $config->set_connections($connections);
        });
    }

}
