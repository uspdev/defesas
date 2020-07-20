<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agendamento;
use App\Banca;

class PdfController extends Controller
{
    public function documentosGerais(Agendamento $agendamento, $tipo){
        $agendamento->setDataHorario($agendamento);
        if($tipo == 'placa'){
            $pdf = PDF::loadView('pdfs.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }
        elseif($tipo == 'titulares'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores']));
            return $pdf->download("$tipo.pdf");
        }
        elseif($tipo == 'suplentes'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'suplente')->get();
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores']));
            return $pdf->download("$tipo.pdf");
        }
        else{
            $professores = Banca::where('agendamento_id',$agendamento->id)->get();
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores']));
            return $pdf->download("$tipo.pdf");
        }
    }

    public function documentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $agendamento->setDataHorario($agendamento);
        if($tipo == 'titular' or $tipo == 'declaracao'){
            $professores = Banca::where('agendamento_id',$agendamento->id)->where('tipo', 'Titular')->get();
            $professor = $banca;
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professores','professor']));
            return $pdf->download("$tipo.pdf");
        }
        elseif($tipo == 'suplente'){
            $professor = $banca;
            $pdf = PDF::loadView("pdfs.$tipo", compact(['agendamento','professor']));
            return $pdf->download("$tipo.pdf");
        }
    }
}
