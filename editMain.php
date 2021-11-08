<?php

//Это промежуточный файл(обработчик), в котором я получаю данные с ссылок Редактировать:Общая информация и Безопасность
//если $num==1, то редирект на Редактировать:Общая информация
//если $num==2, то редирект на Безопасность

require 'functions.php';
session_start();

//id пользователя
$id = $_GET['id'];

//для обозначения
$num = $_GET['num'];

$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

//загружаю в сессию данные о пользователе
$_SESSION['user'] = getUserById($id, $pdo);


if ($num == 1) {
    redirect_to('view/edit.php');
} elseif ($num == 2) {
    redirect_to('view/security.php');
} elseif ($num == 3) {
    redirect_to('view/media.php');
}















