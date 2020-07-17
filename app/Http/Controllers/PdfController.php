<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agendamento;
use App\Banca;

class PdfController extends Controller
{
    public function documento_zero(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $pdf = PDF::loadView('pdfs.documento_zero', compact(['agendamento','professores']));
        return $pdf->download('documento_zero.pdf');
    }

    public function placa(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $pdf = PDF::loadView('pdfs.placa', compact('agendamento'))->setPaper('a4', 'landscape');
        return $pdf->download('placa.pdf');
    }

    public function etiqueta(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $pdf = PDF::loadView('pdfs.etiqueta', compact(['agendamento','professores']));
        return $pdf->download('etiqueta.pdf');
    }

    public function titulares(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $pdf = PDF::loadView('pdfs.titulares', compact(['agendamento','professores']));
        return $pdf->download('titulares.pdf');
    }

    public function suplentes(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $pdf = PDF::loadView('pdfs.suplentes', compact(['agendamento','professores']));
        return $pdf->download('suplentes.pdf');
    }

    public function declaracao(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $pdf = PDF::loadView('pdfs.declaracao', compact(['agendamento','professores']));
        return $pdf->download('declaracao.pdf');
    }

    public function recibos(Agendamento $agendamento){
        $agendamento->setDataHorario($agendamento);
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $pdf = PDF::loadView('pdfs.recibos', compact(['agendamento','professores']));
        return $pdf->download('recibos.pdf');
    }
}
