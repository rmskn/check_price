<?php
    session_start();

    /*
    //Это код, чтобы вывести саму страницу-донора
    $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $_POST['findhref']);
     curl_setopt($ch, CURLOPT_TIMEOUT, 15);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     $html = curl_exec($ch);
     curl_close($ch);

     echo $html;

     die();*/

    require_once 'functions.php';

    $href = $_POST['findhref'];
    $ans = check_href($href, NULL);

    if ($ans==0)
    {
        $_SESSION['find-error'] = 'Данный магазин пока не поддерживается или ссылка некорректна';
        header('Location: /search.php');
        echo "Данный магазин пока не поддерживается или ссылка некорректна <br/>";
        die();
    }

    $data = get_all_by_xpath($href);

    if ($data==false)
    {
        //Тут ошибка с капчей или не удалось считать цену
        //или сайт не доступен
        $_SESSION['find-error'] = 'Произошла непредвиденная ошибка. Попробуйте позже';
        header('Location: /search.php');
        echo 'error';
        die();
    }

    $_SESSION['finded-item'] = $data;
    header('Location: /search.php');

    echo $data[0];//price
    echo '<br/>';
    echo $data[1];//title
    echo '<br/>';
    echo '<img src="'.$data[2].'">';//image

?>