<?php
    function check_href($href, $active = NULL)//$href is url; $active is trying to parse. Return boolean array(2), [0] - in db, [1] - try parse
    {
        require 'connect.php';
        $ans = array();

        //Check in DB
        //Return TRUE, if url is correct and DB have needed domen
        //Return FALSE, if url isn't correct or DB haven't domen
        $shops = mysqli_query($connect, "select url from shops");

        while($row=mysqli_fetch_row($shops))
        {
            if (strripos($href, $row[0]))
            {
                array_push($ans, 1);
                break;
            }
        }
        if (!isset($ans[0])) array_push($ans, 0);

        #----------------------------------------------------------------------------------#
        
        //Check active of shop's page (try to parse a price)
        //Return TRUE, if parsing is completed successfully
        //Return FALSE, if parsing is failed
        if ($active!=NULL)
        {
            libxml_use_internal_errors(true);
            $tmp = false;

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
                $tmp = true;
            }
            
            if ($tmp) array_push($ans, 1);
                else array_push($ans, 0);            
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

    function get_title_by_xpath($href)//$href is url. Return (string)Price of item
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
            return $node->nodeValue; 
            return $string;
        } 
    }

?>