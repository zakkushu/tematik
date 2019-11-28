<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/admin.php';
 
$database = new Database();
$db = $database->getConnection();
 
$admin = new Admin($db);
 
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->nama) && !empty($data->email) && !empty($data->password) && !empty($data->createdby)
){
    $ciphering = "AES-128-CTR"; 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    $encryption_iv = '1234567891011121'; 
    $encryption_key = "tematik"; 
    $encryption = openssl_encrypt($data->password, $ciphering, $encryption_key, $options, $encryption_iv); 

    $admin->nama = $data->nama;
    $admin->email = $data->email;
    $admin->password = $encryption;
    $admin->createdby = $data->createdby;
    $admin->modifiedby = $data->modifiedby;

    if($admin->create()){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "Admin was created."));
    }
 
    else{
 
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to create admin. service unavailable"));
    }
}
 
else{
 
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create admin. Data is incomplete., badrequest"));
}
?>