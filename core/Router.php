<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 14:20
 */

namespace core;
class Router
{
    protected $routes = [];

    protected $requestUri;

    protected $requestMethod;

    protected $requestHandler;

    protected $params = [];

    public function __construct($uri, $method = 'GET')
    {
        $arr = require 'config/routes.php';

        foreach ($arr as $k => $v) {
            $this->add($k, $v);
        }
        $this->requestUri = $uri;
        $this->requestMethod = $method;
    }

    public function getRequestUri()
    {
        return $this->requestUri; // ?: '/';
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function getRequestHandler()
    {
        return $this->requestHandler;
    }

    public function setRequestHandler($handler)
    {
        $this->requestHandler = $handler;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function add($route, $param)
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $param;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

//    public function add($route, $handler = null)
//    {
//        if ($handler !== null && !is_array($route)) {
//            $route = array($route => $handler);
//        }
//        $this->routes = array_merge($this->routes, $route);
//
//        return $this;
//    }

    public function isFound()
    {
        $uri = $this->getRequestUri();
        if (isset($this->routes[$uri])) {
            $this->requestHandler = $this->routes[$uri];
            return true;
        }


        return false;
    }

//    public function executeHandler($handler = null, $params = array())
//    {
//        if ($handler === null) {
//            throw new \InvalidArgumentException(
//                'Request handler not setted out. Please check ' . __CLASS__ . '::isFound() first'
//            );
//        }
//
//        // execute action in callable
//        if (is_callable($handler)) {
//            return call_user_func_array($handler, $params);
//        }
//
//        // execute action in controllers
//        if (strpos($handler, '/')) {
//            $ca = explode('/', $handler);
//            $controllerName = $ca[0];
//            $action = $ca[1];
//
//            if (class_exists($controllerName)) {
//                $controller = new $controllerName();
//            } else {
//                throw new \RuntimeException("Controller class '{$controllerName}' not found");
//            }
//            if (!method_exists($controller, $action)) {
//                throw new \RuntimeException("Method '{$controllerName}::{$action}' not found");
//            }
//
//            return call_user_func_array(array($controller, $action), $params);
//        }
//    }

    public function run()
    {
        if ($this->match()) {
            $path = 'Controllers\\'.ucfirst($this->params['controller'].'Controller');
            if(class_exists($path)){
               $action = $this->params['action'].'Action';
               if(method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller->$action();
               }
               else{
                   throw new \RuntimeException("Method  '{$action}' not found");
               }

            }
            else{
                throw new \RuntimeException("Controller class '{$path}' not found");
            }
        } else {
            echo 'Error 404';
        }
    }


}