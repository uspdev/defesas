<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agendamento;
use Uspdev\Replicado\Pessoa;
use Carbon\Carbon;

class Config extends Model
{
    protected $guarded = ['id'];

    //Função para modificar a mensagem padrão do Ofício de Suplente(s)
    public static function setConfigOficioSuplente($agendamento){
        $configs = Config::orderbyDesc('created_at')->first();
        str_replace(
            ["%data_oficio_suplente","%nome_sala","%predio"], 
            [Carbon::createFromTimeStamp(strtotime($agendamento->data_horario))->formatLocalized('%d de %B de %Y')." - ". $agendamento['horario'], $agendamento['sala'], 'FFLCH'], 
            $configs['oficio_suplente']
        );
        return $configs;
    }

    //Função para modificar a mensagem padrão da Declaração
    public static function setConfigDeclaracao($agendamento, $professores, $professor){
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['declaracao'] = str_replace(
            ["%docente_nome","%nivel","%candidato_nome", "%titulo", "%area"], 
            [Pessoa::dump($professor['codpes'])['nompes'],$agendamento['nivel'], Pessoa::dump($agendamento['codpes'])['nompes'], $agendamento['titulo'], $agendamento['area_programa']], 
            $configs['declaracao']
        );
        foreach($professores as $presidente){
            if($presidente['presidente'] == 'Sim'){
                $configs['declaracao'] = str_replace("%orientador", Pessoa::dump($presidente['codpes'])['nompes'], $configs['declaracao']);
            }
        }
        return $configs;
    }
}
