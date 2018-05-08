<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 23:46
 */



?>

<h1>Войдите</h1>
<form action="checkLogin" method="POST">
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



