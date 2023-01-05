<?php

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('BASE_RESOURCES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR);

use Config\Bases\App;
use Config\Routes\Router;

require '../vendor/autoload.php';

$router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

$router->get('/', ['App\Controllers\HomeController', 'index']);
$router->get('/articles', ['App\Controllers\BlogController', 'index']);
$router->get('/orders', ['App\Controllers\OrderController', 'index']);

(new App($router))->run();