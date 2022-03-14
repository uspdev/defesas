<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Storage;
use Auth;
use App\Utils\ReplicadoUtils;

class FileController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('biblioteca');
        $query = File::where('status',0);
        $files = $query->paginate(20);
        
        if ($files->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        
        return view('files.index')->with('files',$files);
    }

    public function edit(File $file){
        $this->authorize('biblioteca');
        $agendamento = $file->agendamento;
        $agendamento->formatDataHorario($agendamento);
        $agendamento->nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento->area_programa);
        return view('files.edit', compact('file', 'agendamento'));
    }

    public function update(File $file, Request $request){
        $this->authorize('biblioteca');
        $validated = $request->validate([
            'status' => 'required',
            'url' => 'required',
        ]);
        $validated['user_id_biblioteca'] = Auth::user()->id;
        if($validated['status'] == "1") $validated['status'] = 1;
        $file->update($validated);
        return redirect("/agendamentos/".$file->agendamento->id);
    }

    public function store(Request $request){
        $this->authorize('admin');
        $request->validate([
            'file' => 'required|mimetypes:application/pdf|max:61440',
            'tipo' => 'required',
            'agendamento_id' => 'required|integer|exists:agendamentos,id', 
        ]);
        $file = new File;
        $file->agendamento_id = $request->agendamento_id;
        $file->original_name = $request->file('file')->getClientOriginalName();
        $file->path = $request->file('file')->store('.');
        $file->tipo = $request->tipo;
        $file->status = 0;
        $file->user_id_admin = Auth::user()->id;
        $file->save();
        return back();
    }

    public function show(File $file){
        $this->authorize('biblioteca');
        return Storage::download($file->path, $file->original_name);
    }

    public function destroy(File $file){
        $this->authorize('admin');
        if($file->status == 0 && $file->user_id_biblioteca == null){
            Storage::delete($file->path);
            $file->delete();
        }
        else{
            $request->session()->flash('alert-danger', 'Não é possível excluir um arquivo já publicado!');
        }
        return back();
    }
}
