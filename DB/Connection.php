<?php

namespace DB\query;
use PDO;
require  __DIR__ .'/../config.php';

class Connection
{

    public static function make () {
        $dsn = 'mysql:host='. DB_HOST. ';dbname='. DB_NAME;
        return new PDO($dsn, DB_USER, DB_PASS);
    }
}