<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;

class indexController extends Controller
{
    public function index(Request $request){
        $query = Agendamento::where('data_horario','>=',date('Y-m-d H:i:s'))->orderBy('data_horario', 'asc');
        if($request->busca != ''){
            $query->where('nome', 'LIKE', "%$request->busca%");
        }
        elseif($request->busca_programa != '') {
            $query->where('area_programa', '=', $request->busca_programa);
        } 
        $agendamentos = $query->paginate(20);

        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index')->with('agendamentos',$agendamentos);
    }

    public function anteriores(Request $request){
        $query = Agendamento::where('data_horario','<',date('Y-m-d H:i:s'))->orderBy('data_horario', 'desc');
        if($request->busca != '') {
            $query->where('nome', 'LIKE', "%$request->busca%");
        }
        elseif($request->busca_programa != '') {
            $query->where('area_programa', '=', $request->busca_programa);
        } 
        $agendamentos = $query->paginate(20);

        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('anteriores')->with('agendamentos',$agendamentos);
    }
}
