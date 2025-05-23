<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Agendamento;
use App\Models\Config;
use App\Actions\DadosJanusAction;
use App\Actions\TitularesAction;
use App\Actions\SuplentesAction;
use App\Actions\DocenteAction;
use App\Services\ReplicadoService;
use App\Actions\EnderecoDocenteExternoAction;

class PdfController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    //Bloco destinado aos documentos gerais
    public function gerarDocumentosGerais(Agendamento $agendamento, $tipo){
        $this->authorize('admin');
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento = DadosJanusAction::handle($agendamento);
        if($tipo === 'placa'){
            $pdf = PDF::loadView('pdfs.documentos_gerais.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }
        config(['laravel-fflch-pdf.setor' => "Serviço de Pós-Graduação"]);
        if ($tipo === 'documento_zero') {
            $professores = EnderecoDocenteExternoAction::handle(TitularesAction::handle($agendamento->banca));
        };
        if ($tipo === 'recibos') {
            $professores = TitularesAction::handle($agendamento->banca);
        }
        if ($tipo === 'etiqueta') {
            $professores = EnderecoDocenteExternoAction::handle(TitularesAction::handle($agendamento->banca))->merge(
                SuplentesAction::handle($agendamento->banca));
        }
        $bancas = $professores;
        $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','configs','bancas']));

        return $pdf->download("$tipo.pdf");
    }

    //Bloco destinado aos documentos individuais
    public function gerarDocumentosIndividuais(Agendamento $agendamento, $codpes, $tipo){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        if($tipo == 'statement' or $tipo == 'invite'){
            config(['laravel-fflch-pdf.setor' => "Graduate Service"]);
        }
        else{
            config(['laravel-fflch-pdf.setor' => "Serviço de Pós-Graduação"]);
        }
        if($tipo == 'titular' or $tipo == 'declaracao' or $tipo == 'invite' or $tipo == 'statement'){
            $professores = TitularesAction::handle($agendamento->banca);
            $professor = DocenteAction::handle($professores, $codpes);
            if($tipo == 'declaracao'){
                $configs = Config::setConfigDeclaracao($agendamento, $professor['nompesttd']);
            }
            elseif($tipo == 'statement'){
                $configs = Config::setConfigStatement($agendamento, $professor['nompesttd']);
            }
            else{
                $configs = Config::orderbyDesc('created_at')->first();
            }
            $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professores','professor','configs']));
        }
        elseif($tipo == 'suplente'){
            $configs = Config::setConfigOficioSuplente($agendamento);
            $professor = DocenteAction::handle(collect($agendamento->banca), $codpes);
            $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professor','configs']));
        }
        $nome = $professor['nompesttd'] ?? 'Professor';

        return $pdf->download("$nome - $tipo.pdf");
    }

    //Função única para geração de Proex, Proap, Passagem e Passagem Auxilio
    public function gerarRecibosAuxilios(Agendamento $agendamento, $codpes, Request $request, $tipo){
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $coordenador = ReplicadoService::getCoordenadorArea($agendamento->codare, env('REPLICADO_CODUNDCLG'));
        $dados = $request;
        $configs = Config::orderbyDesc('created_at')->first();
        $docente = DocenteAction::handle(collect($agendamento->banca), $codpes);
        if($tipo == 'auxilio_passagem'){
            config(['laravel-fflch-pdf.setor' => "Serviço de Compras"]);
        }
        else{
            config(['laravel-fflch-pdf.setor' => "Serviço de Pós-Graduação"]);
        }
        $nome = $docente['nompesttd'] ?? 'Professor';
        $pdf = PDF::loadView("pdfs.recibos.$tipo", compact(['agendamento', 'coordenador', 'docente','dados','configs']));

        return $pdf->download("$nome - $tipo.pdf");
    }
}
