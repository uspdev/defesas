<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    //
    protected $guarded = ['id'];

    public static function documentoOptions(){
        return [
            'RG',
            'Passaporte',
            'RNE',
        ];
    }

    public static function statusOptions(){
        return [
            'Brasileiro',
            'Estrangeiro'
        ];
    }

    public static function docenteUspOptions(){
        return [
            'Sim',
            'Não'
        ];
    }
}
