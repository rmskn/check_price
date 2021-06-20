<?php

$connect = mysqli_connect('localhost', 'root', 'erosab49', 'check_price');

    if (!$connect) {
        die('Ошибка подключения к базе данных!');
    }

?>