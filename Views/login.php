<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 23:46
 */
session_start();
include "../Controllers/MainController.php";
$_users = initUsers();

$data = $_POST;
$errors = array();
if (isset($data['do_signup'])) {
    header('Refresh: 0; URL=signup.php');
}
if (isset($data['do_signin'])) {

    if (trim($data['login']) == '') {
        $errors[] = "Input login";
    }

    if (trim($data['password']) == '') {
        $errors[] = "Input password";
    }

    $key = array_search($data['login'], array_column($_users, "login"));

    if ($key === false) {
        $errors[] = "Wrong login";
    } else {
        if ((int)$data['password'] != (int)$_users[$key]->password) {
            var_dump($_users);
            $errors[] = "Wrong password";
        }

    }


    if (empty($errors)) {
        $_SESSION["currentUser"] = $data;
        header('Refresh: 0; URL=main.php');
    } else {
        echo "<p style='color:red' >" . array_shift($errors) . "</p>";
    }

}
?>
<h1>Войдите</h1>
<form action="login.php" method="POST">
    <p>
        <strong>Ваш логин:</strong>
        <input type="text" name="login" value="<?= $data['login'] ?? ""; ?>">
    </p>
    <p>
        <strong>Ваш пароль:</strong>
        <input type="password" name="password">
    </p>
    <p>
        <button type="submit" name="do_signin">Войти</button>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>

</form>



