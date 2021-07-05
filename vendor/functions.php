<?php
    function check_href($href, $active = NULL)//$href is url; $active is trying to parse. Return boolean array(2), [0] - in db, [1] - try parse
    {
        require 'connect.php';
        $ans = 0;

        //Check in DB
        //Return TRUE, if url is correct and DB have needed domen
        //Return FALSE, if url isn't correct or DB haven't domen
        $shops = mysqli_query($connect, "select url from shops");

        while($row=mysqli_fetch_row($shops))
        {
            if (strripos($href, $row[0]))
            {
                $ans =  1;
                break;
            }
        }

        return $ans;
    }

    function get_price_by_xpath($href)//$href is url. Return (string)Price of item
    {
        require 'connect.php';
        libxml_use_internal_errors(true);

        $shops_xpath = mysqli_query($connect, "select url, xpath_price from shops");

        while($row=mysqli_fetch_row($shops_xpath))
        {
            if (strripos($href, $row[0]))
            {
                $query = $row[1];
                break;
            }
        }

        $dom = new DomDocument;
        $dom->loadHTMLFile($href);

        $xpath = new DomXPath($dom);
        $nodes = $xpath->query($query);

        foreach ($nodes as $i => $node)
		{
            $string = htmlentities($node->nodeValue, null, 'utf-8');
            $string = preg_replace("/[^0-9]/",'',$string); 
            return $string;
        } 
    }

    function get_title_by_xpath($href)//$href is url. Return (string)Title of item
    {
        require 'connect.php';
        libxml_use_internal_errors(true);

        $shops_xpath = mysqli_query($connect, "select url, xpath_title from shops");

        while($row=mysqli_fetch_row($shops_xpath))
        {
            if (strripos($href, $row[0]))
            {
                $query = $row[1];
                break;
            }
        }

        $dom = new DomDocument;
        $dom->loadHTMLFile($href);

        $xpath = new DomXPath($dom);
        $nodes = $xpath->query($query);

        foreach ($nodes as $i => $node)
		{
            //$string = htmlentities($node->nodeValue, null, 'utf-8');
            return mb_convert_encoding($node->nodeValue, 'iso-8859-1', 'UTF-8');//mb_convert_encoding($str, 'iso-8859-1', 'UTF-8');
            $convertedText = mb_convert_encoding($node->nodeValue, 'windows-1251', mb_detect_encoding($node->nodeValue));
            echo $convertedText;
            return $node->nodeValue; 
            return $string;
        } 
    }

    function get_image_by_xpath($href)//$href is url. Return (string)Image of item (only one)
    {
        require 'connect.php';
        libxml_use_internal_errors(true);

        $shops_xpath = mysqli_query($connect, "select url, xpath_image from shops");

        while($row=mysqli_fetch_row($shops_xpath))
        {
            if (strripos($href, $row[0]))
            {
                $query = $row[1];
                break;
            }
        }

        $dom = new DomDocument;
        $dom->loadHTMLFile($href);

        $xpath = new DomXPath($dom);
        $nodes = $xpath->query($query);

        return $nodes->item(0)->getAttribute('data-url');
    }

    function get_all_by_xpath($href)
    {
        require 'connect.php';
        libxml_use_internal_errors(true);

        $answer = array('NO','NO','NO');

        $shops_xpath = mysqli_query($connect, "select url, xpath_price, xpath_title, xpath_image, id from shops");

        while($row=mysqli_fetch_row($shops_xpath))
        {
            if (strripos($href, $row[0]))
            {
                $query_price = $row[1];
                $query_title = $row[2];
                $query_image = $row[3];
                $id_shop = $row[4];
                break;
            }
        }

        $dom = new DomDocument;
        $dom->loadHTMLFile($href);

        $xpath = new DomXPath($dom);
        $nodes = $xpath->query($query_price);

        foreach ($nodes as $i => $node)
		{
            $string = htmlentities($node->nodeValue, null, 'utf-8');
            $string = preg_replace("/[^0-9]/",'',$string); 
            $answer[0] = $string;
        }

        if ($answer[0]=='NO') return false;

        //TITLE

        $xpath = new DomXPath($dom);
        $nodes = $xpath->query($query_title);

        foreach ($nodes as $i => $node)
		{
            switch ($id_shop) {
                case 1://avito
                    $answer[1] = mb_convert_encoding($node->nodeValue, 'iso-8859-1', 'UTF-8');
                    break;
                case 2://wildberries
                    $answer[1] = $node->nodeValue;
                    break;
                case 3:
                    echo "i равно 2";
                    break;
                }

        }
        
        //IMAGE

        $xpath = new DomXPath($dom);
        $nodes = $xpath->query($query_image);

        switch ($id_shop) {
            case 1://avito
                $answer[2] = $nodes->item(0)->getAttribute('data-url');
                break;
            case 2://wildberries
                $answer[2] = $nodes->item(0)->getAttribute('src');
                break;
            case 3:
                echo "i равно 2";
                break;
        }
        

        return $answer;
    }

?>