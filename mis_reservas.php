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

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$usuario_id = $data["usuario_id"] ?? 0;

$sql = "SELECT
r.id,
e.titulo,
e.descripcion,
e.fecha_evento,
e.ubicacion
FROM reservas r
INNER JOIN eventos e
ON r.evento_id = e.id
WHERE r.usuario_id = '$usuario_id'
ORDER BY r.id DESC";

$result = $conn->query($sql);

$reservas = [];

while($row = $result->fetch_assoc()){
    $reservas[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $reservas
]);
?>
