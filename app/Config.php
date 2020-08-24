<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agendamento;

class Config extends Model
{
    protected $guarded = ['id'];

    //Função para modificar a mensagem padrão do Ofício de Suplente(s)
    public static function setConfigOficioSuplente($agendamento){
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $configs['oficio_suplente'] = str_replace(
            ["%data_oficio_suplente","%nome_sala","%predio"], 
            [strftime('%d de %B de %Y', strtotime($agendamento->data_horario))." - ". $agendamento['horario'], $agendamento['sala'], 'FFLCH'], 
            $configs['oficio_suplente']
        );
        return $configs;
    }

    //Função para modificar a mensagem padrão da Declaração
    public static function setConfigDeclaracao($agendamento, $professores, $professor){
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['declaracao'] = str_replace(
            ["%docente_nome","%nivel","%candidato_nome", "%titulo", "%area"], 
            [$professor['nome'],$agendamento['nivel'], $agendamento['nome'], $agendamento['titulo'], $agendamento['area_programa']], 
            $configs['declaracao']
        );
        foreach($professores as $presidente){
            if($presidente['presidente'] == 'Sim'){
                $configs['declaracao'] = str_replace("%orientador", $presidente['nome'], $configs['declaracao']);
            }
        }
        return $configs;
    }

    //Função para modificar o email padrão para docente externo
    public static function setConfigEmail($agendamento, $professor){
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $configs['mail_docente'] = str_replace(
            ["%docente_nome","%candidato_nome", "%data_defesa", "%local_defesa"], 
            [$professor['nome'],$agendamento['nome'], strftime("%d de %B de %Y", strtotime($agendamento->data_horario))." às ".$agendamento->horario, $agendamento['sala']], 
            $configs['mail_docente']
        );
        return $configs;
    }
}
