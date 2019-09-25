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

	$pelanggan = new pelanggan($db);

	$data = json_decode(file_get_contents("php://input"));

	$pelanggan->ID_P = $data->ID_P;

	if($pelanggan->delete()){

		http_response_code(200);
		echo json_encode(array("message" => "pelanggan was deleted."));
	}

	else{

		http_response_code(503);
		echo json_encode(array("message" => "Unable to delete pelanggan."));
	}
?>