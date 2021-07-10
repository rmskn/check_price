<?php
    session_start();
    require 'connect.php';
    require 'functions.php';
    $login = $_SESSION['authorization-login'];
    $newdata = $_POST['new-data'];
    $type = $_GET['it'];

    if ($newdata == '')
    {
        $_SESSION['edit-error-type'] = $type;
        $_SESSION['edit-error'] = -1;
        $_SESSION['tmp-edit-data'] = $newdata;
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    $answer = '';

    switch ($type)
    {
        case 'fullname':
            {
                $tmp = check_fullname($newdata);
                if ($tmp==0)
                {
                    $res1 = mysqli_query($connect,"update users set fullname = '$newdata' where login='$login'");
                    if ($res1) $answer = 'Имя успешно изменено!';
                    else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';               
                }
                else
                {
                    $_SESSION['edit-error-type'] = $type;
                    $_SESSION['edit-error'] = $tmp;
                    $_SESSION['tmp-edit-data'] = $newdata;
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    $answer = '';
                    die();
                    break;
                }
                break;
            }
        case 'login':
            {
                $tmp = check_login($newdata);
                if ($tmp==0)
                {
                    $res1 = mysqli_query($connect,"update users set login = '$newdata' where login='$login'");
                    if ($res1) {$answer =  'Логин успешно изменен!';  $_SESSION['authorization-login'] = $newdata;}
                        else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
                }
                else
                {
                    $_SESSION['edit-error-type'] = $type;
                    $_SESSION['edit-error'] = $tmp;
                    $_SESSION['tmp-edit-data'] = $newdata;
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    $answer = '';
                    die();
                    break;
                }
                break;
            }
        case 'email':
            {
                $tmp = check_email($newdata);
                if ($tmp==0)
                {
                    $res1 = mysqli_query($connect,"update users set email = '$newdata' where login='$login'");
                    if ($res1) {$answer = 'Email успешно изменен!'; }
                        else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
                }
                else
                {
                    $_SESSION['edit-error-type'] = $type;
                    $_SESSION['edit-error'] = $tmp;
                    $_SESSION['tmp-edit-data'] = $newdata;
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                    $answer = '';
                    die();
                    break;
                }
                break;
            }
        case 'password':
            {
                $tmp = check_password($newdata,$newdata);
                if ($tmp==0)
                {
                    $newdata = password_hash($newdata, PASSWORD_BCRYPT);
                    $res1 = mysqli_query($connect,"update users set password = '$newdata' where login='$login'");
                    if ($res1) $answer = 'Пароль успешно изменен!';
                        else $answer = 'Произошла непредвиденная ошибка. Попробуйте позже';
                }
                else
                {
                    $_SESSION['edit-error-type'] = $type;
                    $_SESSION['edit-error'] = $tmp;
                    $_SESSION['tmp-edit-data'] = $newdata;
                    header("Location: /edit_personal.php?it='.$type.'.php");
                    $answer = '';
                    die();
                    break;
                }
                break;
            }
    }

    $_SESSION['alert'] = $answer;
    echo $answer;
    header('Location: /lk.php');
    
?>