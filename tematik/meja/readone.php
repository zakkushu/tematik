<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/meja.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $meja = new meja($db);
     
    $meja->ID_E = isset($_GET['ID_E']) ? $_GET['ID_E'] : die();
     
    $stmt = $meja->readOne();
    $num = $stmt->rowCount();
    
    if($num>0){
        $meja_arr=array();
        $meja_arr["records"]=array();
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            
            extract($row);
     
            $meja_item=array(
                "ID_E" => $ID_E,
                "ID_M" => $ID_M,
                "tname" => $tname,
                "createdat" => $createdat,
                "createdby" => $createdby,
                "modifiedby" => $modifiedby
            );
     
            array_push($meja_arr["records"], $meja_item);
        }
     
        http_response_code(200);
     
        echo json_encode($meja_arr);
    }
     
    else{
     
        http_response_code(201);
     
        echo json_encode(
            array("message" => "No meja found.")
        );
    }
?>