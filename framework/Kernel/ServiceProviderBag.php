<?php


namespace App\Kernel;


use App\Kernel;
use App\ServiceProviders\ServiceProviderInterface;
use Exception;
use ReflectionClass;

class ServiceProviderBag
{

    /** @var  ServiceProviderInterface[] */
    protected $providers;
    /** @var Kernel */
    protected $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
        $this->providers = [];
    }

    function register($name)
    {
        $this->checkProvider($name);
        $provider = new $name($this->kernel);
        $provider->register();
        $this->providers[$name] = $provider;
    }

    protected function checkProvider($provider)
    {
        $reflection = new ReflectionClass($provider);

        if (!$reflection->implementsInterface(ServiceProviderInterface::class))
            throw new Exception("Class $provider must implements ServiceProviderInterface.");

        if (array_key_exists($provider, $this->providers))
            throw new Exception("Provider $provider already registered.");

    }

    function boot()
    {
        foreach ($this->providers as $provider)
            $provider->boot();
    }

}
