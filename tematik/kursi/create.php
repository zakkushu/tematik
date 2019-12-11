<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/database.php';
 
include_once '../objects/kursi.php';
 
$database = new Database();
$db = $database->getConnection();
 
$kursi = new kursi($db);
 
$data = json_decode(file_get_contents("php://input"));
 

if(
    !empty($data->IDD_M) && !empty($data->ID_P) && !empty($data->createdby)
){  
 
    $kursi->IDD_M = $data->IDD_M;
    $kursi->ID_P = $data->ID_P;
    $kursi->createdby = $data->createdby;
    $kursi->modifiedby = $data->modifiedby;
 
    if($kursi->create()){


        $stmt = $kursi->aidi();
        $num = $stmt->rowCount();
 
        if($num>0){
        
            $kursi_arr=array();
            $kursi_arr["records"]=array();
        
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                extract($row);
        
                $kursi_item=array(
                    "ID_K" => $ID_K
                );
        
                array_push($kursi_arr["records"], $kursi_item);
            }
        
            http_response_code(200);
        
            echo json_encode($kursi_arr);
        }
    }   
 
    else{
        http_response_code(503);
 
        echo json_encode(array("message" => "Unable to add kursi. service unavailable"));
    }
}
 
else{

    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to add kursi. Data is incomplete., badrequest"));
}
?>