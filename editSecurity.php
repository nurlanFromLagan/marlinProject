<?php

require 'functions.php';
session_start();

$id = $_GET['id'];

$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

$user = getUserById(1, $pdo);
$user2 = get_user_by_email($email, $pdo);



//Проверяю введенный email на пустоту
if (empty($email)) {
    set_flash_message('security', 'Поле email не может быть пустым');
    redirect_to('view/security.php');
}


//Проверяю введенный email
if (!empty($user2) AND $id !== $user2['userId']) {
    set_flash_message('security', 'Пользователь с таким email уже существует');
    redirect_to('view/security.php');
}


//Проверяю введеный пароль на пустоту
if (!empty($password)) {
    //Проверяю подтверждение пароля
    if ($password !== $confirmPassword) {
        set_flash_message('security', 'Пароли отличаются!');
        redirect_to('view/security.php');
    }
    changePasswordById($pdo, $id, $password); //изменяю пароль
}


changeEmailById($pdo, $id, $email);//изменяю email
$_SESSION['users'] = array_reverse(getAllUsers($pdo)); //массив со всеми пользователями в обратном порядке
redirect_to('view/users.php');


