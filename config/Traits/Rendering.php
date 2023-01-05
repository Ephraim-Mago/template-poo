<?php

namespace Config\Traits;

trait Rendering
{
    public function view(string $path, ?array $params = null, string $layout = 'base')
    {
        ob_start();
        if (!is_null($params)) {
            extract($params);
        }
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require BASE_VIEW_PATH . $path . '.php';
        $content = ob_get_clean();
        require BASE_VIEW_PATH . 'layouts/' . $layout . '.php';
    }
}