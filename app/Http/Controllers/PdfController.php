<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agendamento;
use App\Banca;
use App\Config;
use Carbon\Carbon;

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

    public function proex(Agendamento $agendamento, Banca $banca, Request $request){
        $this->authorize('logado');
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $configs = Config::orderbyDesc('created_at')->first();
        $pdf = PDF::loadView("pdfs.recibos.proex", compact(['agendamento','banca','dados','configs']));
        return $pdf->download("proex.pdf");    }

    public function proap(Agendamento $agendamento, Banca $banca, Request $request){
        $this->authorize('logado');
        $dados = $request;
        $agendamento->data = Carbon::parse($agendamento->data_horario)->format('m');
        $configs = Config::orderbyDesc('created_at')->first();
        $pdf = PDF::loadView("pdfs.recibos.proap", compact(['agendamento','banca','dados','configs']));
        return $pdf->download("proap.pdf");
    }

    public function passagem(Agendamento $agendamento, Banca $banca, Request $request){
        $this->authorize('logado');
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $configs = Config::orderbyDesc('created_at')->first();
        $pdf = PDF::loadView("pdfs.recibos.passagem", compact(['agendamento','banca','dados','configs']));
        return $pdf->download("passagem.pdf");
    }

    public function passagemAuxilio(Agendamento $agendamento, Banca $banca, Request $request){
        $this->authorize('logado');
        $dados = $request;
        $agendamento->setDataHorario($agendamento);
        $configs = Config::orderbyDesc('created_at')->first();
        $pdf = PDF::loadView("pdfs.recibos.passagemAuxilio", compact(['agendamento','banca','dados','configs']));
        return $pdf->download("passagemAuxilio.pdf");
    }
}
