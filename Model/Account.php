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

class Account extends ORM
{
    public $Id;
    public $login;
    public $email;
    public $password;
    public $token;

    public function register($data)
    {
        $token = $this->createToken();
        $user = new Account();
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $user->email = $data['email'];
        $user->token = $token;

        Account::create($user);

        mail($data['email'], 'Register', 'Confirm: http://localhost:808/account/confirm/' . $token);

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

    public function validate($input, &$post, &$errors)
    {
        foreach ($input as $val) {
//            $post[$val] = strip_tags($post[$val]);

            if (trim($post[$val]) == '')
                $errors[$val] = "Input " . $val;
        }

        if ($post['password'] != $post['password2']) {
            $errors['password2'] = "Passwords are not the same";
        }

        if (Account::findByLogin($post['login']))
            $errors['login'] = "The same login is exist";

        if (strcmp($post['login'], htmlentities($post["login"])) != 0 ||
            strcmp($post['email'], htmlentities($post["email"])) != 0 ||
            strcmp($post['password'], htmlentities($post["password"])) != 0) {

            foreach ($input as $val) {
                $post[$val] = strip_tags($post[$val]);
            }

            $errors[] = 'Attention! Updated your data';
        }
        if (!empty($errors)) {
            return false;
        }

        return true;
    }

    public static function findByLogin($login)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
        $user = $db->where('login', '=', $login)->get();

        if ($user) {
            return $user;
        }
        return false;

    }

    public function createToken()
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
    }

    public function checkTokenExists($token)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
        $userId = $db->select("id")->where('token', '=', $token)->get();

        if ($userId != false)
            return true;
        return false;
    }

    public function activate($token)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
//        $user = $db->update(array("status" => 1, "token" => ""))->where("token", "=", $token)->exec();
        $user = $db->where("token", "=", $token)->get();
        $user->status = 1;
        $user->token = "";
        Account::update($user);


    }


    static function getNameInDatabase()
    {
        return 'users';
    }
}