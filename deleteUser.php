<?php

require 'functions.php';
session_start();


$id = $_GET['id'];

$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');
$user = getUserById($id, $pdo);
$currentImage = 'images/' . $user['avatar'];//нынешняя фотография(аватар)

deleteUserById($pdo, $id);//удаляю пользователя
unlink($currentImage);//удаляю фотографию(аватар) из сервера

//если пользователь не админ, то после удаления профиля он переходит на страницу авторизации
if (!$_SESSION['admin']) {
    redirect_to('view/page_login.php');
}

$_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке
set_flash_message('delete', 'Пользователь успешно удален!');
redirect_to('view/users.php');










