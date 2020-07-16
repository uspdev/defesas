<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agendamento extends Model
{
    protected $guarded = ['id'];

    public function bancas()
    {
        return $this->hasMany('App\Banca');
    }

    public function setDataHorario($agendamento){
        $data = Carbon::parse($agendamento->data_horario)->format('d/m/Y');
        $horario = Carbon::parse($agendamento->data_horario)->format('H:i');
        $agendamento->data = $data;
        $agendamento->horario = $horario;
        return $agendamento;
    }
    
    public static function sexoOptions(){
        return [
            'Masculino',
            'Feminino'
        ];
    }

    public static function regimentoOptions(){
        return [
            'Antigo',
            'Novo'
        ];
    }

    public static function nivelOptions(){
        return [
            'Mestrado',
            'Doutorado'
        ];
    }
    
    public static function programaOptions(){
        return [
            "Filosofia",
            "Teoria Literária e Literatura Comparada",
            "Língua Espanhola e Literaturas Espanhola e Hispano-Americana",
            "Estudos Linguísticos, Literários e Tradutológicos em Francês",
            "Estudos Linguísticos e Literários em Inglês",
            "Literatura e Cultura Russa",
            "Língua, Literatura e Cultura Japonesa",
            "Língua, Literatura e Cultura Italianas",
            "Semiótica e Linguística Geral",
            "Filologia e Língua Portuguesa",
            "Literatura Brasileira",
            "Língua e Literatura Alemã",
            "Estudos Comparados de Literaturas de Língua Portuguesa",
            "Letras Clássicas",
            "Literatura Portuguesa",
            "Estudos Judaicos e Árabes",
            "Sociologia",
            "Antropologia Social",
            "Geografia Humana",
            "Geografia Física",
            "História Social",
            "História Econômica",
            "Ciência Política",
            "Estudos da Tradução",
            "Humanidades, Direitos e Outras Legitimidades",
            "Profissional em Letras em Rede Nacional",
            "Estudos Judaicos",
            "Estudos Árabes",
            "Letras Estrangeiras e Tradução (LETRA)",
        ];
    }

    public static function orientadorvotanteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    
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
        ];
    }
}
