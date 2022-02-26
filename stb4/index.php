<?php

$db = new SQLite3('../api/.db.db');
$rows3 = $db->query("SELECT * FROM dns");
$row3 = $rows3->fetchArray();

$portal_four    	  =  $row3['portal4'];

$portals = array($portal_four);

foreach($portals as $portal){
    $url = $portal_four."/c/".http_build_query($_POST).str_replace("%40","@",$_SERVER['QUERY_STRING']);
    // file_put_contents("file.txt",$url);
    parse_str($_SERVER['QUERY_STRING'], $result_array);
    $_SERVER['QUERY_STRING'] = http_build_query($result_array);
    // if( isset($_SERVER['HTTPS'] ) )
    $portalseg = explode(":",$portal);
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url."",TRUE,301);
        die();
    }
}