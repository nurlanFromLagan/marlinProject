<?php
require 'functions.php';
session_start();

$a = $_FILES;

if (move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $_FILES['image']['name'])) {
    $_SESSION['avatar'] = 'images/' . $_FILES['image']['name'];
    redirect_to('view/media.php');
} else {
    echo 'Файл НЕ скопирован на сервер';
}




