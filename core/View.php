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
        extract($vars);
        if ($this->layout != null) {
            ob_start();
            require 'Views/' . $this->path . '.php';
            $content = ob_get_clean();
            require 'Views/Shared/' . $this->layout . '.php';
        }
        else{
            require 'Views/'.$this->path.'.php';
        }
    }

    public static function errorCode($code){
        http_response_code($code);
        $path = 'Views/Errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }
}
