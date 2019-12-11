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
     
    $kursi->IDD_M = isset($_GET['IDD_M']) ? $_GET['IDD_M'] : die();
     
    $stmt = $kursi->count();
    $num = $stmt->rowCount();
    
    if($num>0){
        $kursi_arr=array();
        $kursi_arr["records"]=array();
        $kursi_arr["count"]=array();
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            
            extract($row);
     
            $kursi_item=array(
                "IDD_M" => $IDD_M,
                "ID_k" => $ID_K,
                "ID_P" => $ID_P,
                "nama" => $nama,
                "createdat" => $createdat,
                "createdby" => $createdby,
                "modifiedby" => $modifiedby
            );
     
            array_push($kursi_arr["records"], $kursi_item);
        }
     
        http_response_code(200);
        
        array_push( $kursi_arr["count"], $num);
     
        echo json_encode($kursi_arr);
    }
     
    else{
     
        http_response_code(201);
     
        echo json_encode(
            array("message" => "No kursi found.")
        );
    }
?>