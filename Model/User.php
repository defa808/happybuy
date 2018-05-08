<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 07.03.2018
 * Time: 1:24
 */

namespace Model;

use core\DataLib\ORM;
use core\DataLib\SQLBuilder;

class User extends ORM
{
    public $Id;
    public $login;
    public $email;
    public $password;

    public static function findByLogin($login)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(User::class);
        $user = $db->where('login', '=', $login)->get();

        if ($user) {
            return $user;
        }
        return false;

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