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
        [0] // fullname // 0 - all good
                           1 - incorrect symbols
        [1] // login // 0 - all good
                        1 - also registration login
                        2 - short or long [5,15]
                        3 - incorrect symbols
        [2] // email // 0 - all good
                        1 - also registration email
                        2 - incorrect email(regexp)
        [3] // password // 0 - all good
                           1 - short or long[5,25]
                           2 - incorrect symbols (password must contain at least one number,
                                    one upper case letter,
                                    one lower case letter
                                    and one special character)
                           3 - don't matching repeat pass
    */
    $error = array(check_fullname($fullname),check_login($login),check_email($email),check_password($password, $repeat_password));

    //Check
    $flag = true;
    $i = 0;

    var_dump($error);
    echo count($error);

    for ($i = 0; $i < count($error); $i++)
    if (!(($error[i]===0)))
    {$flag = false; break;}

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