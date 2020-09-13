<?php


namespace App\ServiceProviders;


interface ServiceProviderInterface
{
    function register();
    function boot();
}
