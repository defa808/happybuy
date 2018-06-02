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
    public $status;
    public $roleUser_Id;


    public function register($data)
    {
        $token = $this->createToken();
        $user = new Account();
        $user->login = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $user->email = $data['email'];
        $user->token = $token;
        $user->status = 0;
        $this->roleUser_Id = 1;

        Account::create($user);

        mail($data['email'], 'Register', 'Confirm: http://localhost:808/account/confirm/' . $token);

    }

    public function initUser($data)
    {
        $this->login = strip_tags($data["login"]);
        $this->email = strip_tags($data["email"]);
        $this->password = strip_tags($data["password"]);
        $this->token = strip_tags($data["token"]);
        $this->status = strip_tags($data["status"]);
        $this->roleUser_Id = strip_tags($data["roleUser_Id"]);

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

        if (Account::checkEmailExists($post['email']))
            $errors['email'] = "The same email is exist";

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

    public static function findByEmail($email)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
        $user = $db->where('email', '=', $email)->get();

        if ($user) {
            return $user;
        }
        return false;

    }

    public static function findByToken($token)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
        $user = $db->where('token', '=', $token)->get();

        if ($user) {
            return $user;
        }
        return false;
    }

    public function checkEmailExists($email)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
        $userId = $db->select("id")->where('email', '=', $email)->get();

        if ($userId != false)
            return true;
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

    public function checkStatus()
    {
        return $this->status;
    }

    public function activate($token)
    {
        $db = new SQLBuilder();
        $table = self::getNameInDatabase();
        $db->table($table);
        $db->className(Account::class);
        $user = $db->where("token", "=", $token)->get();
        $user->status = 1;
        $user->token = "";
        Account::update($user);
    }

    public function recovery()
    {
        $this->token = $this->createToken();
        Account::update($this);
        mail($this->email, 'Recovery', 'Confirm: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/account/reset/' . $this->token);
    }

    public function reset($post)
    {
        $newPassword = $this->createToken();

        $this->password = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->token = "";

        Account::update($this);
        return $newPassword;
    }

    public function GetCRUD()
    {
        if (isset($this->Id))
            $this->include(new RoleUser());
        $rolesUsers = RoleUser::takeAll();
        ?>
        <tr>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="text" maxlength="50" name="login" class="form-control"
                           value="<?= $this->login ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="text" maxlength="100" name="email" class="form-control"
                           value="<?= $this->email ?>">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="text" maxlength="60" name="password" class="form-control"
                           value="<?= $this->password ?>" readonly="readonly">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="text" maxlength="1" name="status" class="form-control"
                           value="<?= $this->status ?>" readonly="readonly">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input form="form<?= $this->Id ?>" type="text" maxlength="1" name="token" class="form-control"
                           value="<?= $this->token ?>" readonly="readonly">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <select class="form-control" form="form<?= $this->Id ?>" name="roleUser_Id">
                        <?php foreach ($rolesUsers as $rolesUser) { ?>
                            <option
                                <?= $this->roleUser_Id == $rolesUser->Id ? "selected = 'selected'" : '' ?>
                                value="<?= $rolesUser->Id ?>"><?= $rolesUser ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <form id="form<?= $this->Id ?>" action="Admin/SaveUser" method="POST"></form>
                    <input form="form<?= $this->Id ?>"
                           type="hidden"
                           name="Id"
                           value="<?= $this->Id ?>"/>
                    <button form="form<?= $this->Id ?>"
                            onclick="saveUser('form<?= $this->Id ?>')"
                            type="button"
                            class="btn btn-info">
                        <i class="fa fa-save" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="form-group">
                    <form id="delete<?= $this->Id ?>" action="Admin/DeleteUser" method="POST"></form>
                    <input form="delete<?= $this->Id ?>"
                           type="hidden" name="Id" value="<?= $this->Id ?>"/>
                    <button form="delete<?= $this->Id ?>"
                            onclick="deleteUser('form<?= $this->Id ?>')"
                            type="button"
                            class="btn btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </td>
        </tr>


        <?php
    }



    static function getNameInDatabase()
    {
        return 'users';
    }
}