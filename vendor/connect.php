<?php
$agent = "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)";
ini_set('user_agent', $agent);
ini_set('display_errors', 0);


$connect = mysqli_connect('localhost', 'root', 'root', 'check_price');

if (!$connect) {
    $connect = mysqli_connect('localhost', 'root', 'erosab49', 'check_price');
}

if (!$connect) {
    die('Ошибка подключения к базе данных!');
}

?>