<?php

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('BASE_RESOURCES_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR);

use Config\Bases\App;
use Config\Routes\Route;

require '../vendor/autoload.php';

Route::get('/', 'PageController@index');

App::run();