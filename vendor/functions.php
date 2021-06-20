<?php
    function check_href($href, $active = NULL)//$href is url; $active is trying to parse
    {
        require_once 'connect.php';
        $ans = array();

        //Check in DB
        //Return TRUE, if url is correct and DB have needed domen
        //Return FALSE, if url isn't correct or DB haven't domen
        $shops = mysqli_query($connect, "select url from shops");

        while($row=mysqli_fetch_row($shops))
        {
            if (strripos($href, $row[0]))
            {
                array_push($ans, True);
                break;
            }
        }
        if (!isset($ans[0])) array_push($ans, False);
        
        //Check active of shop's page (try to parse a price)
        //Return TRUE, if parsing is completed successfully
        //Return FALSE, if parsing is failed
        if ($active!=NULL)
        {
            libxml_use_internal_errors(true);
            $shops_xpath = mysqli_query($connect, "select url, xpath from shops");

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

            $tmp = false;
            foreach ($nodes as $i => $node)
			{
                $tmp = true;
            }
            
            if ($tmp) array_push($ans, True);
                else array_push($ans, False);            
        }
        
        echo $ans;
        return $ans;
    }

?>