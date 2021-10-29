<?php
require 'functions.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];




$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

if (login($email, $password, $pdo)) {


    $_SESSION['currentUser'] = $email; //обозначил текущего пользователя
    $_SESSION['users'] = getAllUsers($pdo); //массив со всеми пользователями
    $_SESSION['admin'] = isAdmin($email, $pdo); //проверка на админа
    redirect_to('view/users.php');
} else {

    set_flash_message('message', 'Неправильный логин или пароль');
    redirect_to('view/page_login.php');
}











