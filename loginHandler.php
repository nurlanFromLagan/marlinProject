<?php
require 'functions.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];




$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

if (login($email, $password, $pdo)) {

    //проверяю авторизовн ли пользователь
    if (!isAuth()) {
        set_flash_message('message', 'Пользователь не авторизован!');
        redirect_to('view/page_login.php');
    }

    $_SESSION['currentUser'] = $email; //обозначил текущего пользователя
    $_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке
    $_SESSION['admin'] = isAdmin($email, $pdo); //проверка на админа
    redirect_to('view/users.php');
} else {

    set_flash_message('message', 'Неправильный логин или пароль');
    redirect_to('view/page_login.php');
}











