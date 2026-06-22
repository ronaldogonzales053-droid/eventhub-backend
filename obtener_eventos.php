<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "config.php";

$sql = "SELECT *
        FROM eventos
        ORDER BY id DESC";

$result = $conn->query($sql);

$eventos = [];

if($result){

    while($row =
        $result->fetch_assoc()){

        $eventos[] = [

            "id" =>
            $row["id"],

            "titulo" =>
            $row["titulo"],

            "descripcion" =>
            $row["descripcion"],

            "fecha_evento" =>
            $row["fecha_evento"],

            "hora_evento" =>
            $row["hora_evento"],

            "ubicacion" =>
            $row["ubicacion"],

            "imagen" =>
            $row["imagen"] ??
            "https://picsum.photos/800/400"

        ];
    }
}

echo json_encode([

    "success" => true,

    "total" =>
    count($eventos),

    "data" =>
    $eventos

]);
?>
