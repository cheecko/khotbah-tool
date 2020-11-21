<?php
    header("Content-Type: application/json");
    require_once('../library/getid3/getid3.php');
    require "../app/Sermon.php";
    $files = $_FILES["files"];
    $sermon = new Sermon;
    
    $getID3 = new getID3;
    try {
        if(!isset($files)) {
            throw new Exception("Files is empty!");
        }
        $return["error"] = null;
        $return["type"] = null;
        foreach($files["error"] as $index=>$file) {
            if($file != 0) {
                $return["error"][$index] = $file;
            }
        }
        foreach($files["type"] as $index=>$file) {
            if(strpos($file, "audio") === FALSE) {
                $return["type"][$index] = $file;
            }
        }
        if (!file_exists("../media/")) {
            mkdir("../media/", 0777, true);
        }
        $count = 0;
        foreach($files["tmp_name"] as $index=>$file) {
            if(!isset($return["type"][$index]) && !isset($return["error"][$index])) {
                $audioData = $getID3->analyze($file);

                if(isset($audioData["tags"]["id3v2"])) {
                    $audioData = $audioData["tags"]["id3v2"];
                }else{
                    throw new Exception("Audio don't have meta data!");
                }

                $data = $sermon->reconstructAudioData($audioData);

                $date = explode("_", $files["name"][$index])[0];
                $array = str_split($date);
                $date = $array[4] . $array[5] . "." . $array[2] . $array[3] . "." . "20" . $array[0] . $array[1];
                $data["date"] = $date;
                $data["filename"] = $files["name"][$index];

                $result = $sermon->setSermon($data);

                move_uploaded_file($file, "../media/" . $files["name"][$index]);
                $count++;
            }
        }
        $entity = " is";
        if($count == 0) {
            throw new Exception("No file is uploaded!");
        }else if($count > 1) {
            $entity = "s are";
        }
        $return["message"] = $count . " file" . $entity . " uploaded";
        $return["success"] = true;
    }catch(Exception $e) {
        $return =  [
            "success" => false,
            "message" => $e->getMessage()
        ];
    }
    echo json_encode($return);
?>