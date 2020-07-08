<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Agendamento;

class PdfController extends Controller
{
    public function documento_zero(Agendamento $agendamento){
        
        $pdf = PDF::loadView('pdfs.documento_zero', compact('agendamento'));
        return $pdf->download('documento_zero.pdf');
    }
}
