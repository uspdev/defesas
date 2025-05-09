<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;

class indexController extends Controller
{
    public function index(Request $request){
        $request->validate([
            'busca_programa' => ['nullable',Rule::in(Agendamento::devolverCodProgramas())],
            'busca_nivel' => ['nullable',Rule::in(Agendamento::nivelOptions())],
        ]);
        $query = Agendamento::join('docentes', 'docentes.n_usp', '=', 'agendamentos.orientador')->where('agendamentos.data_horario','>=',date('Y-m-d H:i:s'))->orderBy('agendamentos.data_horario', 'asc')->select('agendamentos.*');
        if($request->busca_nivel != '') {
            $query->where('agendamentos.nivel', '=', $request->busca_nivel);
        }
        if($request->busca_programa != '') {
            $query->where('agendamentos.area_programa', '=', $request->busca_programa);
        }
        if($request->busca != ''){
            $query->where(function($query) use($request){
                $query->orWhere('agendamentos.nome', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.titulo', 'LIKE', "%$request->busca%");
                $query->orWhere('docentes.nome', 'LIKE', "%$request->busca%");
            });
        }
        $agendamentos = $query->paginate(20);

        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index')->with('agendamentos',$agendamentos);
    }

    public function exibirDefesasAnteriores(Request $request){
        $request->validate([
            'busca_programa' => ['nullable',Rule::in(Agendamento::devolverCodProgramas())],
            'busca_nivel' => ['nullable',Rule::in(Agendamento::nivelOptions())],
        ]);
        $query = Agendamento::join('docentes', 'docentes.n_usp', '=', 'agendamentos.orientador')->where('data_horario','<',date('Y-m-d H:i:s'))->orderBy('data_horario', 'desc')->select('agendamentos.*');
        if($request->busca_nivel != '') {
            $query->where('agendamentos.nivel', '=', $request->busca_nivel);
        }
        if($request->busca_programa != '') {
            $query->where('agendamentos.area_programa', '=', $request->busca_programa);
        }
        if($request->busca != '') {
            $query->where(function($query) use($request){
                $query->orWhere('agendamentos.nome', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.titulo', 'LIKE', "%$request->busca%");
                $query->orWhere('docentes.nome', 'LIKE', "%$request->busca%");
            });
        }

        $agendamentos = $query->paginate(20);

        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('anteriores')->with('agendamentos',$agendamentos);
    }
}
