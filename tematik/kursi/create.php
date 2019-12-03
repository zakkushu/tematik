<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/kursi.php';
 
$database = new Database();
$db = $database->getConnection();
 
$kursi = new kursi($db);
 
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->IDD_M) && !empty($data->ID_K) && !empty($data->ID_P) && !empty($data->createdby)
){  
 
    $kursi->IDD_M = $data->IDD_M;
    $kursi->ID_K = $data->ID_K;
    $kursi->ID_P = $data->ID_P;
    $kursi->createdby = $data->createdby;
    $kursi->modifiedby = $data->modifiedby;
 
    if($kursi->create()){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "kursi was created."));
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add kursi. service unavailable"));
    }
}
 
else{

    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add kursi. Data is incomplete., badrequest"));
}
?>