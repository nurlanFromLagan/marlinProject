<?php

require 'functions.php';
session_start();


$name = $_POST['name'];
$job = $_POST['job'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];

$email = $_POST['email'];
$password = $_POST['password'];

$vkontate = $_POST['vkontakte'];
$telegram = $_POST['telegram'];
$instagram = $_POST['instagram'];



$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

//Проверяю существует ли пользователь в бд
if (get_user_by_email($email, $pdo)) {
    set_flash_message('message', 'Пользователь уже существует');
    redirect_to("view/create_user.php");
}

//Добаляю пользователя от имени админа
addUserByAdmin($pdo, $email, $password, $name, $job, $phone, $adress);
$_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке, чтобы новый пользователь в списке пользвателей появился первым сверху
set_flash_message('message', 'Пользователь успешно добавлен!');
redirect_to("view/users.php");














