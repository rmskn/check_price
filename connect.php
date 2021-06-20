<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'check_price');

    if (!$connect) {
        die('Ошибка подключения к базе данных!');
    }

?>