<?php

namespace Controllers;

use core\Controller;
use core\DataLib\SQLBuilder;
use Model\Account;
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
        $vars = [];
        if (!empty($_POST)) {
            $data = $_POST;

            $errors = array();
            if ($this->model->validate(['login', 'email', 'password', 'password2'], $data, $errors)) {
                try {

                    $this->model->register($data);
                    $user = Account::findByLogin($data['login']);
                    $_SESSION["authorize"] = (array)$user;
                    header('Refresh: 0; URL=main');

                } catch (PDOException $e) {
                    echo "<p style='color:red' >Something go wrong. Call your young hacker.</p>";
                    exit();
                }
            }
            $vars = ['data' => $data, 'errors' => $errors];
        }
        $this->view->layout = null;
        $this->view->render("Регістрація", $vars);

    }

    public function confirmAction(){
        if(!$this->model->checkTokenExists($this->route['token'])){
           $this->view->errorCode(403);
        }
        $this->model->activate($this->route['token']);
        $this->view->render('Регистрация успешна');
    }







}