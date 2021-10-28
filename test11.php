<?php

require 'DB/Connection.php';
require 'DB/QueryBuilder.php';

use DB\query\Connection;
use DB\query\QueryBuilder;

$email = 'nukd@mm.ru';

$db = new QueryBuilder(Connection::make());
$m = $db->get_user_email($email);

if ($m === false) {
    print_r('false result');
} else {
    print_r('good');
}





