<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 23:46
 */


session_start();
include_once "../Controllers/MainController.php";

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

    $user = \Controllers\MainController::signInUser($data);

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



