<?php

//функция для получения пользователя из БД по почте
function get_user_by_email ($email, $pdo) {
    $sth = $pdo->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
    $sth->bindParam(":userEmail", $email);
    $sth->execute();

    $mail = $sth->fetch(PDO::FETCH_ASSOC);

    return $mail;
}


//функция для добавления пользователя при регистрации
function add_user ($email, $password, $pdo) {
    $sth = $pdo->prepare("INSERT INTO `users` SET `userEmail` = :userEmail, `userPassword` = :userPassword");
    $sth->execute(array('userEmail' => $email, 'userPassword' => $password));

}

//функкция устанавливает флэш сообщение
function set_flash_message($key, $message) {
    $_SESSION[$key] = $message;
}

//функция показывает установелнное флэш сообщение
function display_flash_message($key) {
    if (isset($_SESSION[$key])) {
        echo $_SESSION[$key];
        unset($_SESSION[$key]);
    }
}

//функция делает редирект по указанному пути
function redirect_to ($path) {
    header('Location: ' . $path);
    die();
}


//функция авторизации
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


//функция проверяет авторизован ли пользователь
function isAuth() {
    if (isset($_SESSION["isAuth"])) {
        return $_SESSION["isAuth"];
    }
    else return false;
}

//функция проверяет пользователь Админ или обычный пользователь
function isAdmin ($email, $pdo) {
    $user = get_user_by_email($email, $pdo);
    $role = $user['role'];

    if ($role == 1) {
        return true;
    }
    return false;
}


//функция для получения всех пользователей из БД
function getAllUsers ($pdo) {

    $sth = $pdo->prepare("SELECT * FROM `users` ORDER BY `userId`");
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $array;
}


//функция для добавления пользователя от имени администратора
function addUserByAdmin ($pdo, $email, $password, $name, $job, $phone, $adress) {

    $sth = $pdo->prepare("INSERT INTO `users` SET `userEmail` = :userEmail, `userPassword` = :userPassword, `name` = :name, `job` = :job, `phone` = :phone, `adress` = :adress");
    $sth->execute(array('userEmail' => $email, 'userPassword' => $password, 'name' => $name, 'job' => $job, 'phone' => $phone, 'adress' => $adress));
}


//функция возвращает данные пользователя по id (id в бд)
function getUserById ($id, $pdo) {

    $sth = $pdo->prepare("SELECT * FROM users WHERE userId=:userId");
    $sth->bindParam(":userId", $id);
    $sth->execute();

    $user = $sth->fetch(PDO::FETCH_ASSOC);

    return $user;
}


//функция для изменения данных Редактировать:Общая информация
function edit ($pdo, $name, $job, $phone, $adress, $id) {

    $sth = $pdo->prepare("UPDATE `users` SET `name` = :name, `job` = :job, `phone` = :phone, `adress` = :adress WHERE `userId` = :userId");
    $sth->execute(array('name' => $name, 'job' => $job, 'phone' => $phone, 'adress' => $adress, 'userId' => $id));
}


//функция для изменения данных в Безопасность
//function editSecurity ($pdo, $email, $password,  $id) {
//
//    $sth = $pdo->prepare("UPDATE `users` SET `email` = :email, `password` = :password WHERE `userId` = :userId");
//    $sth->execute(array('emailUser' => $email, 'userPassword' => $password, 'userId' => $id));
//}



//ф-я для изменения пароля по id
function changePasswordById ($pdo, $id, $password) {

    $sth = $pdo->prepare("UPDATE `users` SET `userPassword` = :userPassword WHERE `userId` = :userId");
    $sth->execute(array('userPassword' => $password, 'userId' => $id));
}


//ф-я для изменения email по id
function changeEmailById ($pdo, $id, $email) {

    $sth = $pdo->prepare("UPDATE `users` SET `userEmail` = :userEmail WHERE `userId` = :userId");
    $sth->execute(array('userEmail' => $email, 'userId' => $id));
}


//ф-я для удаления пользователя
function deleteUserById ($pdo, $id) {

    $sth = $pdo->prepare("DELETE FROM `users` WHERE `userId` = :userId");
    $sth->execute(array('userId' => $id));
}


//ф-я для загрузки аватара
function uploadImage ($pdo, $id, $image) {

    $sth = $pdo->prepare("UPDATE `users` SET `avatar` = :avatar WHERE `userId` = :userId");
    $sth->execute(array('avatar' => $image, 'userId' => $id));
}


