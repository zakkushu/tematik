<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/pelanggan.php';
 
$database = new Database();
$db = $database->getConnection();
 
$pelanggan = new Pelanggan($db);
 
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->nama) && !empty($data->nickname) && !empty($data->nomorhp) && !empty($data->email) && !empty($data->createdby)
){  
 
    $pelanggan->nama = $data->nama;
    $pelanggan->nickname = $data->nickname;
    $pelanggan->nomorhp = $data->nomorhp;
    $pelanggan->email = $data->email;
    $pelanggan->createdby = $data->createdby;
    $pelanggan->modifiedby = $data->modifiedby;
 
    if($pelanggan->create()){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "pelanggan was created."));
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add pelanggan. service unavailable"));
    }
}
 
else{

    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add pelanggan. Data is incomplete., badrequest"));
}
?>