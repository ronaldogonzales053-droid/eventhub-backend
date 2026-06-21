<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "config.php";

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$usuario_id = $data["usuario_id"];
$evento_id = $data["evento_id"];

$sql = "INSERT INTO reservas
(usuario_id,evento_id)
VALUES
('$usuario_id','$evento_id')";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true
    ]);

}else{

    echo json_encode([
        "success"=>false
    ]);
}

?>
