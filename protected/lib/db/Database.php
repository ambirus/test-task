<?php

namespace lib\db;

use Exception;
use lib\Config;

class Database
{
    private static $_instance = null;

    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}

    public static function getInstance()
    {
        if (self::$_instance === null) {

            $config = Config::get('db');

            $className = 'lib\\db\\MysqlDriver';

            if (class_exists($className) === false)
                throw new Exception('Mysql driver is absent!');

            self::$_instance = new $className($config);
        }

        return self::$_instance->get();
    }
}