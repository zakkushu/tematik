<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$admin = new Admin($db);
 
// read products will be here

// query products
$stmt = $admin->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $admins_arr=array();
    $admins_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $admin_item=array(
            "ID_A" => $ID_A,
            "nama" => $nama,
            "email" => $email,
            "createdby" => $createdby,
            "createdat" => $createdat,
            "modifiedby" => $modifiedby
        );
 
        array_push($admins_arr["records"], $admin_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($admins_arr);
}
 
// no products found will be here
else{
 
    // set response code - 201 Not found
    http_response_code(201);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No admins found.")
    );
}