<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/guestlist.php';
 
$database = new Database();
$db = $database->getConnection();
 
$guestlist = new guestlist($db);
$guestlist->ID_E = isset($_GET['ID_E']) ? $_GET['ID_E'] : die();
 

$stmt = $guestlist->hadir();
$num = $stmt->rowCount();

 
if($num>0){
 
    $guestlist_arr=array();
    $guestlist_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $guestlist_item=array(
            "nama" => $nama
        );
 
        array_push($guestlist_arr["records"], $guestlist_item);
    }
 
    http_response_code(200);
 
    echo json_encode($guestlist_arr);
}
 
else{
 
    http_response_code(201);
 
    echo json_encode(
        array("message" => "No guestlist found.")
    );
}
