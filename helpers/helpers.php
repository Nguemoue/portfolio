<?php
if (!function_exists("env")){
    function env($key, $default = null)
    {
        $envPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
        if (!file_exists($envPath)) {
            return $default;
        }
        $vars = parse_ini_file($envPath);
        if ($vars === false) {
            return $default;
        }
        return $vars[$key] ?? $default;
    }
}
if (!function_exists('config')){
    function config($key,$default=null)
    {
        $config = include "config/database.php";
        return $config[$key] ?? $default;
    }
}

