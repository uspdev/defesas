<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Storage;
use Auth;
use App\Utils\ReplicadoUtils;
use App\Models\Agendamento;

class FileController extends Controller
{
    public function store(Request $request){
        $this->authorize('admin');
        $request->validate([
            'file' => 'required|mimetypes:application/pdf|max:122880',
            'tipo' => 'required',
            'agendamento_id' => 'required|integer|exists:agendamentos,id',
        ]);

        $agendamento = Agendamento::find($request->agendamento_id);
        if($agendamento->status == 0 && $agendamento->user_id_biblioteca == null){
            $file = new File;
            $file->agendamento_id = $request->agendamento_id;
            $file->original_name = $request->file('file')->getClientOriginalName();
            $file->path = $request->file('file')->store('.');
            $file->tipo = $request->tipo;
            $file->user_id_admin = Auth::user()->id;
            $file->save();
        }
        else{
            session()->flash('alert-danger', 'Não é possível adicionar outro arquivo, pois a defesa já foi publicada!');
        }

        return back();
    }

    public function show(File $file){
        $this->authorize('biblioteca');
        return Storage::download($file->path, $file->original_name);
    }

    public function destroy(File $file, Request $request){
        $this->authorize('admin');
        $agendamento = Agendamento::find($file->agendamento_id);
        if($agendamento->status == 0 && $agendamento->user_id_biblioteca == null){
            Storage::delete($file->path);
            $file->delete();
        }
        else{
            session()->flash('alert-danger', 'Não é possível excluir um arquivo já publicado!');
        }
        return back();
    }
}
