<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare admin object
$admin = new admin($db);
 
// set ID property of record to read
$admin->ID_A = isset($_GET['ID_A']) ? $_GET['ID_A'] : die();
 
// read the details of admin to be edited
$admin->readOne();
 
if($admin->nama!=null){
    // create array
    $admin_arr = array(
        "ID_A" =>  $admin->ID_A,
        "nama" => $admin->nama,
        "password" => $admin->password
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($admin_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user admin does not exist
    echo json_encode(array("message" => "admin does not exist."));
}
?>