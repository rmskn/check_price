<?php
    require 'vendor/connect.php';

    $url = $_POST['findhref'];

    echo $url;

    echo '</br>';


        $ans = 0;

        echo 

        //Check in DB
        //Return TRUE, if url is correct and DB have needed domen
        //Return FALSE, if url isn't correct or DB haven't domen
        $shops = mysqli_query($connect, "select url from shops");

        while($row=mysqli_fetch_row($shops))
        {
            echo $row[0];
            echo '</br>';
            
            if (strripos($href, $row[0]))
            {
                $ans =  1;
                break;
            }
        }

        echo $ans;


    
?>