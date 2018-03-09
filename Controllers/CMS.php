<?php

//Singleton
class  CMS
{
    use Singleton;

    public function get(){

    }

}


trait Singleton
{
    protected static $instance;

    protected function __construct()
    {
        static::setInstance($this);
    }

    final public static function setInstance($instance)
    {
        static::$instance = $instance;
        return static::$instance;
    }

    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }
}

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 18:15
 */