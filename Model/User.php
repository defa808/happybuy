<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 07.03.2018
 * Time: 1:24
 */

namespace Model;

use core\DataLib\ORM;

class User extends ORM
{
    public $login;
    public $email;
    public $password;

    public function __construct()
    {

    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            return $this->$property = $value;
        return null;

    }

    static function getNameInDatabase()
    {
       return 'users';
    }
}