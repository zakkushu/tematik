<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/guestlist.php';
 
$database = new Database();
$db = $database->getConnection();
 
$guestlist = new guestlist($db);
 
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->ID_E) && !empty($data->ID_P) && !empty($data->IDD_M) && !empty($data->ID_K) && !empty($data->kehadiran) && !empty($data->raffle) && !empty($data->createdby)   
){  
 
    $guestlist->ID_E = $data->ID_E;
    $guestlist->ID_P = $data->ID_P;
    $guestlist->IDD_M = $data->IDD_M;
    $guestlist->ID_K = $data->ID_K;
    $guestlist->kehadiran = $data->kehadiran;
    $guestlist->raffle = $data->raffle;
    $guestlist->createdby = $data->createdby;
    $guestlist->modifiedby = $data->modifiedby;
 
    if($guestlist->create()){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "guestlist was created."));
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add guestlist. service unavailable"));
    }
}
 
else{

    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add guestlist. Data is incomplete., badrequest"));
}
?>