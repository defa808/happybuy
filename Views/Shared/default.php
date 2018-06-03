<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 16:40
 */

$user = $_SESSION["authorize"];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="/Scripts/MainAnimation.js"></script>
    <link rel="stylesheet" href="/Content/main.css">
    <link href="/Content/media.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link href="/Content/grid.css" rel="stylesheet"/>
    <meta name="description"
          content="Квартира дешево в Києві. Найновітніший район з дитячим майданчиком. Теплий будинок за новітнішими технологіями. "/>
    <meta name="keywords"
          content="Квартири Київ, Квартири подобово, Київ квартири подобово, Квартира посуточно,Киев квартира посуточно, Квартира киев купить,Киев кварира снять ,Квартира Киев,Квартира в киеве,Квартира аренда киев,Купить квартиру киев,Снять квартиру киев,Однокомнатная квартира,Однокомнатная квартира киев,Квартира поусточно киев,Квартира в киеве купить,Олх квартира киев,Квартира без посредников киев,Квартира долгосрочно киев,Аренда квартир киев,Сландо киев,Киев квартира на сутки"/>
    <script src="/Scripts/MainLogic.js"></script>
    <script src="/Scripts/fontawesome-all.js"></script>
    <script src="/Scripts/jquery.js"></script>
</head>
<body>
<header>
    <div class="wrap_logo">
        <div class="logo">
            <img src="/images/home.png"/>
            <span class="logo-text">Happy</span><span class="logo-text">Buy</span>
        </div>
    </div>

    <div class="main_menu">
        <div class="li"><a href="/main">Головна</a></div>
        <div class="li"><a href="#">Пошук</a></div>
        <div class="li"><a href="/favourite">Обрані <img src="/images/star.png"/></a></div>
    </div>

    <div class="obertka-mobile">
        <div class="image-phone"><img src="/images/mobile.png"/></div>
        <div class="number-phone"> 8 (866) 565-54-54</div>
    </div>

    <div class="welcome">
        <span>Ласкаво просимо,</span><span><?= $user['login'] ?></span>
        <?= isset($_SESSION["admin"]) ? "<a href='/admin'><button class='btn-exit' >Адмінка</button></a>" : "" ?>
        <form class='logoutForm' method="POST" action="/logout">
            <button name="exit" class="btn-exit">Вихід</button>
        </form>
    </div>


</header>

<div class="menu">

    <ul>
        <li class="li-menu"><a href="#" id="active_menu">Квартири</a></li>
        <li class="li-menu"><a href="#"> Акції</a></li>
        <li class="li-menu"><a href="#"> Будівництво</a></li>
        <li class="li-menu"><a href="#"> Новини</a></li>
        <li class="li-menu"><a href="#"> Контакти</a></li>
    </ul>
    <div class="language">
        <a href="#">укр</a>
        <a href="#">eng</a>
    </div>
</div>

<div class="menu" id="menu-mobile">
    <input type="checkbox" id="nav-toggle"/>
    <label for="nav-toggle" class="nav-toggle"><i id="button-for-menu" class="fa fa-bars"></i></label>
    <div id="menu-items">
        <ul id="ullistmenu">
            <li class="li-menu"><a href="#" id="active_menu">Квартири</a></li>
            <li class="li-menu"><a href="#"> Акції</a></li>
            <li class="li-menu"><a href="#"> Будівництво</a></li>
            <li class="li-menu"><a href="#"> Новини</a></li>
            <li class="li-menu"><a href="#"> Контакти</a></li>
        </ul>
        <div id="language">
            <hr/>
            <div><a href="#">укр</a></div>
            <div><a href="#">eng</a></div>
        </div>
    </div>
</div>

<?php echo $content; ?>

<footer>
    <div class="logo">
        <img src="/images/home.png"/>
        <span class="logo-text">Happy</span><span class="logo-text">Buy</span>
        <div id="copyright"> © Copyright 2017 <br/>Усі права захищені</div>
    </div>

    <div class="map">
        <ul>
            <li><a href="#">Головна</a></li>
            <li><a href="#">Пошук</a></li>
            <li><a href="#">Обрані</a></li>
        </ul>

        <ul>
            <li><a href="#">Про нас</a></li>
            <li><a href="#">Застосування</a></li>
            <li><a href="#">Наш розвиток</a></li>
            <li><a href="#">Гарантії</a></li>
        </ul>

        <ul>
            <li><a href="#">Подарункові сертифікати</a></li>
            <li><a href="#">Умови використання сайта</a></li>
            <li><a href="#">Проблеми з замовленням</a></li>
            <li><a href="#">Питання та відповіді</a></li>
        </ul>
    </div>

    <div class="mobile-version">
        Мобільна версія <img class="mobileImg" src="/images/telephone.png"/>
    </div>

    <div class="feedback">
        Зворотній зв'язок <span>8 (866) 565-54-54</span>
        <form>
            <input id="number-feedback" type="text" name="number" placeholder="Номер телефону*:"/>
            <input id="button-feedback" type="button" name="button-feedback" value="Перезвонити"/>
        </form>
        <img src="/images/facebook.png"/>
        <img src="/images/vk.png"/>
    </div>
    <div class="year">Створено в 2017<br/>Гавриляк Олександр</div>
</footer>

</body>
</html>