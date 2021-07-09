<?php
    session_start();

    //Check existance of errors
    if (isset($_SESSION['find-error'])) echo $_SESSION['find-error'];
    else //Read finded info
    {
        $data = $_SESSION['finded-item'];
        
        echo $data[0];//price
        echo '<br/>';
        echo $data[1];//title
        echo '<br/>';
        echo '<img src="'.$data[2].'">';//image
        
    }

    unset($_SESSION['find-error']);



    /*
        ТУТ СТРАНИЦА С РЕЗУЛЬТАТОМ ПОИСКА ПО ССЫЛКЕ
    */
?>