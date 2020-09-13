<?php


namespace App\ServiceProviders;


use App\Kernel;

abstract class ServiceProvider implements ServiceProviderInterface
{

    protected $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    function register()
    {
    }

    function boot()
    {
    }

}
