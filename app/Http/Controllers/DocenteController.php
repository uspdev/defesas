<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocenteSearchRequest;
use App\Services\ReplicadoService;
use App\Actions\ParticipacaoAction;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');

        return view('docentes.index');
    }

    public function search(DocenteSearchRequest $request) {
        $this->authorize('admin');

        $pessoas = ReplicadoService::getPorCodigoOuNome($request->search);
        return view('docentes.nomes', [
            'pessoas' => $pessoas,
            'search' => $request->search,
        ]);
    }

    public function participacao(int $codpes) {
        $this->authorize('admin');

        $pessoa['nome'] = ReplicadoService::getNome($codpes);
        $bancas = ReplicadoService::getBancasProfessor($codpes);
        if ( $bancas ) {
            $participacao = ParticipacaoAction::handle($bancas);
            $pessoa['email'] = ReplicadoService::getEmail($codpes);
            [$bancasOrientador, $bancasExaminador] = $participacao->partition(function ($item) use ($codpes) {
                return $item['orientador']['codpes'] == $codpes;
            });
        }

        return view('docentes.bancas', [
            'nusp' => $codpes,
            'nome' => $pessoa['nome'],
            'email' => $pessoa['email'],
            'bancasOrientador' => $bancasOrientador->sortBy('id'),
            'bancasExaminador' => $bancasExaminador->sortBy('id')
        ]);
    }

}
