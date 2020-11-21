<?php
    header('Content-Type: application/json');
    require "../app/Sermon.php";

    $sermon = new Sermon;
    $result = $sermon->getSpeaker();    
    if($result) {
        $return["data"] = $result;
        $return["success"] = true;
    }else{
        $return["error_message"] = "No data is found!";
        $return["success"] = false;
    }
    
    echo json_encode($return);
?>