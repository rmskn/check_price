<?php
    session_start();
    require 'connect.php';
    require 'functions.php';

    $url = $_SESSION['finded-item'][3];
    $price = $_SESSION['finded-item'][0];
    $title = $_SESSION['finded-item'][1];
    $image = $_SESSION['finded-item'][2];

    $login = $_SESSION['authorization-login'];

    $current_date = date('m/d/Y h:i:s a', time());
    $last_update = $current_date;

    $user_id = mysqli_query($connect, "select id from users where login = '$login'");
    $user_id = mysqli_fetch_row($user_id);
    $user_id = $user_id[0];

    $anwer = 'ccc';

    switch (check_url_database($url, $user_id)) {
        case 0://full matching (user have this track)
            $answer = 'Данный товар уже отслеживается Вами';
            break;
        case 1://mathcing (track in db)
            mysqli_begin_transaction($connect);

            try {
                
                $track_id = mysqli_query($connect, "select id from tracking where url = '$url'");
                $track_id = mysqli_fetch_row($track_id);
                $track_id = $track_id[0];

                mysqli_query($connect, "INSERT INTO user_tracking(track, user) VALUES ('$track_id','$user_id')");
        
                mysqli_commit($connect);
                $answer = 'Успешно!';

            } catch (mysqli_sql_exception $exception) {
                mysqli_rollback($connect);
            
                $answer = 'Произошла ошибка транзакции. Повторите попытку позже. Код ошибки (new_track_case1_1)';
                throw $exception;
            }
        
            break;
        case 2://no matching (new track)
            mysqli_begin_transaction($connect);

            try {
                mysqli_query($connect, "insert into tracking(url, price, title, image, date_creating, date_update) values ('$url', '$price', '$title', '$image', NOW(), NOW())");
            
                $track_id = mysqli_query($connect, "select id from tracking where url = '$url'");
                $track_id = mysqli_fetch_row($track_id);
                $track_id = $track_id[0];

                mysqli_query($connect, "INSERT INTO user_tracking(track, user) VALUES ('$track_id','$user_id')");
            
                mysqli_commit($connect);
                $answer = 'Успешно!';

            } catch (mysqli_sql_exception $exception) {
                mysqli_rollback($connect);
                $answer = 'Произошла ошибка транзакции. Повторите попытку позже. Код ошибки (new_track_case1_2)';
                throw $exception;
            }
            break;
        }

    $_SESSION['alert'] = $answer;
    header('Location: /lk.php');
    echo $answer;

    //ТУТ НАДО ПЕРЕСЫЛАТЬ В ЛК ВО ВКЛАДКУ МОИ ТОВАРЫ И ВЫВОДИТЬ, ВОЗМОЖНО ЧЕРЕЗ ALERT ЧТО ВСЕ ОК ИЛИ ПРОИЗШЕЛ ФЕЙЛ, ЭТО МОЖНО ПОНЯТЬ ИЗ $_SESSION['new-track-ans']

?>