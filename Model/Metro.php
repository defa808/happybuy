<?php

/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 05.05.2018
 * Time: 16:43
 */

include_once "IEntityDatabase.php";
include_once "SQLBuilder/ORM.php";

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
        return false;

    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property))
            return $this->$property = $value;
        return false;
    }

    public static function NameInDatabase()
    {
        return "Metro";
    }
}