<?php
    require_once 'functions.php';

    $href = $_POST['findhref'];
    $ans = check_href($href, 1);

    if ($ans[0]==0)
    {
        echo "Данный магазин пока не поддерживается или ссылка некорректна <br/>";
        die();
    }

    if ($ans[1]==0)
    {
        echo 'Произошла непредвиденная ошибка. Не удается найти товар <br/>';
        die();
    }

    echo get_price_by_xpath($href);
    echo '<br/>';
    echo get_title_by_xpath($href);
    echo '<br/>';
    echo '<img src="'.get_image_by_xpath($href).'">';

?>