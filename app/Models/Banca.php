<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docente;
use App\Models\Agendamento;

class Banca extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
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
