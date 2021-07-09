<?php
    require 'connect.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $hash = mysqli_query($connect,"select password from users where login='$login'");

    if (!$hash)
    {
        $_SESSION['auth-error']='Неверный логин';
        $_SESSION['tmp-auth-login']=$login;
        header("Location: ".$_SERVER['HTTP_REFERER']);
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
        $_SESSION['authorization-status']=true;
        $_SESSION['authorization-login']=$login;
        header('Location: /lk.php');
    }
?>