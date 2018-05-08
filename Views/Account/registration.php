<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 23:48
 */

//$_users = initUsersOnlyLogin();
$data = $_POST;

if (isset($data["do_signin"]))
    header('Refresh: 0; URL=login.php');

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
//    if(array_search($data['login'], array_column($_users, "login" )) == true)

    if (array_search($data['login'], $_users) == true)
        $errors[] = "The same login is exist";


    if (strcmp($data['login'], htmlentities($data["login"])) != 0 || strcmp($data['email'], htmlentities($data["email"])) != 0
        || strcmp($data['password'], htmlentities($data["password"])) != 0) {
        $errors[] = 'Attention! Updated your data';
    }


    if (empty($errors)) {
        try {
            AddUser($data);
            $_SESSION["currentUser"] = $data;
            header('Refresh: 0; URL=index.php');

        } catch (PDOException $e) {
            echo "<p style='color:red' >Something go wrong. Call support yong hacker.</p>";
        }


    } else {
        echo "<p style='color:red' >" . array_shift($errors) . "</p>";
    }

}
?>
<h2>Регистрация</h2>
<form action="checkRegistration" method="POST">
    <p>
        <strong>Ваш логин:</strong>
        <input type="text" name="login" value="<?= $data['login'] ?? ""; ?>">
    </p>
    <p>
        <strong>Ваш email</strong>
        <input type="email" name="email" value="<?= $data['email'] ?? ""; ?>">
    </p>
    <p>
        <strong>Ваш пароль:</strong>
        <input type="password" name="password">
    </p>
    <p>
        <strong>Повторите пароль:</strong>
        <input type="password" name="password2">
    </p>
    <p>
        <button name="do_signin">Войти</button>
        <button type="submit" name="do_signup">Зарегестрироваться</button>
    </p>

</form>
