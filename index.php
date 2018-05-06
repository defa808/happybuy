<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 14:49
 */

use core\Router;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});
session_start();

class Startup
{

    protected $router;

    public function __construct()
    {
        $this->Configure();
        $this->Run();
    }

    public function Configure()
    {
        $this->router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    }

    public function Run()
    {
        if ($this->router == null)
            throw new Exception("router is empty");
        $this->router->run();
    }


}

$startup = new Startup();


