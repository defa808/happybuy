<link href="Content/bootstrap.css" rel="stylesheet"/>


<h1>Войдите</h1>

<form action="login" method="POST">

    <div class="form-group">
        <label for="login"><b>Логін:</b></label>
        <input type="text" class="form-control" id="login" name="login" placeholder="Enter login"
               value="<?= $data['login'] ?? ""; ?>">
    </div>
    <div class="form-group">
        <label for="password"><b>Пароль:</b></label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>

    <button type="submit" class="btn btn-info" name="do_signin">Увійти</button> <a href="account/recovery">Забули пароль? </a>
    <br/>
    <a href="registration">Зареєструватися</a>

</form>



