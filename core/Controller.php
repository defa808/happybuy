<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 20:04
 */

namespace core;

use core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function checkAcl()
    {
        $this->acl = require 'acl/' . $this->route['controller'] . '.php';
        if ($this->isAcl('all')) {
            return true;
        }
        if (isset($_SESSION['authorize']["Id"]) and $this->isAcl('authorize')) {
            return true;
        }
        if (!isset($_SESSION['authorize']["Id"]) and $this->isAcl('guest')) {
            return true;
        }
        if (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }
        return false;
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }

    public function loadModel($name)
    {
        $path = 'Model\\'.ucfirst($name);
        if(class_exists($path)){
            return new $path;
        }

    }


    protected function proper_parse_str($str) {
        # result array
        $arr = array();

        # split on outer delimiter
        $pairs = explode('&', $str);

        # loop through each pair
        foreach ($pairs as $i) {
            # split into name and value
            list($name,$value) = explode('=', $i, 2);

            # if name already exists
            if( isset($arr[$name]) ) {
                # stick multiple values into an array
                if( is_array($arr[$name]) ) {
                    $arr[$name][] = $value;
                }
                else {
                    $arr[$name] = array($arr[$name], $value);
                }
            }
            # otherwise, simply stick it in a scalar
            else {
                $arr[$name] = $value;
            }
        }

        # return result array
        return $arr;
    }

}