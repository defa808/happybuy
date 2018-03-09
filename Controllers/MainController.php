<?php
include '../Model/Offer.php';
include '../Model/User.php';

function connectDB()
{
    $host = '127.0.0.1';
    $db = 'happybuy';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo;
}

function initModel()
{

    $pdo = connectDB();
    $query = $pdo->query('SELECT *, arealocation.Text as areaLocation, metro.Text as metro FROM ((apartment INNER JOIN metro on apartment.metro_Id = metro.Id) INNER Join arealocation on arealocation.id = areaLocation_Id)');
    $query->setFetchMode(PDO::FETCH_CLASS, "Offer");

    $items = $query->fetchAll();
    return $items;
}

function initUsers()
{
    $pdo = connectDB();
    $query = $pdo->query("SELECT * FROM users");
    $query->setFetchMode(PDO::FETCH_CLASS, "User");
    $users = $query->fetchAll();
    return $users;
}

function initUsersOnlyLogin()
{
    $pdo = connectDB();
    $query = $pdo->query("SELECT login FROM users");
    $query->setFetchMode(PDO::FETCH_CLASS, "User");
    $users = $query->fetchAll();
    return $users;
}

function AddUser($user)
{
    $pdo = connectDB();

    $query = $pdo->prepare("INSERT INTO users(login, email, password) VALUES (:login, :email, :password)");
    $query->bindParam(':login', htmlentities($user['login']));
    $query->bindParam(':email', htmlentities($user['email']));
    $query->bindParam(':password', htmlentities($user['password']));
    $query->execute();
}


/**
 * Created by PhpStorm.
 * User: alexg
 * Date: 25.02.2018
 * Time: 17:06
 */