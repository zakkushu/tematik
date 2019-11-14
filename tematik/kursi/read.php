<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/kursi.php';
 
$database = new Database();
$db = $database->getConnection();
 
$kursi = new kursi($db);
 

$stmt = $kursi->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $kursi_arr=array();
    $kursi_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $kursi_item=array(
            "ID_M" => $ID_M,
            "ID_E" => $ID_K,
            "ID_P" => $ID_P,
            "createdat" => $createdat,
            "createdby" => $createdby,
            "modifiedby" => $modifiedby
        );
 
        array_push($kursi_arr["records"], $kursi_item);
    }
 
    http_response_code(200);
 
    echo json_encode($kursi_arr);
}
 
else{
 
    http_response_code(201);
 
    echo json_encode(
        array("message" => "No kursi found.")
    );
}