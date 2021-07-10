<?php
     session_start();
     require 'connect.php';

     $answer = '';

     $item = $_GET['id'];
     $login = $_SESSION['authorization-login'];

     $user_id = mysqli_query($connect, "select id from users where login = '$login'");
     $user_id = mysqli_fetch_row($user_id);
     $user_id = $user_id[0];

     $res1 = mysqli_query($connect, "select id from user_tracking where track = '$item'");

     //Check other tracking
     if (mysqli_num_rows($res1)>1)
     {
         $result = mysqli_query($connect, "delete from user_tracking where user = '$user_id' and track = '$item'");
         if ($result) $answer = 'Успешно';
            else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже11';
     }
     else//if this track alone
     {
        mysqli_begin_transaction($connect);
        try {

             mysqli_query($connect, "delete from user_tracking where user = '$user_id' and track = '$item'");
             mysqli_query($connect, "delete from tracking where id = '$item'");
            
             mysqli_commit($connect);
            $answer = 'Успешно!';

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($connect);
            $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
            throw $exception;
        }
     }

     $_SESSION['alert'] = $answer;
     header('Location: /lk.php');
     echo $answer;

     //ТУТ НАДО ПЕРЕСЫЛАТЬ В ЛК ВО ВКЛАДКУ МОИ ТОВАРЫ С СООБЩЕНИЕМ, ВОЗМОЖНО ЧЕРЕЗ ALERT, ЧТО ВСЕ ОК ИЛИ НЕТ. ЭТО МОЭНО ПОНЯТЬ ИЗ $_SESSION['delete-item-ans']

     
?>