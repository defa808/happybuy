<h2>Регистрация</h2>
<link href="Content/account.css" rel="stylesheet"/>
<link href="Content/bootstrap.css" rel="stylesheet"/>
<form action="registration" method="POST">

    <small class="form-text text-muted" ><?=$errors[0] ?? ""?></small>

    <div class="form-group">
        <label for="email"><b>Електрона пошта</b></label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $data['email'] ?? ""; ?>">
        <small id="emailHelp" class="form-text text-muted"><?= $errors['email'] ?? "" ?></small>
    </div>
    <div class="form-group">
        <label for="login"><b>Логін</b></label>
        <input type="text" class="form-control" id="login" name="login" aria-describedby="loginHelp" placeholder="Enter login" value="<?= $data['login'] ?? ""; ?>">
        <small id="loginHelp" class="form-text text-muted"><?= $errors['login'] ?? "" ?></small>
    </div>

    <div class="form-group">
        <label for="password"><b>Пароль</b></label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter password" value="<?= $data['password'] ?? ""; ?>">
        <small id="passwordHelp" class="form-text text-muted"><?= $errors['password'] ?? "" ?></small>
    </div>

    <div class="form-group">
        <label for="password2"><b>Підтверждення пароля</b></label>
        <input type="password" class="form-control" id="password2" name="password2" aria-describedby="password2Help" placeholder="Enter password confirm" value="<?= $data['password2'] ?? ""; ?>">
        <small id="password2Help" class="form-text text-muted"><?= $errors['password2'] ?? "" ?></small>
    </div>

    <p>
        <button type="submit" class="btn btn-info" name="do_signup">Зареєструватися</button><br/>
        <a href="login">Аккаунт вже існує? Увійти</a>
    </p>

</form>
