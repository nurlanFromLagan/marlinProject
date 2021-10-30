<?php

require 'functions.php';
session_start();

$id = $_GET['id'];
$name = $_POST['name'];
$job = $_POST['job'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];



$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

edit($pdo, $name, $job, $phone, $adress, $id);//изменяю данные в бд

$_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке
redirect_to('view/users.php');







