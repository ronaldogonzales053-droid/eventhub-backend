<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "config.php";

$data = json_decode(
    file_get_contents("php://input"),
    true
);

if(
    empty($data["email"]) ||
    empty($data["password"])
){
    echo json_encode([
        "success"=>false,
        "message"=>"Campos vacíos"
    ]);
    exit;
}

$email = $data["email"];
$password = $data["password"];

$sql = "SELECT * FROM usuarios
WHERE email='$email'
AND password='$password'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();

    echo json_encode([
        "success"=>true,
        "usuario"=>$usuario
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>"Credenciales incorrectas"
    ]);
}
?>
