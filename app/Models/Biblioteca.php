<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use Illuminate\Http\Request;

class Biblioteca
{
    public static function returnSchedules(Request $request, $status = 0){        
        $query = Agendamento::where('status', $status)->orderBy('data_horario', 'asc');
        
        $query->when($request->term, function($query) use ($request){
            $query->where(function($query) use($request){
                $query->orWhere('nome', 'LIKE', "%$request->term%");
                $query->orWhere('codpes', '=', "$request->term");
            });
        });

        return $query->paginate(20);
    }

}
