<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Banca;
use Carbon\Carbon;
use App\Utils\ReplicadoUtils;

class AgendamentoService
{

    public function newAgendamento(array $agendamentoData, array $dadosJanus): Agendamento {
        $agendamento = new Agendamento();
        $agendamento->codpes = $agendamentoData['codpes'];
        $agendamento->sala = $agendamentoData['sala'];
        $agendamento->regimento = $agendamentoData['regimento'];
        $agendamento->orientador_votante = $agendamentoData['orientador_votante'];
        $agendamento->tipo = $agendamentoData['tipo_defesa'];
        $agendamento->data_horario = Carbon::createFromFormat('d/m/Y H:i', $agendamentoData['data'] . $agendamentoData['horario'])->format('Y-m-d H:i');
        $agendamento->nome = $dadosJanus['nompes'];
        $agendamento->titulo = $dadosJanus['tittrb'];
        $agendamento->area_programa = $dadosJanus['codare'];
        $agendamento->nivel = $dadosJanus['nivpgm'] == "ME" ? 'Mestrado' : 'Doutorado';
        $agendamento->orientador = $dadosJanus['orientador'];
        $agendamento->resumo = $dadosJanus['rsutrb'];
        $agendamento->save();

        return $agendamento;
    }

    public function newBanca(int $agendamento_id, int $codpes, int $numseqpgm) {
        $dadosBanca = ReplicadoUtils::retornarDadosBanca($codpes, $numseqpgm);
        foreach($dadosBanca as $dadoBanca){
            $banca = new Banca();
            $banca->agendamento_id = $agendamento_id;
            $banca->codpes = $dadoBanca['codpesdct'];
            $banca->nome = $dadoBanca['nompes'];
            $banca->presidente = $dadoBanca['vinptpbantrb'] == "PRE" ? 'Sim' : 'Não';
            $banca->tipo = $dadoBanca['vinptpbantrb'] == "SUP" ? 'Suplente' : 'Titular';
            $banca->save();
        }
    }
}
