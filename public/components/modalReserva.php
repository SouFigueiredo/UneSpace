<div
    id="modalReserva"
    class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 overflow-y-auto p-6"
>

    <div class="
    bg-slate-900
    border
    border-slate-700
    rounded-3xl
    p-8
    w-full
    max-w-5xl
">
        <div class="flex items-center justify-between mb-6">

            <h2 class="text-2xl font-bold">
                Reservar Sala
            </h2>

            <button
                onclick="fecharModal()"
                class="text-slate-400 hover:text-white text-xl"
            >
                ✕
            </button>

        </div>

        <form action="../api/reservas/criar.php" method="POST">

            <input type="hidden" name="sala_id" id="sala_id">

            <div class="mb-5">

                <label class="block mb-2 text-sm text-slate-300">
                    Sala
                </label>

                <input
                    type="text"
                    id="nome_sala"
                    disabled
                    class="
                        w-full
                        bg-slate-800
                        border
                        border-slate-700
                        rounded-xl
                        px-4
                        py-3
                        text-white
                    "
                >

            </div>

            <div class="mb-5">

                <label class="block mb-2 text-sm text-slate-300">
                    Turma
                </label>

                <select
                    name="turma_id"
                    required
                    class="
                        w-full
                        bg-slate-800
                        border
                        border-slate-700
                        rounded-xl
                        px-4
                        py-3
                        text-white
                    "
                >

                    <?php foreach ($turmas as $turma): ?>

                        <option value="<?php echo $turma['id']; ?>">

                            <?php echo $turma['nome']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="mb-5">

                <label class="block mb-2 text-sm text-slate-300">
                    Data
                </label>

                <input
                    type="date"
                    min="<?php echo date('Y-m-d'); ?>"
                    name="data_reserva"
                    id="data_reserva"
                    required
                    class="
                        w-full
                        bg-slate-800
                        border
                        border-slate-700
                        rounded-xl
                        px-4
                        py-3
                        text-white
                    "
                >

            </div>

            <div class="mb-5">

                <label class="block mb-2 text-sm text-slate-300">
                    Horário
                </label>

                <select
                    name="horario_id"
                    id="horario_id"
                    required
                    class="
                        w-full
                        bg-slate-800
                        border
                        border-slate-700
                        rounded-xl
                        px-4
                        py-3
                        text-white
                    "
                >

                    <option value="">
                        Selecione um horário
                    </option>

                    <option value="1">
                        18:50 - 19:30
                    </option>

                    <option value="2">
                        19:30 - 20:30
                    </option>

                    <option value="3">
                        20:40 - 22:00
                    </option>

                </select>

                <div
                    id="statusHorarios"
                    class="mt-4 space-y-2"
                ></div>

            </div>

            <div class="mb-6">

                <label class="block mb-2 text-sm text-slate-300">
                    Período
                </label>

                <select
                    name="periodo_id"
                    required
                    class="
                        w-full
                        bg-slate-800
                        border
                        border-slate-700
                        rounded-xl
                        px-4
                        py-3
                        text-white
                    "
                >

                    <?php foreach ($periodos as $periodo): ?>

                        <option value="<?php echo $periodo['id']; ?>">

                            <?php echo $periodo['nome']; ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <button
                type="submit"
                class="
                    w-full
                    bg-blue-600
                    hover:bg-blue-700
                    transition-all
                    rounded-2xl
                    py-3
                    font-semibold
                "
            >
                Confirmar Reserva
            </button>

        </form>

        <!-- LISTA DE AGENDAMENTOS -->

        <div class="mt-8 border-t border-slate-700 pt-6">

            <h3 class="text-lg font-bold mb-4 text-white">
                Agendamentos da Sala
            </h3>

            <div
    id="listaReservas"
    class="
        grid
        grid-cols-1
        sm:grid-cols-2
        gap-4
        max-h-72
        overflow-y-auto
        pr-1
    "
>

                <div class="text-slate-400 text-sm">
                    Carregando agendamentos...
                </div>

            </div>

        </div>

    </div>

</div>