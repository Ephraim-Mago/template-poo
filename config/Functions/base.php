<?php

use Config\Bases\Renderer;

function view(string $viewpath, $params = null, string $layout = 'base')
{
    return Renderer::view($viewpath, $params, $layout);
}

function dd(mixed $variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}