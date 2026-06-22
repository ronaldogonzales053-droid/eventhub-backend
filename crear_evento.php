<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "config.php";

$data = json_decode(
file_get_contents("php://input"),
true
);

$titulo = $data["titulo"];
$descripcion = $data["descripcion"];
$fecha = $data["fecha_evento"];
$hora = $data["hora_evento"];
$ubicacion = $data["ubicacion"];

$sql = "INSERT INTO eventos
(
titulo,
descripcion,
fecha_evento,
hora_evento,
ubicacion
)
VALUES
(
'$titulo',
'$descripcion',
'$fecha',
'$hora',
'$ubicacion'
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
