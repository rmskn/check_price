<?php
    require 'connect.php';

    $result = mysqli_query($connect, "insert test(time,text,lol) values (NOW(), 'kek lol кек лол', 4)");

    



?>