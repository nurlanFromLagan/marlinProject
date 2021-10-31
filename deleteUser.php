<?php

require 'functions.php';
session_start();


$id = $_GET['id'];

$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');


deleteUserBuId($pdo, $id);//удаляю пользователя

$_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке
set_flash_message('delete', 'Пользователь успешно удален!');
redirect_to('view/users.php');










