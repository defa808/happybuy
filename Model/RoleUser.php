<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 02.06.2018
 * Time: 13:52
 */

namespace Model;


use core\DataLib\ORM;

class RoleUser extends ORM
{

    protected $Id;
    protected $Value;

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;

    }

    public function __toString()
    {
        return (string)$this->Value;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            return $this->$property = $value;
        return null;
    }

    static function getNameInDatabase()
    {
        return 'role_users';
    }
}