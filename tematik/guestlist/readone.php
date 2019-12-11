<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');
     
    include_once '../config/database.php';
    include_once '../objects/guestlist.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $guestlist = new guestlist($db);
     
    $guestlist->ID_E = isset($_GET['ID_E']) ? $_GET['ID_E'] : die();
     
    $stmt = $guestlist->readOne();
    $num = $stmt->rowCount();
    
    if($num>0){
        $guestlist_arr=array();
        $guestlist_arr["records"]=array();
        $guestlist_arr["count"]=array();
     
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            
            extract($row);
     
            $guestlist_item=array(
                "ID_E" => $ID_E,
                "IDD_M" => $IDD_M,
                "tname" => $tname,
                "ID_K" => $ID_K,
                "ID_P" => $ID_P,
                "nama" => $nama,
                "kehadiran" => $kehadiran,
                "raffle" => $raffle,
                "createdby" => $createdby,
                "createdat" => $createdat,
                "modifiedby" => $modifiedby
            );
     
            array_push($guestlist_arr["records"], $guestlist_item);
        }
     
        http_response_code(200);
        
        array_push( $guestlist_arr["count"], $num);
     
        echo json_encode($guestlist_arr);
    }
     
    else{
     
        http_response_code(201);
     
        echo json_encode(
            array("message" => "No guestlist found.")
        );
    }
?>
