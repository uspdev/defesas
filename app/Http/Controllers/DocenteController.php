<?php

namespace App\Http\Controllers;

use App\Docente;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\DocenteRequest;
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
    public function index(Request $request)
    {
        $this->authorize('admin');
        $query = Docente::orderBy('nome','asc');
        if($request->filtro_busca == 'docente_usp') {
            $query = $query->where('docente_usp', '=', 'Sim');
        }
        elseif($request->filtro_busca == 'docente_ext'){
            $query = $query->where('docente_usp', '=', 'Não');
        }

        if($request->busca != null){
            $query = $query->where('nome', 'LIKE', "%$request->busca%");
        }
        //dd($query->toSql());
        //$docentes = $query->orderBy('nome','asc')->paginate(30);
        $docentes = $query->paginate(50);
        if ($docentes->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('docentes.index')->with('docentes',$docentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('admin');
        $docente = new Docente;
        return view('docentes.create')->with('docente', $docente);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocenteRequest $request)
    {
        //
        $this->authorize('admin');
        $validated = $request->validated();
        $validated['codultalt'] = Auth::user()->codpes;
        $docente = Docente::create($validated);
        return redirect("/docentes/$docente->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
        $this->authorize('admin');
        return view('docentes.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        //
        $this->authorize('admin');
        return view('docentes.edit')->with('docente', $docente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(DocenteRequest $request, Docente $docente)
    {
        //
        $this->authorize('admin');
        $validated = $request->validated();
        $validated['codultalt'] = Auth::user()->codpes;
        $docente->update($validated);
        return redirect("/docentes/$docente->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        //
        $this->authorize('admin');
        $docente->delete();
        return redirect('/docentes');
    }
}
