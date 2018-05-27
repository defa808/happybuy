<link href="Content/bootstrap.min.css" rel="stylesheet"/>


<h1>Войдите</h1>

<form action="login" method="POST">

    <div class="form-group">
        <label for="login"><b>Ваш логин:</b></label>
        <input type="text" class="form-control" id="login" name="login" placeholder="Enter login"
               value="<?= $data['login'] ?? ""; ?>">
    </div>
    <div class="form-group">
        <label for="password"><b>Ваш пароль:</b></label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>

    <button type="submit" name="do_signin">Войти</button>
    <br/>
    <a href="registration">Зарегистрироваться</a>

</form>



