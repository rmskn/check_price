<?php
    require 'connect.php';
    require 'functions.php';

    $url = $_POST['url'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $image = $_POST['image'];

    $user = $_SESSION['login'];

    $current_date = date('m/d/Y h:i:s a', time());
    $last_update = $current_date;

    $user_id = mysqli_query($connect, "select id from users where login = '$login'");
    $user_id = mysqli_fetch_row($user_id);
    $user_id = $user_id[0];

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
                mysqli_query($connect, "INSERT INTO tracking(url, price, title, image, date_creating, date_update) VALUES ('$url', '$price', '$title', '$image', '$date_creating', '$date_update')");
            
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

    //New track
    


?>