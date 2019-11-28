<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/admin.php';


$ciphering = "AES-128-CTR"; 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$decryption_iv = '1234567891011121'; 
$decryption_key = "tematik"; 

$database = new Database();
$db = $database->getConnection();


$admin = new admin($db);
$data = json_decode(file_get_contents("php://input"));

$admin->email = $data->email;
 

$admin->login();

$decryption=openssl_decrypt ($admin->password, $ciphering, $decryption_key, $options, $decryption_iv); 

if($data->password == $decryption && $data->email == $admin->email){
        http_response_code(201);
        echo json_encode(array("message" => "success"));
}
else{
        http_response_code(503);
        echo json_encode(array("message" => "failed"));
}


?> 
