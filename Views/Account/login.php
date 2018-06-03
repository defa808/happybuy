<link href="Content/bootstrap.css" rel="stylesheet"/>

<div class="container">
    <h1 class="mt-4 mb-3">Увійти</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/login" method="post">
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
        </div>
    </div>
</div>

