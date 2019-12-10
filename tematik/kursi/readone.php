<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/kursi.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $kursi = new kursi($db);
     
    $kursi->ID_K = isset($_GET['ID_K']) ? $_GET['ID_K'] : die();
     
    $kursi->rilreadOne();
     
    if($kursi->ID_K!=null){
        $kursi_arr = array(
            "IDD_M" =>  $kursi->IDD_M,
            "ID_P" => $kursi->ID_P,
            "nama" => $kursi->nama
        );
     
        http_response_code(200);
        echo json_encode($kursi_arr);
    }
     
    else{
        http_response_code(201);
        echo json_encode(array("message" => "kursi does not exist."));
    }
?>