<?php


namespace App\ServiceProviders;


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ExceptionsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $debug = config('app.debug') === true;
        if($debug) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
        }
    }

}
