<?php
    //require_once 'functions.php';

    $url = 'https://www.avito.ru/saransk/avtomobili/mercedes-benz_gl-klass_2009_1857312389';    
    $query = '//*[@id="price-value"]/span/span[1]'; 

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_TIMEOUT, 15);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     $html = curl_exec($ch);
     curl_close($ch);

     //echo $html;

    $dom = new DomDocument($html);
    //$dom->loadHTMLFile($html);

    $xpath = new DomXPath($dom);
    $nodes = $xpath->query($query);

    $tmp = false;
    foreach ($nodes as $i => $node)
	{
        echo 'lol';
        $tmp = true;
        echo $node->nodeValue;
    }

    
    $query_check_captha = '/html/body/div[1]/div/h2';
    if (!$tmp)
    {
        //echo 'lol';
        $xpath1 = new DomXPath($dom);
        $nodes1 = $xpath1->query($query_check_captha);
        //echo $nodes1->Value;
        foreach ($nodes1 as $i => $node1)
	    {
            echo $node1->nodeValue;
        }
    }
    
    //echo $html;
     die();
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth TOKEN'));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_HEADER, false);
    // $html = curl_exec($ch);
    // curl_close($ch);

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