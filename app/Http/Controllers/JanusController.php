<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;
use App\Http\Requests\JanusRequest;
use App\Models\Banca;

class JanusController extends Controller
{
    public function create(Agendamento $agendamento){
        return view('agendamentos.janus.create', compact('agendamento'));
    }

    public function store(JanusRequest $request, ReplicadoUtils $replicado, Agendamento $agendamento){
        if(!empty($replicado::retornarDadosJanus($request->codpes)[0])){
            $dadosJanus = $replicado::retornarDadosJanus($request->codpes)[0];
            $agendamento->codpes = $request->codpes;
            $agendamento->nome = $agendamento::dadosPessoa($request->codpes)['nompes'];
            $agendamento->titulo = $replicado::retornarDadosJanus($agendamento->codpes)[0]['tittrb'];
            $agendamento->area_programa = $replicado::retornarAgendamentoInfos($request->codpes)['codare'];
            $agendamento->regimento = 'A DEFINIR';
            $agendamento->orientador_votante = 'A DEFINIR';
            if($replicado::retornarAgendamentoInfos($request->codpes)['nivpgm'] == "ME"){
                $agendamento->nivel = 'Mestrado';
            }else{
                $agendamento->nivel = 'Doutorado';
            }
            $agendamento->sala = 'A DEFINIR';
            $agendamento->data_horario = '2025-12-31 22:00:00';
            $data = $replicado::retornarDadosBanca($agendamento->codpes);
            $resultado = array_filter($data, function($item){
                return $item['vinptpbantrb'] == "PRE";
            });
            
            $agendamento->orientador = $resultado[0]['codpesdct'];
            $agendamento->resumo = $dadosJanus['rsutrb'];
            $agendamento->tipo = 'A DEFINIR';
            $agendamento->save();
            
            $dadosBanca = $replicado::retornarDadosBanca($request->codpes);
            
            foreach($dadosBanca as $dadoBanca){
                $banca = new Banca;
                $banca->agendamento_id = $agendamento->id;
                $banca->codpes = $dadoBanca['codpesdct'];
                $banca->presidente = 'Sim';
                if($dadoBanca['vinptpbantrb'] == "SUP"){
                    $banca->tipo = "Suplente";
                }else{
                    $banca->tipo = "Titular";
                }
                $banca->nome = $dadoBanca['nompes'];
                $agendamento->bancas()->save($banca);
            }

        }else{
            request()->session()->flash('alert-danger','Nenhum usuário com agendamento encontrado no Janus!');
            return redirect('/janus/create');
        }
        return redirect("/agendamentos/$agendamento->id");
    }

}
