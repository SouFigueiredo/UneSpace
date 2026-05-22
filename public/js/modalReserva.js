

async function abrirModal(id, nome) {
    console.log("JS carregado");
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
    const texto = await response.text();

console.log(texto);

const reservas = JSON.parse(texto);

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
        bg-slate-800
        border
        border-slate-700
        rounded-xl
        px-4
        py-3
        min-w-[180px]
        flex-1
    ">

        <div class="font-semibold text-blue-300 text-sm mb-1">
            ${reserva.data_reserva}
        </div>

        <div class="text-white text-sm">
            ${reserva.horario_inicio} - ${reserva.horario_fim}
        </div>

        <div class="text-slate-300 text-xs mt-2">
            ${reserva.turma}
        </div>

        <div class="text-slate-500 text-xs">
            ${reserva.periodo}
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