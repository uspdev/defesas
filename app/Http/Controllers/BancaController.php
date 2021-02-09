<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Banca;
use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Requests\BancaRequest;
use Uspdev\Replicado\Pessoa;

class BancaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(BancaRequest $request)
    {
        $this->authorize('admin');
        $banca = new Banca;
        $validated = $request->validated();
        Banca::create($validated);
        return back();
    }

    public function destroy(Agendamento $agendamento, Banca $banca)
    {
        $this->authorize('admin');
        $banca->delete();
        return back();
    }
}
