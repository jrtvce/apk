<?php

 
     
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$db = new SQLite3('./api/.db.db');
$rows3 = $db->query("SELECT * FROM dns");
$row3 = $rows3->fetchArray();

$portal_one    	=  $row3['portal1'];
$portal_two	    =  $row3['portal2'];
$portal_three	=  $row3['portal3'];
$portal_four    	=  $row3['portal4'];
$portal_five	    =  $row3['portal5'];
$portal_six	=  $row3['portal6'];
$portal_seven    	=  $row3['portal7'];
$portal_eight    =  $row3['portal8'];
$portal_nine	=  $row3['portal9'];
$portal_ten   	=  $row3['portal10'];
$portal_eleven	    =  $row3['portal11'];
$portal_twelve	=  $row3['portal12'];
$portal_thirteen    	=  $row3['portal13'];
$portal_fourteen	    =  $row3['portal14'];
$portal_fifteen	=  $row3['portal15'];
$portal_sixteen    	=  $row3['portal16'];
$portal_seventeen	    =  $row3['portal17'];
$portal_eighteen	=  $row3['portal18'];
$portal_nineteen    	=  $row3['portal19'];
$portal_twenty     =  $row3['portal20'];
$portals = array($portal_one,$portal_two,$portal_three,$portal_four,$portal_five,$portal_six,$portal_seven,$portal_eight,$portal_nine,$portal_ten,$portal_eleven,$portal_twelve,$portal_thirteen,$portal_fourteen,$portal_fifteen,$portal_sixteen,$portal_seventeen,$portal_eighteen,$portal_nineteen,$portal_twenty);
$httpcode = null;
function getresult($url,$port){
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_PROXY, "37.120.133.141:3128");
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_HEADER, true);
    //curl_setopt ($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_2; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    $html = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (in_array($httpcode)){
        $html = false;
    }else if (!is_string($html)){
        $html = true;
    }
    return $html;
}


foreach($portals as $portal){
    if (empty($portal)){continue;}
    # $url = $portal."/timeshift/".http_build_query($_POST).str_replace("%40","@",$_SERVER['QUERY_STRING']);
    $url = $portal."/timeshift/".$_GET["path"];
    // file_put_contents("file.txt",$url);
    parse_str($_SERVER['QUERY_STRING'], $result_array);
    $_SERVER['QUERY_STRING'] = http_build_query($result_array);
    // if( isset($_SERVER['HTTPS'] ) )
    $portalseg = explode(":",$portal);
    $res = getresult($url,isset($portalseg[2])?$portalseg[2]:'80');
    if($res === false
        || (is_string($res) && strpos($res, '{"user_info":{"auth":0}}') !== false)
        || (is_string($res) && strpos($res, '{"success": true}') !== false )) {
            // || stripos($res,"HTTP code: 404") || stripos($res,"HTTP/1.1 401 Unauthorized") ||
        continue;
    }
    else{
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url."",TRUE,301);
        die();
    }
}
