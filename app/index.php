<?php

require_once 'vendor/autoload.php';

$dotenv = new Symfony\Component\Dotenv\Dotenv;
$dotenv->load(__DIR__.'/.env');

use \App\Config\Database\SqliteDatabaseConnector;

var_dump(SqliteDatabaseConnector::getInstance()->executeQuery('select * from customer'));

echo "Hello World!";
