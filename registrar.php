<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "config.php";

$data = json_decode(
    file_get_contents("php://input"),
    true
);

if(
    empty($data["nombre"]) ||
    empty($data["email"]) ||
    empty($data["password"])
){
    echo json_encode([
        "success"=>false,
        "message"=>"Campos vacíos"
    ]);
    exit;
}

$nombre = $data["nombre"];
$email = $data["email"];
$password = $data["password"];

$sql = "INSERT INTO usuarios
(nombre,email,password)
VALUES
('$nombre','$email','$password')";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);
}
?>
