<?php

namespace Controllers;

use core\Controller;
use core\DataLib\SQLBuilder;
use Model\User;
use PDOException;

class AccountController extends Controller
{
    public function loginAction()
    {
        $data = $_POST;
        $this->checkLogIn($data);
        $vars = [
            "data" => $data
        ];
        $this->view->layout = null;
        $this->view->render("Вхід", $vars);
    }
    private function checkLogIn($data)
    {
        $errors = array();

        if (isset($data['do_signin'])) {

            if (trim($data['login']) == '') {
                $errors[] = "Input login";
            }

            if (trim($data['password']) == '') {
                $errors[] = "Input password";
            }

            $user = $this->signInUser($data);

            if ($user == null) {
                $errors[] = "Wrong login or password";
            }

            if (empty($errors)) {
                $_SESSION['authorize'] = $user;
                header('Refresh: 0; URL=main');
            } else {
                echo "<p style='color:red' >" . array_shift($errors) . "</p>";
            }

        }

    }
    private function signInUser($user)
    {
//    if it is work, sql injection will be possible login=' OR 1=1 -- ;password='
//    $pdo = connectDB();
//    return $pdo->query("SELECT * FROM users WHERE login='{$user['login']}' AND password='{$user['password']}'")->fetch();

        $login = htmlentities($user['login']);
        $password = htmlentities($user['password']);
        $sqlBuilder = new SQLBuilder();
        $res = $sqlBuilder->table("users")->className("User")->where("login", "=", $login)->where("password", "=", $password)->get();
        return $res;
    }

    public function registrationAction()
    {
        $data = $_POST;
        $this->checkRegistration($data);
        $this->view->layout = null;
        $this->view->render("Регістрація");
    }
    private function checkRegistration($data)
    {

        if (isset($data['do_signup'])) {
            $errors = array();

            $data['login'] = strip_tags($_POST['login']);
            $data['email'] = strip_tags($_POST['email']);
            $data['password'] = strip_tags($_POST['password']);
            $data['password2'] = strip_tags($_POST['password2']);


            if (trim($data['login']) == '') {
                $errors[] = "Input login";
            }
            if (trim($data['email']) == '') {
                $errors[] = "Input email";
            }
            if (trim($data['login']) == '') {
                $errors[] = "Input login";
            }
            if (trim($data['password']) == '') {
                $errors[] = "Input password";
            }
            if (trim($data['password2']) == '') {
                $errors[] = "Input password again";
            }

            if ($data['password'] != $data['password2']) {
                $errors[] = "Passwords are not the same";
            }

            if (User::findByLogin($data['login']))
                $errors[] = "The same login is exist";


            if (strcmp($data['login'], htmlentities($data["login"])) != 0 || strcmp($data['email'], htmlentities($data["email"])) != 0
                || strcmp($data['password'], htmlentities($data["password"])) != 0) {
                $errors[] = 'Attention! Updated your data';
            }


            if (empty($errors)) {
                try {
                    $user = new User();
                    $user->login = $data['login'];
                    $user->password = $data['password'];
                    $user->email = $data['email'];
                    User::create($user);
                    $user = User::findByLogin($data['login']);
                    $_SESSION["authorize"] = (array)$user;
                    header('Refresh: 0; URL=main');

                } catch (PDOException $e) {
                    echo "<p style='color:red' >Something go wrong. Call your young hacker.</p>";
                }


            } else {
                echo "<p style='color:red' >" . array_shift($errors) . "</p>";
            }

        }


    }
}