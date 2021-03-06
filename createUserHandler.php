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

$currentUser = get_user_by_email($email, $pdo);//получаю данные нынешнего пользователя

//далее добавляю аватар пользователя
$imageName = time() . $_FILES['image']['name']; //конкатенирую с функцией time() и получается уникальное имя картинки

if (move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageName)) {

    uploadImage($pdo, $currentUser['userId'], $imageName);//загружаю название аватара в бд
}


$_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке, чтобы новый пользователь в списке пользвателей появился первым сверху
$_SESSION['user'] = get_user_by_email($email, $pdo); //массив с данными текущего пользователя
set_flash_message('message', 'Пользователь успешно добавлен!');
redirect_to("view/users.php");














