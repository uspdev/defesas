<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Banca;
use App\Agendamento;
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

    public function getBancasProfessor($codpes, $tipo){
        if($tipo == 'Orientador'){
            $agendamentos = Agendamento::where('orientador',$codpes)->orderBy('data_horario','asc')->get();
        }
        else{
            $bancas = Banca::where('codpes', $codpes)->where('presidente','Não')->get();
            foreach($bancas as $banca){
                $agendamentos[] = Agendamento::where('id', $banca->agendamento_id)->orderBy('data_horario','asc')->get()->toArray();
            }
        }
        return $agendamentos;
    }
}
