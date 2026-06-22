<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? 0;
$titulo = $data["titulo"] ?? "";
$descripcion = $data["descripcion"] ?? "";
$fecha = $data["fecha_evento"] ?? "";
$hora = $data["hora_evento"] ?? "";
$ubicacion = $data["ubicacion"] ?? "";

$sql = "UPDATE eventos
SET titulo='$titulo',
descripcion='$descripcion',
fecha_evento='$fecha',
hora_evento='$hora',
ubicacion='$ubicacion'
WHERE id='$id'";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "message"=>"Evento actualizado"
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "message"=>$conn->error
    ]);
}
?>
