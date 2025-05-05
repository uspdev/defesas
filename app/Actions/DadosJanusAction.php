<?php

namespace App\Actions;

use App\Services\ReplicadoService;

class DadosJanusAction
{
    public static function handle($agendamento)
    {
        $dataDeposito = ReplicadoService::getDataDepositoTrabalho($agendamento->codpes, $agendamento->codare, $agendamento->getRawOriginal('nivpgm'), $agendamento->numseqpgm);
        $orientador = ReplicadoService::getOrientador($agendamento->codpes, $agendamento->codare, $agendamento->numseqpgm);
        $agendamento->aluno = ReplicadoService::getNome($agendamento->codpes);
        $agendamento->orientador = array_merge($orientador, ReplicadoService::getSetorOrientador($orientador['codpes']));
        $agendamento->area = ReplicadoService::getNomeArea($agendamento->codare);
        $titulo = ReplicadoService::getTituloTrabalho($agendamento->codpes, $agendamento->codare, $agendamento->numseqpgm);
        $agendamento->trabalho = array_merge($titulo, ReplicadoService::getComplementoTrabalho($agendamento->codpes, $dataDeposito));
        $agendamento->banca = ReplicadoService::getBanca($agendamento->codpes, $agendamento->codare, $agendamento->numseqpgm);

        return $agendamento;
    }
}
