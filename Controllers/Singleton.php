<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 26.03.2018
 * Time: 12:31
 */

trait Singleton
{
    protected static $instance;

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