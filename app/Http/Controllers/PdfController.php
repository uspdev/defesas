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
use App\Actions\DocentesParticipacaoAction;

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
            $professores = EnderecoDocenteExternoAction::handle(DocentesParticipacaoAction::handle($agendamento->banca));
        };
        if ($tipo === 'recibos') {
            $professores = TitularesAction::handle($agendamento->banca);
        }
        if ($tipo === 'etiqueta') {
            $professores = EnderecoDocenteExternoAction::handle(TitularesAction::handle($agendamento->banca)->merge(
                SuplentesAction::handle($agendamento->banca)));
        }
        $bancas = $professores;
        $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','configs','bancas']));

        return $pdf->download("$tipo.pdf");
    }

    public function declaracao(Agendamento $agendamento, $codpes) {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $professores = DocentesParticipacaoAction::handle($agendamento->banca);
        $professor = DocenteAction::handle($professores, $codpes);
        config(['laravel-fflch-pdf.setor' => "Serviço de Pós-Graduação"]);
        $configs = Config::setConfigDeclaracao($agendamento, $professor['nompesttd']);
        $pdf = pdf::loadView("pdfs.documentos_bancas.declaracao", compact(['agendamento','professores','professor','configs']));

        return $pdf->download($professor['nompesttd'] . " - declaracao.pdf");

    }

    public function statement(Agendamento $agendamento, $codpes) {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $professores = DocentesParticipacaoAction::handle($agendamento->banca);
        $professor = DocenteAction::handle($professores, $codpes);
        config(['laravel-fflch-pdf.setor' => "Graduate Service"]);
        $configs = Config::setConfigStatement($agendamento, $professor['nompesttd']);
        $pdf = pdf::loadView("pdfs.documentos_bancas.statement", compact(['agendamento','professores','professor','configs']));

        return $pdf->download($professor['nompesttd'] . " - declaracao.pdf");

    }

    public function suplente(Agendamento $agendamento, $codpes) {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        config(['laravel-fflch-pdf.setor' => "Serviço de Pós-Graduação"]);
        $configs = Config::setConfigOficioSuplente($agendamento);
        $professor = DocenteAction::handle(collect($agendamento->banca), $codpes);
        $pdf = PDF::loadView("pdfs.documentos_bancas.suplente", compact(['agendamento','professor','configs']));

        return $pdf->download($professor['nompesttd'] . " - suplente.pdf");
    }

    public function titular(Agendamento $agendamento, $codpes) {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $professores = TitularesAction::handle($agendamento->banca);
        $professor = DocenteAction::handle($professores, $codpes);
        config(['laravel-fflch-pdf.setor' => "Serviço de Pós-Graduação"]);
        $configs = Config::orderbyDesc('created_at')->first();
        $pdf = PDF::loadView("pdfs.documentos_bancas.titular", compact(['agendamento','professores','professor','configs']));

        return $pdf->download($professor['nompesttd'] . " - titular.pdf");
    }

    public function invite(Agendamento $agendamento, $codpes) {
        $this->authorize('admin');
        $agendamento = DadosJanusAction::handle($agendamento);
        $professores = TitularesAction::handle($agendamento->banca);
        $professor = DocenteAction::handle($professores, $codpes);
        config(['laravel-fflch-pdf.setor' => "Graduate Service"]);
        $configs = Config::orderbyDesc('created_at')->first();
        $pdf = PDF::loadView("pdfs.documentos_bancas.invite", compact(['agendamento','professores','professor','configs']));

        return $pdf->download($professor['nompesttd'] . " - invite.pdf");
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
