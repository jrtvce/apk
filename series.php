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

$curlRequests = [];
$mh = curl_multi_init();
foreach($portals as $i => $portal){
    if (empty($portal)){continue;}
    # $url = $portal."/live".http_build_query($_POST).str_replace("%40","@",$_SERVER['QUERY_STRING']);
    $url = $portal."/series/".$_GET["path"];
    $k = trim($url);
    $curlRequests[$k] = curl_init();
    curl_setopt($curlRequests[$k], CURLOPT_HEADER, true);
    // curl_setopt($curlRequests[$k], CURLOPT_NOBODY, true);
    curl_setopt($curlRequests[$k], CURLOPT_NOPROGRESS, false );
    curl_setopt( $curlRequests[$k], CURLOPT_PROGRESSFUNCTION, function($resource, $download_size, $downloaded_size, $upload_size, $uploaded_size) {
        if ($download_size>100){
            return 1; //returning a non-zero value cancels the CURL download.
        }
    });
    curl_setopt($curlRequests[$k], CURLOPT_URL, $url);
    curl_setopt($curlRequests[$k], CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_2; en-US) AppleWebKit/532.8 (KHTML, like Gecko) Chrome/4.0.302.2 Safari/532.8');
    curl_setopt($curlRequests[$k], CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curlRequests[$k], CURLOPT_TIMEOUT,10);
    curl_setopt($curlRequests[$k], CURLOPT_CONNECTTIMEOUT , 10);
    curl_setopt($curlRequests[$k], CURLOPT_TIMEOUT, 10);
    curl_setopt($curlRequests[$k], CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curlRequests[$k], CURLOPT_AUTOREFERER, TRUE);
    curl_multi_add_handle($mh, $curlRequests[$k]);
}

do {
    $status = curl_multi_exec($mh, $active);
    if ($active) {
        // Wait for activity on any curl_multi connection
        curl_multi_select($mh, 50);
    }
} while ($active && $status == CURLM_OK);

foreach($curlRequests as $url => $ch) {
      // $content = curl_multi_getcontent($ch);
      curl_multi_remove_handle($mh, $ch);
    $request_info = curl_getinfo($ch);
    if (isset($request_info["redirect_url"]) && !empty($request_info["redirect_url"])){
        $filteredUrl = filterRedirectURL($request_info["redirect_url"]);
        if (strpos($request_info["redirect_url"], 'myhls//') !== false){
            $url = $filteredUrl;
        }
        $k = getUrlHeaders ($filteredUrl);
        if (!empty($k)){
            $request_info = $k;
        }
    }
    if ((isset($request_info["content_type"]) && IsStreamVideo($request_info["content_type"])) || intval ($request_info["http_code"])==200){header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$url."",TRUE,301);
        die();
    }else {
        // This has failed. Unable to determine whether this is a video stream.
    }
}

function IsStreamVideo ($contentType){
    $knownVideoTypes = [
        "video/mp4"
        
    ];
    if (in_array(trim($contentType), $knownVideoTypes)){
        return true;
    }
    return false;
}


function getUrlHeaders ($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    $k =  curl_getinfo($ch);
    curl_close($ch);
    return $k;
}

function filterRedirectURL ($url){
    $parts = explode ("myhls//", $url);
    if (count($parts)>1){
        return "https://".$parts[1];
    }else {
        return $url;
    }
}