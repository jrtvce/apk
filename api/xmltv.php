<?php

 
     
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new SQLite3('./.db.db');
$rows3 = $db->query("SELECT * FROM dns");
$row3 = $rows3->fetchArray();

$portal_one    	=  $row3['portal1'];
$portal_two	    =  $row3['portal2'];
$portal_three	=  $row3['portal3'];
$portals = array($portal_one,$portal_two,$portal_three);

function getresult($url,$port){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_PORT, $port);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_2; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}



foreach($portals as $portal){
    $url = $portal."/xmltv.php?".http_build_query($_POST).str_replace("%40","@",$_SERVER['QUERY_STRING']);
    parse_str($_SERVER['QUERY_STRING'], $result_array);
    $_SERVER['QUERY_STRING'] = http_build_query($result_array);
    if( isset($_SERVER['HTTPS'] ) )
    $portalseg = explode(":",$portal);
    $res = getresult($url,$portalseg[2]);
    $res = trim($res);
    if($res === false || $res == "" || $res == '{"user_info":{"auth":0}}' || stripos($res,"Internal Server Error") ){
        continue;
    }
    else{
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url."",TRUE,301);
        die();
    }
}
echo "Failed";
