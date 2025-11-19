<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Services\ReplicadoService;
use App\Http\Requests\AnteriorRequest;
use App\Actions\DefesasAnterioresAction;
use App\Actions\DadosDefesasAction;

class AnteriorController extends Controller
{
    protected $programas;
    protected $niveis;
    protected $areas;

    public function __construct() {
        $this->programas = collect(ReplicadoService::getProgramas());
        $this->niveis = Agendamento::nivelOptions();
        $this->areas = $this->programas->map(function ($item) {
            return $item['codare'];
        });
    }

    public function index()
    {
        return view('anterior', [
            'programas' => $this->programas,
            'niveis' => $this->niveis,
            'defesas' => []
        ]);
    }

    public function search(AnteriorRequest $request)
    {
        $agendamentos = (DefesasAnterioresAction::handle($request->validated()))
            ->paginate(20)
            ->appends($request->query());
        $defesas = DadosDefesasAction::handle($agendamentos);

        return view('anterior', [
            'programas' => $this->programas,
            'niveis' => $this->niveis,
            'defesas' => $defesas,
            'agendamentos' => $agendamentos
        ]);
    }

}
