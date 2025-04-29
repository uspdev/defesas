<?php

namespace App\Models;

use App\Models\Agendamento;
use Illuminate\Http\Request;

class Biblioteca
{
    public static function returnSchedules(Request $request, $status = 0){
        $query = Agendamento::where('status', $status)
        ->where('data_horario','<',now())
        ->orderBy('data_horario', 'asc');

        $query->when($request->term, function($query) use ($request){
            $query->where(function($query) use($request){
                $query->orWhere('codpes', '=', "$request->term");
            });
        });

        return $query->paginate(20);
    }

}
