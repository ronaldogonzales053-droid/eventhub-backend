<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once "config.php";

$data = json_decode(
file_get_contents("php://input"),
true
);

$usuario_id =
$data["usuario_id"];

$sql = "

SELECT

pagos.id,
pagos.metodo_pago,
pagos.monto,
pagos.fecha_pago,

eventos.titulo

FROM pagos

INNER JOIN eventos

ON pagos.evento_id =
eventos.id

WHERE pagos.usuario_id = ?

ORDER BY pagos.id DESC

";

$stmt =
$conn->prepare($sql);

$stmt->bind_param(
"i",
$usuario_id
);

$stmt->execute();

$result =
$stmt->get_result();

$pagos = [];

while($row =
$result->fetch_assoc()){

$pagos[] = $row;

}

echo json_encode([

"success" => true,

"data" => $pagos

]);

?>
