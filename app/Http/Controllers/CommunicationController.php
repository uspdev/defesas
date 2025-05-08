<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;
use Illuminate\Support\Carbon;
use App\Services\ReplicadoService;
use App\Actions\DadosJanusAction;

class CommunicationController extends Controller
{
    public function index(){
        Gate::authorize('comunicacao');

        $agendamentos = Agendamento::select(['id', 'codpes', 'codare', 'numseqpgm', 'data_horario'])
            ->orderBy('data_horario','desc')
            ->where('data_horario',">=", Carbon::now()->subMonths(3))
            ->where('data_horario',"<=", now())
            ->toBase()
            ->paginate(15);

        $defesas = collect($agendamentos->items())->map(function ($item) {
            return [
                'id' => $item->id,
                'titulo' => ReplicadoService::getTituloTrabalho($item->codpes, $item->codare, $item->numseqpgm),
                'nome' => ReplicadoService::getNome($item->codpes),
                'data_horario' => Carbon::parse($item->data_horario)->format('d/m/Y')
            ];
        });

        return view('comunicacao.index', [
            'agendamentos' => $agendamentos,
            'defesas' => $defesas,
        ]);
    }

    public function show(Agendamento $agendamento){
        Gate::authorize('comunicacao');

        $agendamento = DadosJanusAction::handle($agendamento);

        return view('comunicacao.show', ['agendamento' => $agendamento]);
    }
}
