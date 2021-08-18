<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Models\Banca;
use App\Models\Config;
use Carbon\Carbon;
use App\Utils\ReplicadoUtils;
use Uspdev\Replicado\Pessoa;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Bloco destinado aos documentos gerais
    public function gerarDocumentosGerais(Agendamento $agendamento, $tipo){
        $this->authorize('admin');
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento->formatDataHorario($agendamento);
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        if($tipo == 'placa'){
            $pdf = PDF::loadView('pdfs.documentos_gerais.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }

        if($tipo == 'titulares' or $tipo == 'invites'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $bancas = $professores;
        }
        elseif($tipo == 'suplentes'){
            $configs = Config::setConfigOficioSuplente($agendamento);
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Suplente')->get();
            $bancas = $professores;
        }
        else{
            $professores = Banca::where('agendamento_id',$agendamento->id)->get();
            $bancas = $professores;
        }
        $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','configs','bancas']));
        return $pdf->download("$tipo.pdf");
    }

    //Bloco destinado aos documentos individuais
    public function gerarDocumentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $this->authorize('admin');
        $agendamento->formatDataHorario($agendamento);
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        if($tipo == 'titular' or $tipo == 'declaracao' or $tipo == 'invite' or $tipo == 'statement'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $professor = $banca;
            if($tipo == 'declaracao'){
                $configs = Config::setConfigDeclaracao($agendamento,$professores,$professor);
            }
            elseif($tipo == 'statement'){
                $configs = Config::setConfigStatement($agendamento,$professores,$professor);
            }
            else{
                $configs = Config::orderbyDesc('created_at')->first();
            }
            $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professores','professor','configs']));
            $docente = Docente::where('n_usp', '=', $banca->codpes)->first();
            if($docente == null){
                $nome = 'Professor';
            }
            else{
                $nome = $docente->nome;
            }
            return $pdf->download("$nome - $tipo.pdf");
        }
        elseif($tipo == 'suplente'){
            $configs = Config::setConfigOficioSuplente($agendamento);
            $professor = $banca;
            $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professor','configs']));
            $docente = Docente::where('n_usp', '=', $banca->codpes)->first();
            if($docente == null){
                $nome = 'Professor';
            }
            else{
                $nome = $docente->nome;
            }
            return $pdf->download("$nome - $tipo.pdf");
        }
    }

    //Função única para geração de Proex, Proap, Passagem e Passagem Auxilio
    public function gerarRecibosAuxilios(Agendamento $agendamento, Banca $banca, Request $request, $tipo){
        $this->authorize('admin');
        $dados = $request;
        $agendamento->formatDataHorario($agendamento);
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        $configs = Config::orderbyDesc('created_at')->first();
        $docente = Docente::where('n_usp', '=', $banca->codpes)->first();
        if($docente == null){
            $nome = 'Professor';
        }
        else{
            $nome = $docente->nome;
        }
        $pdf = PDF::loadView("pdfs.recibos.$tipo", compact(['agendamento','banca','dados','configs']));
        return $pdf->download("$nome - $tipo.pdf");
    }
}
