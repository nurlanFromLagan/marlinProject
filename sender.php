<?php
//извиняюсь за беспорядок в коде, времени не хватило привести все в порядок и нормально закоментировать
require 'DB/Connection.php';
require 'DB/QueryBuilder.php';

use DB\query\Connection;
use DB\query\QueryBuilder;

function redirect_to ($path) {
    header('Location: ' . $path);
}


$email = $_POST['email'];
$password = $_POST['password'];
$data = [
    'userEmail' => $email,
    'userPassword' => $password
];


$db = new QueryBuilder(Connection::make());
$m = $db->get_user_by_email($email);

if ($m === false) {
    $db->add_user('registration', $data);
    redirect_to('view/page_login.html');
} else {

    redirect_to('view/page_register2.html');
}











