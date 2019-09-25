<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/pelanggan.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $pelanggan = new pelanggan($db);
     
    $pelanggan->ID_P = isset($_GET['ID_P']) ? $_GET['ID_P'] : die();
     
    $pelanggan->readOne();
     
    if($pelanggan->nama!=null){
        $pelanggan_arr = array(
            "ID_P" =>  $pelanggan->ID_P,
            "nama" => $pelanggan->nama,
            "nomorhp" => $pelanggan->nomorhp,
            "email" => $pelanggan->email,
            "kehadiran" => $pelanggan->kehadiran,
            "ID_E" => $pelanggan->ID_E,
            "ID_K" => $pelanggan->ID_K
        );
     
        http_response_code(200);
        echo json_encode($pelanggan_arr);
    }
     
    else{
        http_response_code(404);
        echo json_encode(array("message" => "pelanggan does not exist."));
    }
?>