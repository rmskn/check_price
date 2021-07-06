<?php
    session_start();
    require 'functions.php';

    $fullname = $_POST['fullname'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    //Array of errors
    /*
        [0] // fullname // bool
        [1] // login // 0 - all good
                        1 - also registration login
                        2 - short or long
                        3 - incorrect symbols
        [2] // email // 0 - all good
                        1 - also registration email
                        2 - incorrect email(regexp)
        [3] // password // 0 - all good
                           1 - short or long
                           2 - incorrect symbols
                           3 - don't matching repeat pass
    */
    $error = array(check_fullname($fullname),check_login($login),check_email($email),check_password($password, $repeat_password));

    //Check
    $flag = true;
    for ($i = 0; $i < $error.count; $i++) if (!(($error[i]===0)||($error===true))) {$flag = false; break;}

    //If all correct go to continue registration else return to reg page with errors
    if ($flag)
    {
        $_SESSION['tmp-reg-data'] = array($fullname, $login, $email, $password);
        header('Location: new_user.php');
    }
    else
    {
        $_SESSION['reg-error'] = $error;
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

?>