<?php
if (!function_exists("env")){
    function env($key)
    {
        return parse_ini_file('.env')[$key];
    }
}
if (!function_exists('config')){
    function config($key,$default=null)
    {
        $config = include_once "config/database.php";
        return $config[$key] ?? $default;
    }
}

