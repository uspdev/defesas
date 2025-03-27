<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class DadosJanusAction
{
    public static function handle($agendamento)
    {
        $dataDeposito = ReplicadoService::getDataDepositoTrabalho($agendamento->codpes, $agendamento->codare, $agendamento->getRawOriginal('nivpgm'), $agendamento->numseqpgm);
        $agendamento->aluno = ReplicadoService::getNome($agendamento->codpes);
        $agendamento->orientador = ReplicadoService::getOrientador($agendamento->codpes, $agendamento->codare, $agendamento->numseqpgm);
        $agendamento->area = ReplicadoService::getNomeArea($agendamento->codare);
        $agendamento->trabalho = ReplicadoService::getTrabalho($agendamento->codpes, $dataDeposito);
        $agendamento->banca = ReplicadoService::getBanca($agendamento->codpes, $agendamento->codare, $agendamento->numseqpgm);

        return $agendamento;
    }
}
