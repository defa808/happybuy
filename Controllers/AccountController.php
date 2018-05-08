<?php
namespace Controllers;

use core\Controller;
class AccountController extends Controller {

    public function loginAction(){
        $this->view->layout = null;
        $this->view->render("Вхід");
    }

    public function registrationAction(){
        $this->view->layout = null;
        $this->view->render("Регістрація");
    }

    public function checkRegistration(){

    }

    public function checkLogin(){

        $data = $_POST;
        $errors = array();

        if (isset($data['do_signin'])) {

            if (trim($data['login']) == '') {
                $errors[] = "Input login";
            }

            if (trim($data['password']) == '') {
                $errors[] = "Input password";
            }

            $user = $this->signInUser($data);

            if($user == null){
                $errors[] = "Wrong login or password";
            }

            if (empty($errors)) {
                $_SESSION["currentUser"] = $user;
                header('Refresh: 0; URL=index.php');
            } else {
                echo "<p style='color:red' >" . array_shift($errors) . "</p>";
            }

        }

    }

    private  function signInUser($user)
    {
//    if it is work, sql injection will be possible login=' OR 1=1 -- ;password='
//    $pdo = connectDB();
//    return $pdo->query("SELECT * FROM users WHERE login='{$user['login']}' AND password='{$user['password']}'")->fetch();

        $login = htmlentities($user['login']);
        $password = htmlentities($user['password']);
        $sqlBuilder = new SQLBuilder();
        $res = $sqlBuilder->table("users")->where("login", "=", $login)->where("password", "=", $password)->get();
        return $res;
    }


}