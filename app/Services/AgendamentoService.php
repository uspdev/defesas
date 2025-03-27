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

    public function newAgendamento(array $agendamentoData, array $alunoPos): Agendamento {
        $agendamento = new Agendamento();
        $agendamento->codpes = $agendamentoData['codpes'];
        $agendamento->sala = $agendamentoData['sala'];
        $agendamento->tipo = $agendamentoData['tipo_defesa'];
        $agendamento->data_horario = Carbon::createFromFormat('d/m/Y H:i', $agendamentoData['data'] . $agendamentoData['horario'])->format('Y-m-d H:i');
        $agendamento->sala_virtual = $agendamentoData['sala_virtual'] ?? NULL;
        $agendamento->codare = $alunoPos['codare'];
        $agendamento->nivpgm = $alunoPos['nivpgm'];
        $agendamento->numseqpgm = $alunoPos['numseqpgm'];
        #$agendamento->nome = $dadosJanus['nompes'];
        #Apagar as linhas abaixo, isso é para teste somente
        $agendamento->titulo = 'teste';
        $agendamento->area_programa = 123;
        $agendamento->nivel = 'teste';
        $agendamento->orientador = 'teste';
        #$agendamento->resumo = $dadosJanus['rsutrb'];
        $agendamento->save();

        return $agendamento;
    }

    #public function newBanca(Agendamento $agendamento, int $codpes, int $numseqpgm) {
    #    $dadosBanca = ReplicadoUtils::retornarDadosBanca($codpes, $numseqpgm);
    #    $bancas = [];
    #    foreach($dadosBanca as $dadoBanca){
    #        DocenteAction::handle($dadoBanca['codpesdct'], $dadoBanca['nompes']);
    #        $bancas[] = [
    #            'codpes' => $dadoBanca['codpesdct'],
    #            'nome' => $dadoBanca['nompes'],
    #            'presidente' => $dadoBanca['vinptpbantrb'] == "PRE" ? 'Sim' : 'Não',
    #            'tipo' => $dadoBanca['vinptpbantrb'] == "SUP" ? 'Suplente' : 'Titular',
    #        ];
    #    }
    #    $agendamento->bancas()->createMany($bancas);
    #}
}
