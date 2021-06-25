<?php
    //require_once 'connect.php';

    $url = 'https://www.avito.ru/saransk/avtomobili/hyundai?cd=1&radius=200';

    // создание нового ресурса cURL
    $ch = curl_init();

    // установка URL и других необходимых параметров
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 15);
    curl_setopt($ch, CURLOPT_SSL_VERYFYPEER, FALSE);

    // загрузка страницы и выдача её браузеру
    $content = curl_exec($ch);

    echo $content;

    // завершение сеанса и освобождение ресурсов
    curl_close($ch);
?>