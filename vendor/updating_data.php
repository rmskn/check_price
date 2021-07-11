<?php
    require 'connect.php';
    require 'functions.php';

    $all = mysqli_query($connect, "select price, url, id from tracking where TIMEDIFF(now(),date_update)>MINUTE('00:10:00')");

    while ($row = mysqli_fetch_row($all))
    {
        $newdata = get_all_by_xpath($row[1]);
        $old_price = $row[0];

        if (!$newdata)
        {
            echo 'Ошибка парсинга';
            die();
        }

        if ($newdata[0]!=$old_price)
        {
            $theme = "Изменение цены на $newdata[1]";

            $text = "Была изменена цена на товар $newdata[1] \n";
            $text = $text."Старая цена: $old_price руб. \n";
            $text = $text."Новая цена: $newdata[0] руб. \n";
            $text = $text."Ссылка на товар: $row[1] \n \n";
            $text = $text.'С уважением, команда CheckPrice';

            $emails = mysqli_query($connect, "select email from users where id = (select user from user_tracking where track = '$row[2]')");

            while ($row1 = mysqli_fetch_row($emails))
            {
                mail($row1[0], $theme, $text);
            }

        }

        $result = mysqli_query($connect, "update tracking set price = '$newdata[0]', title = '$newdata[1]', image = '$newdata[2]', date_update=now() where url = '$row[1]'");

    }

?>