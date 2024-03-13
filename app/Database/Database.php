<?php

namespace App\Database;

class Database
{
    public static ?\PDO $instance = null;
    public static function getInstance(): ?\PDO
    {
        if (self::$instance == null){
            self::$instance = new \PDO(self::getDSN(),env('DB_USER'),env('DB_PASSWORD'),[
                \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
    public static function getDSN(): string
    {
        return sprintf('mysql:host=%s;dbname=%s;charset=utf8',env('DB_HOST'),env('DB_DATABASE'));
    }

}