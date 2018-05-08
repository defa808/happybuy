<h1>Войдите</h1>
<form action="login" method="POST">
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



