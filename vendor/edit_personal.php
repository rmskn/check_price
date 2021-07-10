<?php
    require 'connect.php';
    $login = $_SESSION['login'];
    $newdata = $_POST['new-data'];
    $type = $_GET['it'];

    $answer = '';

    switch ($type)
    {
        case 'fullname':
            {
                $tmp = check_fullname($newdata);
                if ($tmp==0)
                {
                    $res1 = mysqli_query($connect,"update users set fullname = '$newdata' where login='$login'");
                    if ($res1) $answer = 'Успешно!';
                    else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';               
                }
                else
                {
                    $answer = '';
                }
                break;
            }
        case 'login':
            {
                $res1 = mysqli_query($connect,"update users set login = '$newdata' where login='$login'");
                if ($res1) $answer = 'Успешно!';
                    else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
                break;
            }
        case 'email':
            {
                $res1 = mysqli_query($connect,"update users set login = '$newdata' where email='$login'");
                if ($res1) $answer = 'Успешно!';
                    else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
                break;
            }
        case 'password':
            {
                $newdata = password_hash($newdata, PASSWORD_BCRYPT);
                $res1 = mysqli_query($connect,"update users set password = '$newdata' where password='$login'");
                if ($res1) $answer = 'Успешно!';
                    else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
                break;
            }
    }
    
?>