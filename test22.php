<?php
session_start();
$num = $_SESSION['message'];

if ($_SESSION['message'] == 1) {
    print_r('Good1');
    unset($_SESSION['message']);
} else {
    print_r('Baaaad!');
}




