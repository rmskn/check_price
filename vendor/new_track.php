<?php
    require 'connect.php';

    $url = $_POST['url'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $image = $_POST['image'];

    $user = $_SESSION['login'];

    $current_date = date('m/d/Y h:i:s a', time());

    


?>