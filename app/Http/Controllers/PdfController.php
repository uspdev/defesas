<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agendamento;
use App\Banca;
use App\Config;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Bloco destinado aos documentos gerais
    public function documentosGerais(Agendamento $agendamento, $tipo){
        $this->authorize('logado');
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento->setDataHorario($agendamento);
        if($tipo == 'placa'){
            $pdf = PDF::loadView('pdfs.documentos_gerais.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }
        elseif($tipo == 'titulares'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','configs','bancas']));
            return $pdf->download("$tipo.pdf");
        }
        elseif($tipo == 'suplentes'){
            $configs = Config::setConfigOficioSuplente($agendamento);
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Suplente')->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','configs','bancas']));
            return $pdf->download("$tipo.pdf");
        }
        else{
            $professores = Banca::where('agendamento_id',$agendamento->id)->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','bancas','configs']));
            return $pdf->download("$tipo.pdf");
        }
    }

    //Bloco destinado aos documentos individuais
    public function documentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $this->authorize('logado');
        $agendamento->setDataHorario($agendamento);
        if($tipo == 'titular' or $tipo == 'declaracao'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $professor = $banca;
            if($tipo == 'declaracao'){
                $configs = Config::setConfigDeclaracao($agendamento,$professores,$professor);
            }
            else{
                $configs = Config::orderbyDesc('created_at')->first();
            }
            $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professores','professor','configs']));
            return $pdf->download("$tipo.pdf");
        }
        elseif($tipo == 'suplente'){
            $configs = Config::setConfigOficioSuplente($agendamento);
            $professor = $banca;
            $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professor','configs']));
            return $pdf->download("$tipo.pdf");
        }
    }

    public function pdfRecibos(){
        $this->authorize('logado');
        
    }
}
