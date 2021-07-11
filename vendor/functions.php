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

    function get_all_by_xpath($href)//$href is url. Return array[price, title, image] or 'NO' if failed
    {
        require 'connect.php';
        libxml_use_internal_errors(true);

        $answer = array('NO','NO','NO',$href);

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

    function check_email($email)//Check correct email. Return 0 - all good, 1 - also registration email, 2 - incorrect email(regexp)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            require 'connect.php';

            if (mysqli_num_rows(mysqli_query($connect, "select id from users where email = '$email'"))>0) return 1;
            return 0;
        }
        else return 2;
    }

    function check_login($login)//Return 0 - all good, 1 - also registration login, 2 - short or long[5,15], 3 - incorrect symbols
    {
        if (filter_var($login, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/\w/"))))
        {
            require 'connect.php';

            if (mysqli_num_rows(mysqli_query($connect, "select id from users where login = '$login'"))>0) return 1;
            
            if ((strlen($login)>15)||(strlen($login)<5)) return 2;

            return 0;
        }
            else return 3;
    }

    function check_password($password, $repeat_password)//Return 0 - all good, 1 - short or long, 2 - incorrect symbols, 3 - don't matching repeat pass
    {
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        
        if($number && $uppercase && $lowercase && $specialChars)
        {
            if ((strlen($password)>25)||(strlen($password)<5)) return 1;//short or long

            if ($password!=$repeat_password) return 3;//matching repeat pass

            return 0;//all good
        }
        else
        {
            return 2;//incorrect symbols
        }

    }

    function check_fullname($fullname)//Return 0 - all good, 1 - incorrect symbols
    {
        if (filter_var($fullname, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/\w/")))) return 0;
            else return 1;
    }

    function check_url_database($url, $user_id)//Return 0 - FULL MATHCING(user have this track), 1 - MATCHING (track in db), 2 - don't mathcing in db
    {
        require 'connect.php';

        $result = mysqli_query($connect,"select id from tracking where url='$url'");      

        if (mysqli_num_rows($result)>0) 
        {
            $result = mysqli_fetch_row($result);
            $result = $result[0];
            $result1 = mysqli_query($connect,"select id from user_tracking where user='$user_id' and track ='$result'");
            if (mysqli_num_rows($result1)>0) return 0;
            return 1;
        }
            else return 2;
    }

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    
    function get_error_msg_data($type, $code)
    {
        switch ($type)
    {
        case 'fullname':
            {
                switch ($code)
                {
                    case 0: {return ''; break;}
                    case 1: {return 'Некорректные символы'; break;}
                }
                break;
            }
        case 'login':
            {
                switch ($code)
                {
                case 0: {return ''; break;}
                case 1: {return 'Логин занят'; break;}
                case 2: {return 'Длина логина должна составлять от 5 до 15 символов';break;};
                case 3: {return 'Логин может содержать только буквы и цифры';break;};
                break;
                }
            }
        case 'email':
            {
                switch ($code)
                {
                case 0: {return ''; break;}
                case 1: {return 'Email уже зарегистрирован'; break;}
                case 2: {return 'Email должен быть в виде something@foffle.com'; break;}
                break;
                }
            }
        case 'password':
            {
                switch ($code)
                {
                case 0: {return ''; break;}
                case 1: {return 'Длина пароля должна быть от 5 до 25 символов'; break;}
                case 2: {return 'Пароль должен содерать одну прописную букву, одну заглавную букву, одну цифру и один специальный символ'; break;}
                case 3: {return 'Введенные пароли не совпадают'; break;}
                break;
                }
            }
    }
    }
?>