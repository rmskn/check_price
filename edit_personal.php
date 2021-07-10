<?php
    session_start();
    require 'vendor/functions.php';
    require 'vendor/connect.php';

    $login = $_SESSION['authorization-login'];  
    $type = $_GET['it'];

    switch ($type)
    {
        case 'fullname': {$value = mysqli_query($connect, "select fullname from users where login = '$login'"); break;}
        case 'login': {$value = mysqli_query($connect, "select login from users where login = '$login'"); break;}
        case 'email': {$value = mysqli_query($connect, "select email from users where login = '$login'"); break;}
        case 'password': {$value = mysqli_query($connect, "select password from users where login = '$login'"); break;}   
    }

    $value = mysqli_fetch_row($value);
    $value = $value[0];

    if ($type === 'password') $value = '';

    if (isset($_SESSION['edit-error-type']))
    {
        $type_error = $_SESSION['edit-error-type'];
        $edit_error = $_SESSION['edit-error'];
        $value = $_SESSION['tmp-edit-data'];
    }

    unset($_SESSION['edit-error']);
    unset($_SESSION['edit-error-type']);
    unset($_SESSION['tmp-edit-data']);





    echo 'Сделай поле ввода и красивую кнопку';
    echo '<form action="vendor/edit_personal.php?it='.$type.'" method="post">
    <input type="text" placeholder="new" name="new-data" value = "'.$value.'">
    <button type="submit">Изменить</button>
    </form>';
    //Вывод ошибок
    echo get_error_msg_data($type_error,$edit_error);
?>