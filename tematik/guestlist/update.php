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

	$guestlist->ID_E = $data->ID_E;
	$guestlist->ID_P = $data->ID_P;
	$guestlist->ID_M = $data->ID_M;
	$guestlist->ID_K = $data->ID_K;
	$guestlist->kehadiran = $data->kehadiran;
	$guestlist->raffle = $data->raffle;
	$guestlist->createdat = $data->createdat;
	$guestlist->createdby = $data->createdby;
	$guestlist->modifiedby = $data->modifiedby;
	

	if($guestlist->update()){

		http_response_code(200);

		echo json_encode(array("message" => "guestlist was updated."));
	}

	else{

		http_response_code(503);

		echo json_encode(array("message" => "Unable to update guestlist."));
	}
?>