<?php
require 'functions.php';
session_start();



$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

$user = $_SESSION['user'];//получаю данные пользователя из сессии
$currentImage = 'images/' . $user['avatar'];//нынешняя фотография(аватар) пользователя
$imageName = time() . $_FILES['image']['name']; //конкатенирую с функцией time() и получается уникальное имя картинки(аватара)


if (move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageName)) {

    unlink($currentImage);//удаляю старую фотографию(аватар) из сервера
    uploadImage($pdo, $user['userId'], $imageName);//загружаю новое название аватара в бд

    $_SESSION['user'] = getUserById($user['userId'], $pdo); //загружаю в сессию данные о пользователе
    $_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке

    redirect_to('view/media.php');
} else {
    echo 'Файл НЕ скопирован на сервер';
}




