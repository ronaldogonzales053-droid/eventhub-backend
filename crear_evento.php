<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "config.php";

$data = json_decode(
file_get_contents("php://input"),
true
);

$titulo = $data["titulo"] ?? "";
$descripcion = $data["descripcion"] ?? "";
$fecha = $data["fecha_evento"] ?? "";
$hora = $data["hora_evento"] ?? "";
$ubicacion = $data["ubicacion"] ?? "";

$imagen =
$data["imagen"] ??
"https://picsum.photos/800/400";

$capacidad =
$data["capacidad"] ?? 100;

$creador_id =
$data["creador_id"] ?? null;

$sql = "INSERT INTO eventos
(
titulo,
descripcion,
fecha_evento,
hora_evento,
ubicacion,
imagen,
capacidad,
creador_id
)
VALUES
(
'$titulo',
'$descripcion',
'$fecha',
'$hora',
'$ubicacion',
'$imagen',
'$capacidad',
" . ($creador_id ? "'$creador_id'" : "NULL") . "
)";

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
