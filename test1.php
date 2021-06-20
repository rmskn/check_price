<?php
    require_once 'connect.php';
    libxml_use_internal_errors(true);
?>
<html lang="ru">
<head>
    <title>Check price</title>
</head>
<body>
        <?php
            $href = $_POST["href"];

            echo "Ссылка: ".$href."</br>";

            $shops_xpath = mysqli_query($connect, "select url, xpath from shops");
            //$xpath = '';

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
                echo $string;
            }           
            ?>
</body>
</html>