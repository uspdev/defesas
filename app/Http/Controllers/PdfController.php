<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agendamento;
use App\Banca;
use App\Config;

class PdfController extends Controller
{

    public function documentosGerais(Agendamento $agendamento, $tipo){
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento->setDataHorario($agendamento);
        if($tipo == 'placa'){
            $pdf = PDF::loadView('pdfs.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }
        elseif($tipo == 'titulares'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores','configs','bancas']));
            return $pdf->download("$tipo.pdf");
        }
        elseif($tipo == 'suplentes'){
            $configs = $configs->setConfigOficioSuplente($configs,$agendamento);
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'suplente')->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores','configs','bancas']));
            return $pdf->download("$tipo.pdf");
        }
        else{
            $professores = Banca::where('agendamento_id',$agendamento->id)->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores','bancas','configs']));
            return $pdf->download("$tipo.pdf");
        }
    }

    public function documentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento->setDataHorario($agendamento);
        if($tipo == 'titular' or $tipo == 'declaracao'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $professor = $banca;
            if($tipo == 'declaracao'){
                $configs = $configs->setConfigDeclaracao($configs,$agendamento,$professores,$professor);
            }
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores','professor','configs']));
            return $pdf->download("$tipo.pdf");
        }
        elseif($tipo == 'suplente'){
            $configs = $configs->setConfigOficioSuplente($configs,$agendamento);
            $professor = $banca;
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professor','configs']));
            return $pdf->download("$tipo.pdf");
        }
    }
}
