<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use App\Models\Docente;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;
use Carbon\Carbon;

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

        $configs['declaracao'] = str_replace("%area", ReplicadoUtils::nomeAreaPrograma($agendamento['area_programa']), $configs['declaracao']);

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

    //Função para modificar a mensagem padrão da Stament of Participation
    public static function setConfigStatement($agendamento, $professores, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        //Faz as primeiras trocas
        if(Agendamento::dadosProfessor($professor->codpes) == null){
            $docenteNome = 'Professor não cadastrado';
        }
        else{
            $docenteNome = Agendamento::dadosProfessor($professor->codpes)->nome;
        }

        if($agendamento['nivel'] == 'Mestrado'){
            $nivel = "Master's";
        }else{
            $nivel = "Doctorate's";
        }
        $configs['statement'] = str_replace(
            ["%docente_nome","%nivel","%candidato_nome", "%titulo", "%data"],
            [$docenteNome,$nivel, $agendamento['nome'], $agendamento->title ?? $agendamento->titulo, Carbon::parse($agendamento['data_horario'])->format('F jS\, Y')],
            $configs['statement']
        );

        $configs['statement'] = str_replace("%area", ReplicadoUtils::nomeAreaProgramaEmIngles($agendamento['area_programa']), $configs['statement']);

        //Altera a informação de presidente de acordo com o tipo do professor informado
        foreach($professores as $presidente){
            if($presidente['presidente'] == 'Sim'){
                if(Agendamento::dadosProfessor($presidente->codpes) == null){
                    $docenteNome = 'Professor não cadastrado';
                }
                else{
                    $docenteNome = Agendamento::dadosProfessor($presidente->codpes)->nome;
                }
                $configs['statement'] = str_replace("%orientador", $docenteNome, $configs['statement']);
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
            ["%docente_nome","%candidato_nome", "%data_defesa", "%local_defesa", "%agendamento", "%docente", "%token"],
            [$docenteNome,$agendamento->nome, strftime("%d de %B de %Y", strtotime($agendamento->data_horario))." às ".date('H:i', strtotime($agendamento->data_horario)), $agendamento->sala, $agendamento->id, $professor->id, "<input type='hidden' name='_token' value=".csrf_token().">"],
            $configs['mail_docente']
        );
        return $configs;
    }

    public static function configMailDadosProfExterno($docente){
        $configs = Config::orderbyDesc('created_at')->first();
        $endereco = $docente['endereco']." ".$docente['bairro']." CEP:".$docente['cep']." ".$docente['cidade']."/".$docente['estado'];
        $configs['mail_dados_prof_externo'] = str_replace(
            ["%docente","%endereco", "%telefones"],
            [$docente['nome'], $endereco, $docente['telefone']],
            $configs['mail_dados_prof_externo']
        );
        return $configs['mail_dados_prof_externo'];
    }

    public static function configMailPassagem($agendamento, $docente){
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8','portuguese');
        $configs['mail_passagem'] = str_replace(
            ["%docente","%candidato", "%data", "%sala"],
            [$docente['nome'], $agendamento['nome'], 
             strftime("%d de %B de %Y", strtotime($agendamento['data_horario'])) . " às " . date('H:i',strtotime($agendamento["data_horario"])), $agendamento['sala']],
            $configs['mail_passagem']
        );
        return $configs['mail_passagem'];
    }

    public static function configMailProLabore($agendamento, $docente){
        $configs = Config::orderbyDesc('created_at')->first();
        $departamento = ReplicadoUtils::departamentoPrograma($agendamento['orientador'])['nomset'];
        $nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento['area_programa']);
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $datahora = strftime("%d de %B de %Y", strtotime($agendamento['data_horario']))." às ".date('H:i',strtotime($agendamento['data_horario']));
        $configs['mail_pro_labore'] = str_replace(
            ["%candidato", "%programa", "%departamento", "%datahora", "%docente", "%nusp", "%pispasep", "%cpf", "%banco", "%agencia", "%conta"],
            [$agendamento['nome'], $nome_area, $departamento, $datahora, $docente['nome'], $docente['n_usp'], $docente['pis_pasep'], $docente['cpf'], $docente['banco'], $docente['agencia'], $docente['c_corrente']],
            $configs['mail_pro_labore']
        );
        return $configs['mail_pro_labore'];
    }

    public static function configMailReciboExterno($agendamento, $docente, $dados){
        $configs = Config::orderbyDesc('created_at')->first();
        $nome_area = ReplicadoUtils::nomeAreaPrograma($agendamento['area_programa']);
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $datahora = strftime("%d de %B de %Y", strtotime($agendamento['data_horario']))." às ".date('H:i',strtotime($agendamento['data_horario']));
        //acessando $dados como array (devido ao método queue no Mail)
        if($dados['diaria'] == "diaria_simples"){
            $diaria = "<p><b>Diária Simples:</b> {$configs->diaria_simples}</p>";
        }
        elseif($dados['diaria'] == "diaria_completa"){
            $diaria = "<p><b>Diária Completa:</b> {$configs->diaria_completa}</p>";
        }
        else{
            $diaria = "<p><b>2 Diárias:</b> {$configs->duas_diarias}</p>";
        }
        $configs['mail_recibo_externo'] = str_replace(
            ["%docente", "%nusp", "%origem", "%ida", "%volta", "%email", "%programa", "%nivel", "%candidato", "%datahora", "%diaria"],
            [$docente['nome'], $docente['n_usp'], $dados['origem'], $dados['ida'], $dados['volta'], $docente['email'], $nome_area, $agendamento['nivel'], $agendamento['nome'], $datahora, $diaria],
            $configs['mail_recibo_externo']
        );
        return $configs['mail_recibo_externo'];
    }

    public static function configMailSalaVirtual(Agendamento $agendamento){
        $configs = Config::orderbyDesc('created_at')->first();

        $docenteNome = Agendamento::dadosProfessor($agendamento->orientador)->nome;

        $configs['mail_sala_virtual'] = str_replace(
            ["%docente", "%nusp", "%candidato", "%codpes", "%titulo", "%tipo"],
            [$docenteNome,$agendamento['orientador'],$agendamento['nome'], $agendamento['codpes'], $agendamento['titulo'], $agendamento['tipo']],
            $configs['mail_sala_virtual']
        );

        return $configs['mail_sala_virtual'];
    }

}
