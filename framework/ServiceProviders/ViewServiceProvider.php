<?php


namespace App\ServiceProviders;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends ServiceProvider
{

    protected static $engine;

    static function engine(): Environment {
        return self::$engine;
    }

    public function register()
    {
        if (self::$engine instanceof Environment)
            return;

        $path = path('app/views');

        $loader = new FilesystemLoader($path);
        self::$engine = new Environment($loader);
        self::$engine->addGlobal('auth',auth());
    }

}
