<h2>Регистрация</h2>
<link href="Content/account.css" rel="stylesheet"/>
<link href="Content/bootstrap.min.css" rel="stylesheet"/>
<form action="registration" method="POST">

    <small class="form-text text-muted" ><?=$errors[0] ?? ""?></small>

    <div class="form-group">
        <label for="email"><b>Email address</b></label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $data['email'] ?? ""; ?>">
        <small id="emailHelp" class="form-text text-muted"><?= $errors['email'] ?? "" ?></small>
    </div>
    <div class="form-group">
        <label for="login"><b>Login</b></label>
        <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" placeholder="Enter login" value="<?= $data['login'] ?? ""; ?>">
        <small id="loginHelp" class="form-text text-muted"><?= $errors['login'] ?? "" ?></small>
    </div>

    <div class="form-group">
        <label for="password"><b>Password</b></label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter password" value="<?= $data['password'] ?? ""; ?>">
        <small id="passwordHelp" class="form-text text-muted"><?= $errors['password'] ?? "" ?></small>
    </div>

    <div class="form-group">
        <label for="password2"><b>Password confirm</b></label>
        <input type="password" class="form-control" id="password2" name="password2" aria-describedby="password2Help" placeholder="Enter password confirm" value="<?= $data['password2'] ?? ""; ?>">
        <small id="password2Help" class="form-text text-muted"><?= $errors['password2'] ?? "" ?></small>
    </div>


<!--    <p>-->
<!--        <strong>Ваш логин:</strong>-->
<!--        <input type="text" name="login" value="--><?//= $data['login'] ?? ""; ?><!--">-->
<!--        <br/><small style="color:red;">--><?//= $errors['login'] ?? "" ?><!--</small>-->
<!--    </p>-->
<!--    <p>-->
<!--        <strong>Ваш email</strong>-->
<!--        <input type="email" name="email" value="--><?//= $data['email'] ?? ""; ?><!--">-->
<!--        <br/><small style="color:red;">--><?//= $errors['email'] ?? "" ?><!--</small>-->
<!---->
<!---->
<!--    </p>-->
<!--    <p>-->
<!--        <strong>Ваш пароль:</strong>-->
<!--        <input type="password" name="password">-->
<!--        <br/><small style="color:red;">--><?//= $errors['password'] ?? "" ?><!--</small>-->
<!---->
<!---->
<!--    </p>-->
<!--    <p>-->
<!--        <strong>Повторите пароль:</strong>-->
<!--        <input type="password" name="password2">-->
<!--        <br/><small style="color:red;">--><?//= $errors['password2'] ?? "" ?><!--</small>-->
<!---->
<!---->
<!--    </p>-->
    <p>
        <button name="do_signin">Войти</button>
        <button type="submit" name="do_signup">Зарегестрироваться</button>
    </p>

</form>
