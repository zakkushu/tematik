<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare admin object
$admin = new Admin($db);

// get id of admin to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of admin to be edited
$admin->ID_A = $data->ID_A;

// set admin property values
$admin->nama = $data->nama;
$admin->email = $data->email;
$admin->password = $data->password;

// update the admin
if($admin->update()){

	// set response code - 200 ok
	http_response_code(200);

	// tell the user
	echo json_encode(array("message" => "admin was updated."));
}

// if unable to update the admin, tell the user
else{

	// set response code - 503 service unavailable
	http_response_code(503);

	// tell the user
	echo json_encode(array("message" => "Unable to update admin."));
}
?>