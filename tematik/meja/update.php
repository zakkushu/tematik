<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/meja.php';

	$database = new Database();
	$db = $database->getConnection();

	$meja = new meja($db);

	$data = json_decode(file_get_contents("php://input"));

	$meja->IDD_M = $data->IDD_M;
	$meja->ID_E = $data->ID_E;
	$meja->ID_M = $data->ID_M;
	$meja->tname = $data->tname;
	$meja->createdat = $data->createdat;
	$meja->createdby = $data->createdby;
	$meja->modifiedby = $data->modifiedby;
	

	if($meja->update()){

		http_response_code(200);

		echo json_encode(array("message" => "meja was updated."));
	}

	else{

		http_response_code(503);

		echo json_encode(array("message" => "Unable to update meja."));
	}
?>