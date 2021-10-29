<?php

function get_user_by_email ($email, $pdo) {
    $sth = $pdo->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
    $sth->bindParam(":userEmail", $email);
    $sth->execute();

    $mail = $sth->fetch(PDO::FETCH_ASSOC);

    return $mail;
}


function add_user ($email, $password, $pdo) {
    $sth = $pdo->prepare("INSERT INTO `users` SET `userEmail` = :userEmail, `userPassword` = :userPassword");
    $sth->execute(array('userEmail' => $email, 'userPassword' => $password));

}


function set_flash_message($key, $message) {
    $_SESSION[$key] = $message;
}

function display_flash_message($key) {
    if (isset($_SESSION[$key])) {
        echo $_SESSION[$key];
        unset($_SESSION[$key]);
    }
}


function redirect_to ($path) {
    header('Location: ' . $path);
    die();
}


function login ($email, $password, $pdo) {

    $user = get_user_by_email($email, $pdo);

    if ($user == false) {
        return false;
    }

    $userEmail = $user['userEmail'];
    $userPassword = $user['userPassword'];

    if ($userPassword == $password) {
        $_SESSION['isAuth'] = true;
        $_SESSION['email'] = $userEmail;
        return true;
    }
    return false;
}


function isAuth() {
    if (isset($_SESSION["isAuth"])) {
        return $_SESSION["isAuth"];
    }
    else return false;
}

function isAdmin ($email, $pdo) {
    $user = get_user_by_email($email, $pdo);
    $role = $user['role'];

    if ($role == 1) {
        return true;
    }
    return false;
}


function getAllUsers ($pdo) {

    $sth = $pdo->prepare("SELECT * FROM `users` ORDER BY `userId`, `userEmail`, `userPassword`, `name`, `job`, `phone`, `adress`, `status`, `avatar`, `role`");
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $array;
}










