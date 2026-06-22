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

$id = $data["id"] ?? 0;

$sql = "DELETE FROM reservas
WHERE id='$id'";

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
