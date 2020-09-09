<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Agendamento;
use Uspdev\Replicado\Pessoa;

class Config extends Model
{
    protected $guarded = ['id'];

    //Função para modificar a mensagem padrão do Ofício de Suplente(s)
    public static function setConfigOficioSuplente($agendamento){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        //Realiza as alterações necessárias
        $configs['oficio_suplente'] = str_replace(
            ["%data_oficio_suplente","%nome_sala","%predio"], 
            [strftime('%d de %B de %Y', strtotime($agendamento->data_horario))." - ". $agendamento['horario'], $agendamento['sala'], 'FFLCH'], 
            $configs['oficio_suplente']
        );
        return $configs;
    }

    //Função para modificar a mensagem padrão da Declaração
    public static function setConfigDeclaracao($agendamento, $professores, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        //Faz as primeiras trocas
        $configs['declaracao'] = str_replace(
            ["%docente_nome","%nivel","%candidato_nome", "%titulo"], 
            [Pessoa::dump($professor->codpes)['nompes'],$agendamento['nivel'], $agendamento['nome'], $agendamento['titulo']], 
            $configs['declaracao']
        );
        //Busca as áreas/programas da unidade
        $programas = $agendamento->programaOptions();
        //Altera de acordo com o código cadastrado no agendamento o nome da área na declaração
        foreach($programas as $p){
            if($agendamento['area_programa'] == $p['codare']){
                $configs['declaracao'] = str_replace("%area", $p['nomare'], $configs['declaracao']);
            }
        }
        //Altera a informação de presidente de acordo com o tipo do professor informado
        foreach($professores as $presidente){
            if($presidente['presidente'] == 'Sim'){
                $configs['declaracao'] = str_replace("%orientador", Pessoa::dump($presidente->codpes)['nompes'], $configs['declaracao']);
            }
        }
        return $configs;
    }

    //Função para modificar o email padrão para docente externo
    public static function setConfigEmail($agendamento, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        //Realiza as alterações necessárias
        $configs['mail_docente'] = str_replace(
            ["%docente_nome","%candidato_nome", "%data_defesa", "%local_defesa"], 
            [Pessoa::dump($professor->codpes)['nompes'],$agendamento['nome'], strftime("%d de %B de %Y", strtotime($agendamento->data_horario))." às ".$agendamento->horario, $agendamento['sala']], 
            $configs['mail_docente']
        );
        return $configs;
    }
}
