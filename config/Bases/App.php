<?php

namespace Config\Bases;

use Config\Routes\Route;
use Config\Exceptions\Routes\NotFoundException;
use \Dotenv\Dotenv;

class App
{
    /**
     * Execute l'application et instancié les données réquise
     *
     * @return void
     */
    public static function run()
    {
        try {
            $dotenv = Dotenv::createImmutable(BASE_PATH);
            $dotenv->load();
            (new Route())->run();
        } catch (NotFoundException $e) {
            return $e->error404();
        }
    }
}