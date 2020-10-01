<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Docente;

class indexController extends Controller
{
    public function index(Request $request){
        $query = Agendamento::where('data_horario','>=',date('Y-m-d H:i:s'))->orderBy('data_horario', 'asc');
        $query2 = Docente::orderBy('nome', 'asc');
        if($request->busca != ''){
            $query->where('nome', 'LIKE', "%$request->busca%");
            $query->orWhere('titulo', 'LIKE', "%$request->busca%");
            $query2->where('nome', 'LIKE', "%$request->busca%");
            foreach($query2->get() as $orientador){
                $query->orWhere('orientador', '=', $orientador->n_usp);
            }
        }
        if($request->programa != '' and $request->busca_programa != '') {
            $query->where('area_programa', '=', $request->busca_programa);
        }
        if($request->nivel != '' and $request->busca_nivel != '') {
            $query->where('nivel', '=', $request->busca_nivel);
        } 
        $agendamentos = $query->paginate(20);

        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index')->with('agendamentos',$agendamentos);
    }

    public function anteriores(Request $request){
        $query = Agendamento::where('data_horario','<',date('Y-m-d H:i:s'))->orderBy('data_horario', 'desc');
        $query2 = Docente::orderBy('nome', 'asc');
        if($request->busca != '') {
            $query->where('nome', 'LIKE', "%$request->busca%");
            $query->orWhere('titulo', 'LIKE', "%$request->busca%");
            $query2->where('nome', 'LIKE', "%$request->busca%");
            foreach($query2->get() as $orientador){
                $query->orWhere('orientador', '=', $orientador->n_usp);
            }
        }
        if($request->programa == 'on') {
            $query->where('area_programa', $request->busca_programa);
        }
        if($request->nivel == 'on') {
            $query->where('nivel', $request->busca_nivel);
        } 
        $agendamentos = $query->paginate(20);

        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('anteriores')->with('agendamentos',$agendamentos);
    }
}
