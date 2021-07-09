<?php
    require 'connect.php';

    $shops = mysqli_query($connect, "select url from shops");

    while($row=mysqli_fetch_row($shops))
        {
            echo $row[0];
            echo '</br>';

        }

    
?>