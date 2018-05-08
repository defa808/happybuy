<h2>Регистрация</h2>
<form action="registration" method="POST">
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
