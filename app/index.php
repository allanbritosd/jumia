<?php

require_once 'vendor/autoload.php';

$dotenv = new Symfony\Component\Dotenv\Dotenv;
$dotenv->load(__DIR__.'/.env');

echo "Hello World!";
