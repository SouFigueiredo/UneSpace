<?php

require_once '../config/connect.php';

$sala_id = $_GET['sala_id'];
$data = $_GET['data'];

$stmt = $conn->prepare("
    SELECT horario_id
    FROM reservas

    WHERE sala_id = ?
    AND data_reserva = ?
");

$stmt->bind_param("is", $sala_id, $data);

$stmt->execute();

$result = $stmt->get_result();

$horarios = [];

while ($row = $result->fetch_assoc()) {
    $horarios[] = $row['horario_id'];
}

header('Content-Type: application/json');
echo json_encode($horarios);