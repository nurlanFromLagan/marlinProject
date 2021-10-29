<?php

function get_user_by_email ($email, $pdo) {
    $sth = $pdo->prepare("SELECT * FROM registration WHERE userEmail=:userEmail");
    $sth->bindParam(":userEmail", $email);
    $sth->execute();

    $mail = $sth->fetch(PDO::FETCH_ASSOC);

    return $mail;
}


function add_user ($email, $password, $pdo) {
    $sth = $pdo->prepare("INSERT INTO `registration` SET `userEmail` = :userEmail, `userPassword` = :userPassword");
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

    $userPassword = $user['userPassword'];

    if ($userPassword == $password) {
        return true;
    }
    return false;
}











