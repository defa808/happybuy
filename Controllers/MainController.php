<?php
include '../Model/Apartment.php';
include '../Model/User.php';
include_once 'SQL.php';
include_once '../Model/SQLBuilder/SQLBuilder.php';
include_once '../Model/Room.php';
include_once '../Model/Metro.php';
include_once '../Model/AreaLocation.php';

function connectDB()
{
    $host = '127.0.0.1';
    $db = 'happybuy';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    return $pdo;
}

function initModel()
{
//    $pdo = connectDB();
//    $query = $pdo->query('SELECT *, arealocation.Text as areaLocationText, metro.Text as metroText FROM ((apartments INNER JOIN metro on apartments.metro_Id = metro.Id) INNER Join arealocation on arealocation.id = areaLocation_Id)');
//    $query->setFetchMode(PDO::FETCH_CLASS, "Apartment");
//    $items = $query->fetchAll();

    $items = Apartment::takeAll();
    foreach ($items as $item) {
        $item->include(new Room)->include(new Metro)->include(new AreaLocation);
    }
    return $items;
}

function initUsersOnlyLogin()
{
    $pdo = connectDB();
    $query = $pdo->query("SELECT login FROM users");
//    $query->setFetchMode(PDO::FETCH_CLASS, "User");
    $users = $query->fetchAll();
    return $users;
}

function AddUser($user)
{
    $sqlBuilder = new SQLBuilder();
    $sqlBuilder->table("users");
    $sqlBuilder->insert(array("login" => $user['login'], "email" => $user['email'], "password" => $user["password"]));
}


function signInUser($user)
{
//    if it is work, sql injection will be possible login=' OR 1=1 -- ;password='
//    $pdo = connectDB();
//    return $pdo->query("SELECT * FROM users WHERE login='{$user['login']}' AND password='{$user['password']}'")->fetch();

    $login = htmlentities($user['login']);
    $password = htmlentities($user['password']);
    $sqlBuilder = new SQLBuilder();
    $res = $sqlBuilder->table("users")->where("login","=",$login)->where("password","=",$password)->get();
    return $res;
}
/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 17:06
 */