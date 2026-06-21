<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "config.php";

$sql = "SELECT * FROM eventos";

$result = $conn->query($sql);

$eventos = [];

while($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $eventos
]);

?>
