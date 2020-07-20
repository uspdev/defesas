<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banca extends Model
{
    protected $guarded = ['id'];

    public function agendamento()
    {
        return $this->belongsTo('App\Agendamento');
    }

    public static function presidenteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    public static function tipoOptions(){
        return [
            'Titular',
            'Suplente'
        ];
    }
}
