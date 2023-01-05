<?php

namespace Config\Bases;

use Config\Routes\Route;
use Config\Exceptions\Routes\NotFoundException;

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
            (new Route())->run();
        } catch (NotFoundException $e) {
            return $e->error404();
        }
    }
}