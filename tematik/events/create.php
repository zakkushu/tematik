<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
     
    include_once '../config/database.php';
     
    include_once '../objects/events.php';

    include_once '../events/create.php';
     
    $database = new Database();
    $db = $database->getConnection();
     
    $events = new events($db);
     
    $data = json_decode(file_get_contents("php://input"));
     

    if(
        !empty($data->nama_e) && !empty($data->lokasi_e) && !empty($data->tanggal_e)  && !empty($data->waktu_e) && !empty($data->jumlah_m) && !empty($data->createdby)){
     
        $events->nama_e = $data->nama_e;
        $events->lokasi_e = $data->lokasi_e;
        $events->tanggal_e = $data->tanggal_e;
        $events->waktu_e = $data->waktu_e;
        $events->jumlah_m = $data->jumlah_m;
        // $events->createdat = $data->createdat;
        $events->createdby = $data->createdby;
        $events->modifiedby = $data->modifiedby;
        $events->notes = $data->notes;
     
        if($events->create()){
     
            http_response_code(201);
            $events_arr = array(
                "nama_e" => $events->nama_e,
                "lokasi" => $events->lokasi_e,
                "tanggal_e" => $events->tanggal_e,
                "waktu_e" => $events->waktu_e,
                "jumlah_m" => $events->jumlah_m,
                "createdby" => $events->createdby,
                "modifiedby" => $events->modifiedby,
                "notes" => $events->notes
            );
     
            
            echo json_encode($events_arr);

            $events->readone();
        }
     
        else{
     
            http_response_code(503);
     
            echo json_encode(array("message" => "Unable to add events. service unavailable"));
        }
    }
     
    else{

        http_response_code(400);
     
        echo json_encode(array("message" => "Unable to add events. Data is incomplete., badrequest"));
    }
?>