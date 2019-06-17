<?php

namespace App\Config;

class Connection {

    private static $connection;

    private function __construct() 
    {
    }

    public function newInstance() {
        if (!self::$connection) {
            self::$connection = new \PDO("pgsql:host=localhost;port=5432;dbname=galery;user=postgres;password=root");
        } 
        return self::$connection;
    }
}