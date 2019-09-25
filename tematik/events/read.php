<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/events.php';
 
$database = new Database();
$db = $database->getConnection();
 
$events = new Events($db);
 

$stmt = $events->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $events_arr=array();
    $events_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $events_item=array(
            "ID_E" => $ID_E,
            "nama_e" => $nama_e,
            "lokasi_e" => $lokasi_e,
            "tanggal_e" => $tanggal_e,
            "waktu_e" => $waktu_e,
            "jumlah_m" => $jumlah_m,
            "jumlah_k" => $jumlah_k
        );
 
        array_push($events_arr["records"], $events_item);
    }
 
    http_response_code(200);
 
    echo json_encode($events_arr);
}
 
else{
 
    http_response_code(404);
 
    echo json_encode(
        array("message" => "No events found.")
    );
}