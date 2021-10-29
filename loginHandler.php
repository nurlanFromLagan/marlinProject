<?php
require 'functions.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];




$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

if (login($email, $password, $pdo)) {

    redirect_to('view/users.php');
} else {

    set_flash_message('message', 'Неправильный логин или пароль');
    redirect_to('view/page_login.php');
}











