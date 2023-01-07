<?php

namespace Config\Bases;

class Renderer
{
    private string $viewpath;
    private string $layout;
    private $params;

    public function __construct(string $viewpath, $params = null, string $layout = 'base')
    {
        $this->viewpath = BASE_VIEW_PATH . str_replace('.', DIRECTORY_SEPARATOR, $viewpath) . '.php';
        $this->layout = BASE_VIEW_PATH . 'layouts' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $layout) . '.php';
        $this->params = $params;
    }

    public function render()
    {
        ob_start();

        if (!is_null($this->params)) {
            extract($this->params);
        }

        require $this->viewpath;

        $content = ob_get_clean();

        require $this->layout;
    }

    public static function view(string $viewpath, $params = null, string $layout = 'base')
    {
        return (new static($viewpath, $params, $layout))->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}