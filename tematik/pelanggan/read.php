<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/pelanggan.php';
 
$database = new Database();
$db = $database->getConnection();
 
$pelanggan = new pelanggan($db);
 

$stmt = $pelanggan->read();
$num = $stmt->rowCount();
 
if($num>0){
 
    $pelanggan_arr=array();
    $pelanggan_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $pelanggan_item=array(
            "ID_P" => $ID_P,
            "nama" => $nama,
            "nomorhp" => $nomorhp,
            "email" => $email,
            "kehadiran" => $kehadiran,
            "ID_E" => $ID_E,
            "ID_K" => $ID_K
        );
 
        array_push($pelanggan_arr["records"], $pelanggan_item);
    }
 
    http_response_code(200);
 
    echo json_encode($pelanggan_arr);
}
 
else{
 
    http_response_code(404);
 
    echo json_encode(
        array("message" => "No pelanggan found.")
    );
}