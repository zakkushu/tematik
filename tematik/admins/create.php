<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/admin.php';
 
$database = new Database();
$db = $database->getConnection();
 
$admin = new Admin($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
//echo json_encode(array("input" => $data->nama));

if(
    !empty($data->nama) && !empty($data->email) && !empty($data->password) && !empty($data->createdat) && !empty($data->createdby) && !empty($data->modifiedby)
){
 
    // set product property values
    $admin->nama = $data->nama;
    $admin->email = $data->email;
    $admin->password = $data->password;

 
    // create the product
    if($admin->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Admin was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create product. service unavailable"));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete., badrequest"));
}
?>