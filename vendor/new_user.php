<?php
    session_start();
    require 'connect.php';

    $login = $_SESSION['tmp-reg-data'][1];
    $password = password_hash($_SESSION['tmp-reg-data'][3], PASSWORD_BCRYPT);
    $fullname = $_SESSION['tmp-reg-data'][0];
    $email = $_SESSION['tmp-reg-data'][2];
    $date_registration = date("Y-m-d H:i:s");

    unset($_SESSION['tmp-reg-data'][3]);
    
    $result = mysqli_query($connect, "insert users(login, password, fullname, email, date_registration) values ('$login', '$password', '$fullname', '$email', '$date_registration') ");

    if (!$result)
    {
        $_SESSION['reg-error-total'] = true;
        header('Location: /registration.php');
    }
    else
    {
        $_SESSION['authorization-login']=$login;
        header('Location: /lk.php');
    }

    
?>