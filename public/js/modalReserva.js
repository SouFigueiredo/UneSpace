

async function abrirModal(id, nome) {
    document
        .getElementById('modalReserva')
        .classList
        .remove('hidden');

    document
        .getElementById('sala_id')
        .value = id;

    document
        .getElementById('nome_sala')
        .value = nome;

    carregarReservasSala(id);
}

function fecharModal() {

    document
        .getElementById('modalReserva')
        .classList
        .add('hidden');
}

async function carregarReservasSala(salaId) {

    const response = await fetch(
    `../api/reservas/listarSala.php?sala_id=${salaId}`
);

    const reservas = await response.json();

    const lista = document.getElementById('listaReservas');

    lista.innerHTML = "";

    if (reservas.length === 0) {

        lista.innerHTML = `
            <p class="text-slate-400 text-sm">
                Nenhum agendamento encontrado.
            </p>
        `;

        return;
    }

    reservas.forEach(reserva => {

        lista.innerHTML += `
    <div class="
        bg-gradient-to-br
        from-slate-800
        to-slate-900
        border
        border-slate-700
        rounded-2xl
        p-4
        min-w-[220px]
        shadow-lg
        shadow-black/20
        hover:border-blue-500/40
        transition-all
    ">

        <div class="flex items-center justify-between mb-3">

            <span class="
                bg-blue-500/15
                text-blue-300
                text-xs
                font-semibold
                px-3
                py-1
                rounded-full
                border
                border-blue-500/20
            ">
                ${reserva.data_reserva}
            </span>

            <span class="
                text-[11px]
                text-slate-400
            ">
                ${reserva.periodo}
            </span>

        </div>

        <div class="
            bg-slate-950/60
            border
            border-slate-700
            rounded-xl
            px-3
            py-2
            mb-3
        ">
            <p class="text-xs text-slate-400 mb-1">
                Horário
            </p>

            <p class="text-sm font-semibold text-white">
                ${reserva.horario_inicio} - ${reserva.horario_fim}
            </p>
        </div>

        <div>
            <p class="text-xs text-slate-400 mb-1">
                Turma
            </p>

            <p class="text-sm text-slate-200 font-medium">
                ${reserva.turma}
            </p>
        </div>

    </div>
`;
    });
}

async function carregarHorariosReservados() {

    const salaId = document.getElementById('sala_id').value;

    const data = document.getElementById('data_reserva').value;

    if (!data) return;

    const response = await fetch(
        `../api/reservas/listar.php?sala_id=${salaId}&data=${data}`
    );

    const horariosReservados = await response.json();

    const selectHorario = document.getElementById('horario_id');

    const statusDiv = document.getElementById('statusHorarios');

    statusDiv.innerHTML = "";

    [...selectHorario.options].forEach(option => {

        if (!option.value) return;

        option.disabled = false;

        if (horariosReservados.includes(parseInt(option.value))) {

            option.disabled = true;

            statusDiv.innerHTML += `
                <div class="text-red-400 text-sm">
                    🔴 ${option.text} já reservado
                </div>
            `;
        }
    });
}

document
    .getElementById('data_reserva')
    .addEventListener('change', carregarHorariosReservados);