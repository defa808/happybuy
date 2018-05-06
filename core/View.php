<?php

namespace core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        ob_start();
        require 'Views/' . $this->path . '.php';
        $content = ob_get_clean();
        require 'Views/Shared/' . $this->layout . '.php';
    }
}
