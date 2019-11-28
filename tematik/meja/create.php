<?php
 
include_once '../config/database.php';
 
include_once '../objects/meja.php';
 
$database = new Database();
$db = $database->getConnection();
 
$meja = new meja($db);
 
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->ID_E) && !empty($data->ID_M) && !empty($data->tname) && !empty($data->createdby)
){  
 
    $meja->ID_E = $data->ID_E;
    $meja->ID_M = $data->ID_M;
    $meja->tname = $data->tname;
    // $meja->createdat = $data->createdat;
    $meja->createdby = $data->createdby;
    $meja->modifiedby = $data->modifiedby;
 
    if($meja->create()){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "meja was created."));
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add meja. service unavailable"));
    }
}
 
else{

    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add meja. Data is incomplete., badrequest"));
}
?>