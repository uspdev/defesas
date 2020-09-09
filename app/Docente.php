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

    public static function statusOptions($request = false){
        $options = [
            ['codstatus' => 'B', 'nomestatus' => 'Brasileiro'],
            ['codstatus' => 'E', 'nomestatus' => 'Estrangeiro'],
        ];

        $options2 = [
            'B',
            'E',
        ];
        if($request == false){
            return $options;
        }
        return $options2;
    }

    public static function docenteUspOptions($request = false){
        $options = [
            ['codoption' => 'sim', 'nomeoption' => 'Sim'],
            ['codoption' => 'nao', 'nomeoption' => 'Não'],
        ];

        $options2 = [
            'sim',
            'nao',
        ];
        if($request == false){
            return $options;
        }
        return $options2;
    }

    public function getBancasProfessor($codpes, $tipo){
        $agendamentos = [];
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
