<?php
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
        echo "Данный магазин пока не поддерживается или ссылка некорректна <br/>";
        die();
    }

    $data = get_all_by_xpath($href);

    if ($data==false)
    {
        //Тут ошибка с капчей или не удалось считать цену
        //или сайт не доступен
        echo 'error';
        die();
    }

    echo $data[0];//price
    echo '<br/>';
    echo $data[1];//title
    echo '<br/>';
    echo '<img src="'.$data[2].'">';//image

?>