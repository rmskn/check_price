<?php
    session_start();

    // $ch = curl_init();
    //  curl_setopt($ch, CURLOPT_URL, $_POST['findhref']);
    //  curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //  $html = curl_exec($ch);
    //  curl_close($ch);

    //  echo $html;

    //  die();

    require 'functions.php';
    require 'connect.php'; 
    

    $href = $_POST['findhref'];
    $ans = check_href($href, NULL);

    if ($ans==0)
    {
        $_SESSION['find-error'] = 'Данный магазин пока не поддерживается или ссылка некорректна';
        header('Location: /search.php');
        echo "Данный магазин пока не поддерживается или ссылка некорректна <br/>";
        die();
    }

    switch (check_url_database($href, 0))
    {
        case 0:
        case 1:
            {
                $res1 = mysqli_query($connect, "select price, title, image from tracking where url='$href'");
                $res1 = mysqli_fetch_row($res1);
                $data = array($res1[0],$res1[1],$res1[2],$href);
                break;
            } 
        case 2:
            {
                $data = get_all_by_xpath($href);
                break;
            }
    }

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


?>