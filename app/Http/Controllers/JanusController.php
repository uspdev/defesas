<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;
use App\Http\Requests\JanusRequest;
use App\Models\Banca;
use Carbon\Carbon;

class JanusController extends Controller
{
    public function create(Agendamento $agendamento){
        return view('agendamentos.janus.create', compact('agendamento'));
    }

    public function store(JanusRequest $request, ReplicadoUtils $replicado, Agendamento $agendamento){
        $dadosJanus = ReplicadoUtils::retornarDadosJanus($request->codpes)[0] ?? '';
        $agendamentosInfo = ReplicadoUtils::retornarAgendamentoInfos($request->codpes) ?? '';
        if(!empty($dadosJanus) && !empty($agendamentosInfo)){
            $agendamento->codpes = $request->codpes;
            $agendamento->nome = $agendamento::dadosPessoa($request->codpes)['nompes'];
            $agendamento->titulo = $dadosJanus['tittrb'];
            $agendamento->area_programa = $agendamentosInfo['codare'];
            $agendamento->regimento = $request->regimento;
            $agendamento->orientador_votante = $request->orientador_votante;
            $agendamento->nivel = $agendamentosInfo['nivpgm'] == "ME" ? 'Mestrado' : 'Doutorado';
            $agendamento->sala = $request->sala;
            $agendamento->data_horario = Carbon::createFromFormat('d/m/Y H:i',$request->data . $request->horario)->format('Y-m-d H:i');
            $data = $replicado::retornarDadosBanca($agendamento->codpes);
            $resultado = array_filter($data, function($item){
                return $item['vinptpbantrb'] == "PRE";
            });
            $agendamento->orientador = $resultado[0]['codpesdct'];
            $agendamento->resumo = $dadosJanus['rsutrb'];
            $agendamento->tipo = $request->tipo_defesa;
            $agendamento->save();
            
            $dadosBanca = $replicado::retornarDadosBanca($request->codpes);
            
            $primeiro = true;
            foreach($dadosBanca as $dadoBanca){
                $banca = new Banca;
                $banca->agendamento_id = $agendamento->id;
                $banca->codpes = $dadoBanca['codpesdct'];
                $banca->presidente = $primeiro ? 'Sim' : 'Não';
                $banca->tipo = $dadoBanca['vinptpbantrb'] == "SUP" ? 'Suplente' : 'Titular';
                $banca->nome = $dadoBanca['nompes'];
                $agendamento->bancas()->save($banca);
                $primeiro = false;
            }

        }else{
            request()->session()->flash('alert-danger','Nenhum usuário com agendamento encontrado no Janus!');
            return redirect('/janus/create');
        }
        return redirect("/agendamentos/$agendamento->id");
    }

}
