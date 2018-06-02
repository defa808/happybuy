<?php

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 05.05.2018
 * Time: 16:43
 */

namespace Model;

use core\DataLib\ORM;


class Metro extends ORM
{
    protected $Id;
    protected $Text;

    public function getText()
    {
        return $this->Text;
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
        return $this->$property = $value;
    }

    public function __toString()
    {
        return (string)$this->Text;
    }

    public static function getNameInDatabase()
    {
        return "Metro";
    }
}