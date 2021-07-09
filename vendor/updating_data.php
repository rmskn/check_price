<?php
    //require 'connect.php';

    $connect = mysqli_connect('localhost', 'root', 'erosab49', 'check_price');

    $result = mysqli_query($connect, "insert test(time,text,lol) values (NOW(), 'kek lol кек лол', 4)");





?>