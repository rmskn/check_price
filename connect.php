<?php
ini_set('display_errors', 0);

$connect = mysqli_connect('localhost', 'root', 'root', 'check_price');

if (!$connect) {
    $connect = mysqli_connect('localhost', 'root', 'erosab49', 'check_price');
}

if (!$connect) {
    die('Ошибка подключения к базе данных!');
}

?>