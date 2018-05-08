<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 20:04
 */

namespace core;

use core\View;

class Controller
{
    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        if(!$this->checkAcl()){
            View::errorCode(403);
        }
        $this->view = new View($route);
    }

    public function checkAcl()
    {
        $this->acl = require 'acl/' . $this->route['controller'] . '.php';
        if ($this->isAcl('all')) {
            return true;
        }
        if (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
            return true;
        }
        if (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
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

}