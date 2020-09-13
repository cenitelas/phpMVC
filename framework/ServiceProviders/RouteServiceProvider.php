<?php


namespace App\ServiceProviders;


use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

class RouteServiceProvider extends ServiceProvider
{

    /** @var Router */
    protected static $router;

    function register()
    {
        self::$router = new Router();
    }

    function boot()
    {
        $router = self::$router;
        require_once path('routes/web.php');

        try{
            $response = $router->dispatch($this->kernel->request());
            (new SapiEmitter)->emit($response);
        }catch (Throwable $exception){
            if(config('app.debug')===true){
                throw $exception;
            }
            $code = $exception->getCode();
            $code = $code == 0 ? 500 : $code;
            $response = view('error',[
                'code'=> $code,
                'message' => $exception->getMessage()
            ])->withStatus($code);

            (new SapiEmitter)->emit($response);
        }

    }

    static function router(){
        return self::$router;
    }
}
