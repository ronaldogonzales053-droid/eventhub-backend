<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once "config.php";

$data = json_decode(
    file_get_contents("php://input"),
    true
);

if(!$data){
    echo json_encode([
        "success"=>false,
        "message"=>"No llegaron datos"
    ]);
    exit;
}

$usuario_id = $data["usuario_id"] ?? 0;
$evento_id = $data["evento_id"] ?? 0;

$sql = "INSERT INTO reservas(usuario_id,evento_id)
VALUES('$usuario_id','$evento_id')";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Reserva registrada"
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);
}
