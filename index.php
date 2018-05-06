<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 06.05.2018
 * Time: 14:49
 */
//include_once "Model/Router.php";
//include_once "Controllers/HomeController.php";

use core\Router;
use Controllers\HomeController;

spl_autoload_register(function($class){
    $path = str_replace('\\','/',$class.'.php');
    if(file_exists($path)){
        require $path;
    }
});
session_start();

class Startup{

//    protected $configuration;
//
    protected $router;

    public function __construct()
    {
//        $this->configuration = $configuration;
        $this->Configure();
        $this->Run();
    }
//
//    public function getConfiguration(){
//        return $this->configuration;
//    }
    public function Configure(){
        $this->router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

    }

    public function Run(){
        if ($this->router == null)
            throw new Exception("router is empty");

//        $this->router->executeHandler($this->router->getRequestHandler(), $this->router->getParams());

        $this->router->run();

//        var_dump($this->router);
//        if ($this->router->isFound()) {
//            $this->router->executeHandler(
//                $this->router->getRequestHandler(),
//                $this->router->getParams()
//            );
//        }
//        else {
//            // Simple "Not found" handler
//            $this->router->executeHandler(function () {
//                http_response_code(404);
//                echo '404 Not found';
//            });
//        }

    }


}

$startup = new Startup();

//$home = new HomeController();
//$home->Index();
//$startup->Run();


