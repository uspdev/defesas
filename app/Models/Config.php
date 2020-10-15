<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;

class Config extends Model
{
    use HasFactory;

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
        if(Agendamento::dadosProfessor($professor->codpes) == null){
            $docenteNome = 'Professor não cadastrado';
        }
        else{
            $docenteNome = Agendamento::dadosProfessor($professor->codpes)->nome;
        }
        $configs['declaracao'] = str_replace(
            ["%docente_nome","%nivel","%candidato_nome", "%titulo"], 
            [$docenteNome,$agendamento['nivel'], $agendamento['nome'], $agendamento['titulo']], 
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
                if(Agendamento::dadosProfessor($presidente->codpes) == null){
                    $docenteNome = 'Professor não cadastrado';
                }
                else{
                    $docenteNome = Agendamento::dadosProfessor($presidente->codpes)->nome;
                }
                $configs['declaracao'] = str_replace("%orientador", $docenteNome, $configs['declaracao']);
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
        if(Agendamento::dadosProfessor($professor->codpes) == null){
            $docenteNome = 'Professor não cadastrado';
        }
        else{
            $docenteNome = Agendamento::dadosProfessor($professor->codpes)->nome;
        }
        $configs['mail_docente'] = str_replace(
            ["%docente_nome","%candidato_nome", "%data_defesa", "%local_defesa"], 
            [$docenteNome,$agendamento['nome'], strftime("%d de %B de %Y", strtotime($agendamento->data_horario))." às ".$agendamento->horario, $agendamento['sala']], 
            $configs['mail_docente']
        );
        return $configs;
    }
}
