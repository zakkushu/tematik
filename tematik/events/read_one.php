<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/events.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $events = new events($db);
     
    $events->ID_E = isset($_GET['ID_E']) ? $_GET['ID_E'] : die();
     
    $events->readOne();
     
    if($events->nama_e!=null){
        $events_arr = array(
            "ID_E" =>  $events->ID_E,
            "nama_e" => $events->nama_e,
            "lokasi" => $events->lokasi_e,
            "tanggal_e" => $events->tanggal_e,
            "waktu_e" => $events->waktu_e,
            "jumlah_m" => $events->jumlah_m,
            "jumlah_k" => $events->jumlah_k,
            "note" => $events->note
     
        );
     
        http_response_code(200);
        echo json_encode($events_arr);
    }
     
    else{
        http_response_code(201);
        echo json_encode(array("message" => "events does not exist."));
    }
?>