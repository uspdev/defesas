<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;
use App\Services\ReplicadoService;
use App\Actions\DadosDefesasAction;

class IndexController extends Controller
{
    protected $programas;
    protected $nivel;
    protected $areas;

    public function __construct() {
        $this->programas = collect(ReplicadoService::getProgramas());
        $this->nivel = Agendamento::nivelOptions();
        $this->areas = $this->programas->map(function ($item) {
            return $item['codare'];
        });
    }

    public function index(Request $request){
        $request->validate([
            'programa' => ['nullable', Rule::in($this->areas)],
            'nivel' => ['nullable', Rule::in($this->nivel)],
        ]);

        $query = Agendamento::where('data_horario', '>=', now())
            ->orderBy('data_horario')
            ->toBase();

        $query->when($request->programa, function ($q) use ($request) {
            return $q->where('codare', '=', $request->programa);
        });

        $query->when($request->nivel, function ($q) use ($request) {
            $conditional = $request->nivel === 'Mestrado' ? '=' : '<>';
            return $q->where('nivpgm', $conditional, 'ME');
        });

        $agendamentos = $query->paginate(20);
        $defesas = DadosDefesasAction::handle($agendamentos);

        return view('index', [
            'agendamentos' => $agendamentos,
            'programas' => $this->programas,
            'niveis' => $this->nivel,
            'defesas' => $defesas
        ]);
    }

}
