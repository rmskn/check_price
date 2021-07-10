<?php
    require 'connect.php';
    session_start();

    $login = $_POST['login'];
    $password = $_POST['password'];

    $hash = mysqli_query($connect,"select password from users where login='$login'");

    if (mysqli_num_rows($hash)==0)
    {
        $_SESSION['auth-error']='Неверный логин';
        $_SESSION['tmp-auth-login']=$login;
        header("Location: ".$_SERVER['HTTP_REFERER']);
        die();
    }

    $hash = mysqli_fetch_row($hash);
    $hash = $hash[0];

    $result = password_verify($password, $hash);

    if (!$result)
    {
        $_SESSION['auth-error']='Неверный пароль'; 
        $_SESSION['tmp-auth-login']=$login;
        header("Location: /auth.php");
    }
    else
    {
        $_SESSION['authorization-login']=$login;
        header('Location: /lk.php');
    }
?>