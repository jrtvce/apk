<?php
    header('Content-Type: application/json');
    $db = new SQLite3('../api/.db.db');
    switch ($_GET["action"]){
        case "clearlogs":
            $response = new \stdClass();
            $response->success = false;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $db->exec("Delete FROM login_requests");  
                $response->success = true;
            } 
            echo json_encode($response);
            break;
    }
    //echo nothing
?>