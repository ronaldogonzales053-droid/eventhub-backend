<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");

require_once "config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "success" => false,
        "message" => "No llegaron datos"
    ]);
    exit;
}

$nombre = $data["nombre"] ?? "";
$email = $data["email"] ?? "";
$password = $data["password"] ?? "";

$sql = "INSERT INTO usuarios(nombre,email,password)
        VALUES('$nombre','$email','$password')";

if ($conn->query($sql)) {

    echo json_encode([
        "success" => true,
        "message" => "Usuario registrado"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => $conn->error
    ]);
}
?>
