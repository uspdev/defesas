<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Banca;
use Carbon\Carbon;
use App\Utils\ReplicadoUtils;
use App\Models\Docente;
use Uspdev\Replicado\Pessoa;
use App\Actions\DocenteAction;

class AgendamentoService
{

    public function newAgendamento(array $agendamentoData, array $dadosJanus): Agendamento {
        $agendamento = new Agendamento();
        $agendamento->codpes = $agendamentoData['codpes'];
        $agendamento->sala = $agendamentoData['sala'];
        $agendamento->tipo = $agendamentoData['tipo_defesa'];
        $agendamento->data_horario = Carbon::createFromFormat('d/m/Y H:i', $agendamentoData['data'] . $agendamentoData['horario'])->format('Y-m-d H:i');
        $agendamento->nome = $dadosJanus['nompes'];
        $agendamento->titulo = $dadosJanus['tittrb'];
        $agendamento->area_programa = $dadosJanus['codare'];
        $agendamento->nivel = $dadosJanus['nivpgm'] == "ME" ? 'Mestrado' : 'Doutorado';
        $agendamento->orientador = $dadosJanus['orientador'];
        $agendamento->resumo = $dadosJanus['rsutrb'];
        $agendamento->sala_virtual = $agendamentoData['sala_virtual'] ?? NULL;
        $agendamento->save();

        return $agendamento;
    }

    public function newBanca(Agendamento $agendamento, int $codpes, int $numseqpgm) {
        $dadosBanca = ReplicadoUtils::retornarDadosBanca($codpes, $numseqpgm);
        $bancas = [];
        foreach($dadosBanca as $dadoBanca){
            DocenteAction::handle($dadoBanca['codpesdct'], $dadoBanca['nompes']);
            $bancas[] = [
                'codpes' => $dadoBanca['codpesdct'],
                'nome' => $dadoBanca['nompes'],
                'presidente' => $dadoBanca['vinptpbantrb'] == "PRE" ? 'Sim' : 'Não',
                'tipo' => $dadoBanca['vinptpbantrb'] == "SUP" ? 'Suplente' : 'Titular',
            ];
        }
        $agendamento->bancas()->createMany($bancas);
    }
}
