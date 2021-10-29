<?php

require 'functions.php';

session_start();



$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');
$user = get_user_by_email($email, $pdo);

if ($user === false) {
    add_user($email, $password, $pdo);
    set_flash_message('message', 'success');
    redirect_to('view/page_login.php');
} else {

    set_flash_message('message', 'fail');
    redirect_to('view/page_register.php');
}








