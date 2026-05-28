<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}

require_once '../api/config/connect.php';
date_default_timezone_set('America/Sao_Paulo'); $horaAtual = date('H:i:s'); $conn->query(" DELETE reservas FROM reservas INNER JOIN horarios ON horarios.id = reservas.horario_id WHERE reservas.data_reserva < CURDATE() OR ( reservas.data_reserva = CURDATE() AND horarios.horario_fim < '$horaAtual' ) ");

$sql = "
    SELECT
        salas.*,

        reservas.id AS reserva_id,
        reservas.horario_id,

        horarios.horario_inicio,
        horarios.horario_fim

    FROM salas

    LEFT JOIN reservas
    ON reservas.sala_id = salas.id
    AND reservas.data_reserva = CURDATE()

    LEFT JOIN horarios
    ON horarios.id = reservas.horario_id

    WHERE salas.bloco = 'B'

    ORDER BY salas.andar, salas.nome
";

$result = $conn->query($sql);

$salas = [];

while ($row = $result->fetch_assoc()) {
    $andar = $row['andar'];
    $salaId = $row['id'];

    if (!isset($salas[$andar][$salaId])) {

        $salas[$andar][$salaId] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'capacidade' => $row['capacidade'],
            'bloco' => $row['bloco'],
            'reservas' => []
        ];
    }

    if (!empty($row['reserva_id'])) {

        $salas[$andar][$salaId]['reservas'][] = [
            'horario_id' => $row['horario_id'],
            'inicio' => $row['horario_inicio'],
            'fim' => $row['horario_fim']
        ];
    }
}

$turmasResult = $conn->query("SELECT * FROM turmas ORDER BY nome");
$periodosResult = $conn->query("SELECT * FROM periodos ORDER BY id");

$turmas = [];
$periodos = [];

while ($row = $turmasResult->fetch_assoc()) {
    $turmas[] = $row;
}

while ($row = $periodosResult->fetch_assoc()) {
    $periodos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Dashboard</title>

</head>



<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950 text-white min-h-screen overflow-y-auto">
    <?php require_once 'components/modalReserva.php'; ?>    
    <div class="max-w-7xl mx-auto px-6 py-10">
        <header class="
            relative
            overflow-hidden
            bg-white/5
            backdrop-blur-md
            border border-white/10
            rounded-3xl
            p-8
            shadow-2xl
            mb-14
        ">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between flex-wrap gap-5">
                    <div>
                        <p class="uppercase tracking-[0.3em] text-blue-300 text-sm mb-2">
                            Sistema Acadêmico
                        </p>

                        <h1 class="text-4xl md:text-5xl font-black mb-3">
                            Gestão de Salas
                        </h1>

                        <p class="text-slate-300 text-lg">
                            Controle inteligente do Bloco B
                        </p>
                    </div>

                    <div class="
                        bg-blue-500/10
                        border border-blue-400/20
                        px-5 py-4
                        rounded-2xl
                    ">
                        <p class="text-sm text-slate-400 mb-1">
                            Usuário conectado
                        </p>

                        <p class="font-bold text-blue-300 text-lg">
                            <?php echo $_SESSION['usuario']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </header>
        <?php foreach ($salas as $andar => $listaSalas): ?>
            <section class="mb-16">
                <div class="flex items-center justify-between mb-7">
                    <div>
                        <h2 class="text-3xl font-bold">
                            <?php echo $andar; ?>° Andar
                        </h2>

                        <p class="text-slate-400 mt-1">
                            Salas disponíveis neste andar
                        </p>
                    </div>

                    <div class="
                        bg-slate-800/80
                        border border-slate-700
                        px-4 py-2
                        rounded-xl
                        text-sm
                        text-slate-300
                    ">
                        <?php echo count($listaSalas); ?> salas

                    </div>
                </div>
                <div class="
                    grid
                    grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    xl:grid-cols-4
                    gap-6
                ">
                    <?php foreach ($listaSalas as $sala): ?>
                        <?php
                        $reservada = count($sala['reservas']) >= 3;

                        $cardClasses = $reservada
                            ? 'border-red-500/40 bg-red-500/10 hover:border-red-400'
                            : 'border-white/10 bg-white/[0.03] hover:border-blue-400/40';

                        $statusClasses = $reservada
                            ? 'bg-red-500/15 text-red-400 border border-red-500/20'
                            : 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/20';

                        $statusTexto = $reservada
                            ? 'Reservada'
                            : 'Disponível';
                        ?>
                        <div class="
                        group
                        relative
                        overflow-hidden
                        backdrop-blur-md
                        rounded-3xl
                        p-6
                        transition-all
                        duration-300
                        hover:-translate-y-1
                        hover:shadow-2xl
                        <?php echo $cardClasses; ?>
                        ">
                            <div class="
                                absolute
                                top-0
                                right-0
                                w-32
                                h-32
                                bg-blue-500/10
                                rounded-full
                                blur-3xl
                                opacity-0
                                group-hover:opacity-100
                                transition-all
                            "></div>

                            <div class="relative z-10">
                                <div class="flex items-start justify-between mb-5">
                                    <div>
                                        <p class="text-slate-400 text-sm mb-1">
                                            Sala
                                        </p>

                                        <h3 class="text-3xl font-black tracking-wide text-blue-100">
                                            <?php echo $sala['nome']; ?>
                                        </h3>
                                    </div>

                                    <span class="
                                        px-3
                                        py-1
                                        rounded-full
                                        text-xs
                                        font-semibold
                                        <?php echo $statusClasses; ?>
                                        ">
                                        <?php echo $statusTexto; ?>
                                    </span>
                                </div>

                                <div class="space-y-3 text-slate-300">
                                    <div class="flex justify-between">
                                        <span class="text-slate-400">
                                            Capacidade
                                        </span>

                                        <strong>
                                            <?php echo $sala['capacidade']; ?>
                                        </strong>

                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-slate-400">
                                            Bloco
                                        </span>

                                        <strong>
                                            <?php echo $sala['bloco']; ?>
                                        </strong>
                                    </div>
                                </div>

                                <button 
                                onclick='abrirModal(
                                    <?php echo $sala["id"]; ?>,
                                    <?php echo json_encode($sala["nome"]); ?>
                                )'

                                class="
                                mt-7
                                w-full
                                bg-gradient-to-r
                                from-blue-500
                                to-blue-600
                                hover:from-blue-600
                                hover:to-blue-700
                                rounded-2xl
                                py-3
                                font-semibold
                                tracking-wide
                                transition-all
                                duration-200
                                shadow-lg
                                shadow-blue-900/30
                                "
                                >
                                Reservar Sala
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</body>
<script src="js/modalReserva.js"></script>

</html>