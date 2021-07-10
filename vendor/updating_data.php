<?php
    require 'connect.php';
    require 'functions.php';

    $all = mysqli_query($connect, "select count(id), url from tracking where TIMEDIFF(now(),date_update)>MINUTE('00:10:00')");

    while ($row = mysqli_fetch_row($all))
    {
        $newdata = get_all_by_xpath($row[1]);

        if (!$newdata)
        {
            echo 'Ошибка парсинга';
            die();
        }

        $result = mysqli_query($connect, "update tracking set price = '$newdata[0]', title = '$newdata[1]', image = '$newdata[2]', date_update=now() where url = '$row[1]'");

    }

?>