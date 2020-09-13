<?php


namespace App;


use App\Kernel\ServiceProviderBag;
use Laminas\Diactoros\ServerRequestFactory;

class Kernel
{

    protected $request;
    /** @var ServiceProviderBag */
    protected $providers;

    public function __construct()
    {
        $this->request = $this->bootRequest();
        $this->registerProviders();
    }

    protected function registerProviders() {
        $providers = config("app.providers");

        foreach ($providers as $provider)
            $this->register($provider);

    }

    protected function bootRequest() {
        return ServerRequestFactory::fromGlobals();
    }

    function request() {
        return $this->request;
    }

    function register($provider) {

        if (!$this->providers)
            $this->providers = new ServiceProviderBag($this);

        $this->providers->register($provider);
    }

    function dispatch() {
        $this->providers->boot();
    }

}
