<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/events.php';

	$database = new Database();
	$db = $database->getConnection();

	$events = new Events($db);

	$data = json_decode(file_get_contents("php://input"));

	$events->ID_E = $data->ID_E;

	$events->nama_e = $data->nama_e;
	$events->lokasi_e = $data->lokasi_e;
	$events->tanggal_e = $data->tanggal_e;
	$events->waktu_e = $data->waktu_e;
	$events->jumlah_m = $data->jumlah_m;
	$events->jumlah_k = $data->jumlah_k;


	if($events->update()){

		http_response_code(200);

		echo json_encode(array("message" => "events was updated."));
	}

	else{

		http_response_code(503);

		echo json_encode(array("message" => "Unable to update events."));
	}
?>