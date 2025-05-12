<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use App\Actions\DadosJanusAction;
#use App\Utils\ReplicadoUtils;
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
            [
                "%data_oficio_suplente",
                "%nome_sala",
                "%predio"
            ],
            [
                Carbon::parse($agendamento['data_horario'])->translatedFormat('d \\de F \\de Y'),
                $agendamento['sala'],
                'FFLCH'
            ],
            $configs['oficio_suplente']
        );
        return $configs;
    }

    //Função para modificar a mensagem padrão da Declaração
    public static function setConfigDeclaracao($agendamento, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        //Faz as trocas
        $configs['declaracao'] = str_replace(
            [
                "%docente_nome",
                "%nivel",
                "%candidato_nome",
                "%titulo",
                "%area",
                "%orientador"
            ],
            [
                $professor ?? 'Professor não cadastrado' ,
                $agendamento->nivpgm,
                $agendamento->aluno,
                $agendamento->trabalho['tittrb'],
                $agendamento->area['nomare'],
                $agendamento->orientador['nompesttd'] ?? 'Professor não cadastrado' ,
            ],
            $configs['declaracao']
        );

        return $configs;
    }

    //Função para modificar a mensagem padrão da Stament of Participation
    public static function setConfigStatement($agendamento, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        //Faz as trocas
        $configs['statement'] = str_replace(
            [
                "%docente_nome",
                "%nivel",
                "%candidato_nome",
                "%titulo",
                "%area",
                "%orientador",
                "%data"
            ],
            [
                $professor ?? 'Professor não cadastrado' ,
                $agendamento->nivpgm == 'Mestrado' ? "Master's" : "Doctorate's",
                $agendamento->aluno,
                $agendamento->trabalho['tittrbigl'] ?? $agendamento->trabalho['tittrb'],
                $agendamento->area['nomareigl'] ?? $agendamento->area['nomare'],
                $agendamento->orientador['nompesttd'] ?? 'Professor não cadastrado' ,
                Carbon::parse($agendamento->data_horario)->format('F jS\, Y')
            ],
            $configs['statement']
        );

        return $configs;
    }

    //Função para modificar o email padrão para docente externo
    public static function setConfigEmail($agendamento, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $configs['mail_docente'] = str_replace(
            [
                "%docente_nome",
                "%candidato_nome",
                "%data_defesa",
                "%local_defesa",
                "%agendamento",
                "%docente",
                "%token"
            ],
            [
                $professor['nompesttd'] ?? 'Professor não cadastrado',
                $agendamento->aluno,
                Carbon::parse($agendamento['data_horario'])->translatedFormat('d \\de F \\de Y \à\s H:i'),
                $agendamento->sala,
                $agendamento->id,
                $professor['codpesdct'],
                "<input type='hidden' name='_token' value=".csrf_token().">"
            ],
            $configs['mail_docente']
        );
        return $configs;
    }

    public static function configMailDadosProfExterno($docente){
        $configs = Config::orderbyDesc('created_at')->first();
        $endereco = $docente['nomtiplgr'] . " " .
            $docente['epflgr'] . " " .
            $docente['numlgr'] . " " .
            $docente['nombro'] . " CEP: " .
            $docente['codendptl'] . " " .
            $docente['cidloc'] . "/" .
            $docente['sglest'];
        $configs['mail_dados_prof_externo'] = str_replace(
            [
                "%docente",
                "%endereco",
                "%telefones"
            ],
            [
                $docente['nompesttd'],
                $endereco,
                implode(" - ", $docente['telefones'])
            ],
            $configs['mail_dados_prof_externo']
        );
        return $configs['mail_dados_prof_externo'];
    }

    public static function configMailPassagem($agendamento, $docente){
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8','portuguese');
        $configs['mail_passagem'] = str_replace(
            [
                "%docente",
                "%candidato",
                "%data",
                "%sala"
            ],
            [
                $docente['nompesttd'],
                $agendamento->aluno,
                Carbon::parse($agendamento['data_horario'])->translatedFormat('d \\de F \\de Y \à\s H:i'),
                $agendamento->sala
            ],
            $configs['mail_passagem']
        );
        return $configs['mail_passagem'];
    }

    public static function configMailProLabore($agendamento, $docente){
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $configs['mail_pro_labore'] = str_replace(
            [
                "%candidato",
                "%programa",
                "%departamento",
                "%datahora",
                "%docente",
                "%nusp",
                "%pispasep",
                "%cpf",
            ],
            [
                $agendamento->aluno,
                $agendamento->area['nomare'],
                $agendamento->orientador['nomset'],
                Carbon::parse($agendamento['data_horario'])->translatedFormat('d \\de F \\de Y \à\s H:i'),
                $docente['nompesttd'],
                $docente['codpesdct'],
                $docente['documentos']['numpispsp'],
                $docente['documentos']['numcpf'],
            ],
            $configs['mail_pro_labore']
        );
        return $configs['mail_pro_labore'];
    }

    public static function configMailReciboExterno($agendamento, $docente, $dados){
        $configs = Config::orderbyDesc('created_at')->first();
        setlocale(LC_TIME, 'pt_BR','pt_BR.utf-8','portuguese');
        $datahora = Carbon::parse($agendamento['data_horario'])->translatedFormat('d \\de F \\de Y \à\s H:i');
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
            [
                "%docente",
                "%nusp",
                "%origem",
                "%ida",
                "%volta",
                "%email",
                "%programa",
                "%nivel",
                "%candidato",
                "%datahora",
                "%diaria"
            ],
            [
                $docente['nompesttd'],
                $docente['codpesdct'],
                $dados['origem'],
                $dados['ida'],
                $dados['volta'],
                $docente['email'],
                $agendamento->area['nomare'],
                $agendamento->nivpgm,
                $agendamento->aluno,
                $datahora,
                $diaria
            ],
            $configs['mail_recibo_externo']
        );

        return $configs['mail_recibo_externo'];
    }

    public static function configMailSalaVirtual(Agendamento $agendamento){
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento = DadosJanusAction::handle($agendamento);

        $configs['mail_sala_virtual'] = str_replace(
            [
                "%docente",
                "%nusp",
                "%candidato",
                "%codpes",
                "%titulo",
                "%tipo"
            ],
            [
                $agendamento['orientador']['nompesttd'],
                $agendamento['orientador']['codpes'],
                $agendamento['aluno'],
                $agendamento['codpes'],
                $agendamento['trabalho']['tittrb'],
                $agendamento['tipo']
            ],
            $configs['mail_sala_virtual']
        );

        return $configs['mail_sala_virtual'];
    }

}
