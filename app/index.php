<?php

require 'bootstrap.php';

use App\Config\Router;

$router = new Router;
$router->resolve($_GET['url']);