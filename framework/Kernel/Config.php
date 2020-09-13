<?php


namespace App\Kernel;


use Exception;

class Config
{

    protected static $cache = [];

    static function get(string $key, $default = null) {
        $parts = explode('.', $key);
        $config = array_shift($parts);
        $config = self::getArray($config);

        foreach ($parts as $part)
            $config = $config[$part] ?? $default;

        return $config;
    }

    protected static function getArray($name) {

        if (isset(self::$cache[$name]))
            return self::$cache[$name];

        $path = path("config/$name.php");

        if (!file_exists($path))
            throw new Exception("Config $name doesn't exists.");

        return self::$cache[$name] = include $path;
    }

}
