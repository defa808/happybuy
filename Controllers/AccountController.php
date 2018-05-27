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
        $login = htmlentities($user['login']);
        $password = htmlentities($user['password']);
        $sqlBuilder = new SQLBuilder();
        $hash = $sqlBuilder->table(Account::getNameInDatabase())->select("password")->where("login", "=", $login)->get();
        if ($hash && password_verify($password, array_shift($hash))) {
            return (array)Account::findByLogin($login);
        }
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

    public function confirmAction()
    {
        if (!$this->model->checkTokenExists($this->route['token'])) {
            $this->view->redirect('/');
        }

        $this->model->activate($this->route['token']);
        $this->view->render('Email подтвержден');
    }

    // Восстановление пароля
    public function recoveryAction() {
        if (!empty($_POST)) {
            if (!$this->model->checkEmailExists($_POST['email'])) {
                $this->view->message('error', 'Пользователь не найден');
            }
            else{
                $this->model = Account::findByEmail($_POST['email']);

                if(!$this->model->checkStatus())
                    $this->view->message('error', 'Пользователь не подтвердил почту');
                else {
                    $this->model->recovery();
                    $this->view->message('success', 'Запрос на восстановление пароля отправлен на E-mail');
                }
            }
        }
        $this->view->layout = null;
        $this->view->render('Восстановление пароля');
    }

    public function resetAction() {
        if (!$this->model->checkTokenExists($this->route['token'])) {
            $this->view->redirect('account/login');
        }
        else {
            $this->model = Account::findByToken($this->route['token']);
            $password = $this->model->reset($this->route['token']);
            $vars = [
                'password' => $password,
            ];
            $this->view->layout = null;
            $this->view->render('Пароль сброшен', $vars);
        }
    }


    //выход
    public function logOutAction()
    {
        unset($_SESSION['authorize']);
        $this->view->redirect("login");
    }


}