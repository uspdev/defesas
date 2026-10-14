<?php

namespace App\Services;

use App\Models\Agendamento;

class AgendamentoService
{
    public function newAgendamento(array $agendamentoData, array $alunoPos): Agendamento {
        $agendamento = new Agendamento();
        $agendamento->codpes = $agendamentoData['codpes'];
        $agendamento->sala = $agendamentoData['sala'];
        $agendamento->tipo = $agendamentoData['tipo'];
        $agendamento->data_horario = $agendamentoData['data_horario'];
        $agendamento->sala_virtual = $agendamentoData['sala_virtual'] ?? NULL;
        $agendamento->codare = $alunoPos['codare'];
        $agendamento->nivpgm = $alunoPos['nivpgm'];
        $agendamento->numseqpgm = $alunoPos['numseqpgm'];
        $agendamento->save();

        return $agendamento;
    }
}
