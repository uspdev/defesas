<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Uspdev\Replicado\Posgraduacao;
use App\Utils\ReplicadoUtils;
use App\Models\Banca;
use App\Models\Docente;
class Agendamento extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bancas()
    {
        return $this->hasMany(Banca::class);
    }

    //Função para formatar horário do agendamento
    public function setDataHorario($agendamento){
        $data = Carbon::parse($agendamento->data_horario)->format('d/m/Y');
        $horario = Carbon::parse($agendamento->data_horario)->format('H:i');
        $agendamento->data = $data;
        $agendamento->horario = $horario;
    }

    //Função para devolver valores de select
    public static function sexoOptions(){
        return [
            'Masculino',
            'Feminino'
        ];
    }

    //Função para devolver valores de select
    public static function regimentoOptions(){
        return [
            'Antigo',
            'Novo'
        ];
    }

    //Função para devolver valores de select
    public static function nivelOptions(){
        return [
            'Mestrado',
            'Doutorado'
        ];
    }

    //Função para devolver valores de select
    public static function programaOptions(){
        //Em vez de usar a função do Uspdev, para facilitação foi criada uma personalizada no Utils que varre o array e disponibiliza apenas os códigos da área e seus nomes
        return ReplicadoUtils::areasProgramas();
    }

    //Função para devolver valores de select
    public static function orientadorvotanteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    //Função para devolver valores de select
    public static function salaOptions(){
        return [
            "Sala de Defesas (120)",
            "Sala de Concursos (122)",
            "Salão Nobre (145)",
            "Sala de Eventos (124)",
            "Sala de Reuniões (141)",
            "Sala dos Professores (114)",
            "Sala da Direção",
            "Sala de Treinamento (116)",
            "Sala Virtual",
        ];
    }

    public static function dadosProfessor($codpes){
        $dados = Docente::dump($codpes);
        if($dados != null){
            return $dados;
        }
        return false;
    }
}
