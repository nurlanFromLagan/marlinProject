<?php

require 'functions.php';
session_start();

$id = $_GET['id'];

$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

$pdo = new PDO('mysql:dbname=marlinproject;host=localhost', 'root', '');

editSecurity($pdo, $email, $password, $id);
redirect_to('view/users.php');

