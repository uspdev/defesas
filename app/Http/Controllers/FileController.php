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
        $file = new File;
        $file->agendamento_id = $request->agendamento_id;
        $file->original_name = $request->file('file')->getClientOriginalName();
        $file->path = $request->file('file')->store('.');
        $file->tipo = $request->tipo;
        $file->user_id_admin = Auth::user()->id;
        $file->save();
        Agendamento::where('id', $request->agendamento_id)->update(['status' => 0]);
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
