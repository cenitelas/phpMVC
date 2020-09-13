<?php

if (!defined('path')) {
function path($path = null) {

    $root = dirname(getcwd());

    if (!$path)
        return $root;

    $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    $path = trim(trim($path), DIRECTORY_SEPARATOR);
    $path = $root . DIRECTORY_SEPARATOR . $path;

    if ($real = realpath($path))
        return $real;

    return $path;
}
}

if (!defined('config')) {
function config(string $key, $default = null) {
    return App\Kernel\Config::get($key, $default);
}
}

if (!defined('view')) {
function view($name, array $vars = []) {

    $engine = App\ServiceProviders\ViewServiceProvider::engine();
    $template = $engine->render("$name.twig", $vars);

    $response = new Laminas\Diactoros\Response();
    $response->getBody()->write($template);
    return $response;
}
}

if (!defined('redirect')) {
function redirect($to) {
    $response = new Laminas\Diactoros\Response();
    return $response
        ->withHeader('Location', $to)
        ->withStatus(302);
}
}

if (!defined('auth')) {
function auth() {
    return App\ServiceProviders\AuthServiceProvider::auth();
}
}

if(!defined('route')){
    function route(string $name, array $args = []){
        $router = \App\ServiceProviders\RouteServiceProvider::router();
        $route = $router->getNamedRoute($name);

        $host = 'http' . '://' . $_SERVER['HTTP_HOST'];
        return $host . $route->getPath($args);
    }
}