<?php

namespace Config\Routes;

use Config\Exceptions\Routes\NotFoundException;

class Route
{
    private $url;
    private static $routes = [];

    public function __construct()
    {
        $this->url = trim($_SERVER['REQUEST_URI'], '/');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function get(string $path, string $action): void
    {
        self::$routes['GET'][] = new Router($path, $action);
    }

    public static function post(string $path, string $action): void
    {
        self::$routes['POST'][] = new Router($path, $action);
    }

    public static function put(string $path, string $action): void
    {
        self::$routes['PUT'][] = new Router($path, $action);
    }

    public static function delete(string $path, string $action): void
    {
        self::$routes['DELETE'][] = new Router($path, $action);
    }

    public static function patch(string $path, string $action): void
    {
        self::$routes['PATCH'][] = new Router($path, $action);
    }

    public function run()
    {
        foreach (self::$routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }

        throw new NotFoundException("La page demandée est introuvable");
    }
}