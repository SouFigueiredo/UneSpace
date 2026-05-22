<?php

require_once '../config/connect.php';

$sala_id = $_GET['sala_id'];

$stmt = $conn->prepare("
    SELECT
        reservas.data_reserva,

        horarios.horario_inicio,
        horarios.horario_fim,

        turmas.nome AS turma,
        periodos.nome AS periodo

    FROM reservas

    INNER JOIN horarios
    ON horarios.id = reservas.horario_id

    INNER JOIN turmas
    ON turmas.id = reservas.turma_id

    INNER JOIN periodos
    ON periodos.id = reservas.periodo_id

    WHERE reservas.sala_id = ?

    ORDER BY reservas.data_reserva ASC
");

$stmt->bind_param("i", $sala_id);

$stmt->execute();

$result = $stmt->get_result();

$reservas = [];

while ($row = $result->fetch_assoc()) {

    $reservas[] = $row;
}

header('Content-Type: application/json');

echo json_encode($reservas);