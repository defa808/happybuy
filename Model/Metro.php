<?php

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 05.05.2018
 * Time: 16:43
 */

namespace Model;

use core\DataLib\ORM;


class Metro extends ORM implements IEntityDatabase
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
        if (property_exists($this, $property))
            return $this->$property = $value;
        return null;
    }

    public static function NameInDatabase()
    {
        return "Metro";
    }
}