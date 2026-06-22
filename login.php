<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data["email"] ?? "");
$password = trim($data["password"] ?? "");

if ($email == "" || $password == "") {

    echo json_encode([
        "success" => false,
        "message" => "Campos vacíos"
    ]);
    exit;
}

$sql = "SELECT * FROM usuarios
        WHERE email='$email'
        AND password='$password'
        LIMIT 1";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $usuario = $result->fetch_assoc();

    echo json_encode([
        "success" => true,
        "usuario" => $usuario
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Correo o contraseña incorrectos"
    ]);
}
?>
