<?php
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 16:40
 */
session_start();

if ($_SESSION["currentUser"] == null) {
    header('Refresh: 1; URL=login.php');
}
$currentUser = $_SESSION["currentUser"];
$data = $_POST;

if(isset($data["exit"])){
    $_SESSION["currentUser"] = null;
    header('Refresh:1; URL=login.php');
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>HappyBuy Продажа квартир</title>
    <meta charset="utf-8"/>
    <script src="../Scripts/MainAnimation.js"></script>
    <link rel="stylesheet" href="../Content/main.css">
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
    <link href="../Content/media.css" rel="stylesheet"/>
    <link href="../Content/grid.css" rel="stylesheet"/>
    <meta name="description"
          content="Квартира дешево в Києві. Найновітніший район з дитячим майданчиком. Теплий будинок за новітнішими технологіями. "/>
    <meta name="keywords"
          content="Квартири Київ, Квартири подобово, Київ квартири подобово, Квартира посуточно,Киев квартира посуточно, Квартира киев купить,Киев кварира снять ,Квартира Киев,Квартира в киеве,Квартира аренда киев,Купить квартиру киев,Снять квартиру киев,Однокомнатная квартира,Однокомнатная квартира киев,Квартира поусточно киев,Квартира в киеве купить,Олх квартира киев,Квартира без посредников киев,Квартира долгосрочно киев,Аренда квартир киев,Сландо киев,Киев квартира на сутки"/>
    <script src="../Scripts/MainLogic.js"></script>
    <script src="../Scripts/fontawesome-all.js"></script>
</head>
<body>
<header>
    <div class="wrap_logo">
        <div class="logo">
            <img src="../images/home.png"/>
            <span class="logo-text">Happy</span><span class="logo-text">Buy</span>
        </div>
    </div>

    <div class="main_menu">
        <div class="li active"><a href="main.php">Головна</a></div>
        <div class="li"><a href="#">Пошук</a></div>
        <div class="li"><a href="#">Обрані <img src="../images/star.png"/></a></div>
    </div>

    <div class="obertka-mobile">
        <div class="image-phone"><img src="../images/mobile.png"/></div>
        <div class="number-phone"> 8 (866) 565-54-54</div>
    </div>

    <div class="welcome">
        <form method="POST">
            <span>Ласкаво просимо,</span><span><?= $currentUser['login'] ?></span>
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
