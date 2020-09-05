<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Docente;
class Banca extends Model
{
    protected $guarded = ['id'];

    public function agendamento()
    {
        return $this->belongsTo('App\Agendamento');
    }

    //Função para devolver valores de select
    public static function presidenteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    //Função para devolver valores de select
    public static function tipoOptions(){
        return [
            'Titular',
            'Suplente'
        ];
    }

    public static function getDadosProfessor($codpes){
        return Docente::where('n_usp',$codpes)->first();
    }
}
