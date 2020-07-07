<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    public function sexoOptions(){
        return [
            'Masculino',
            'Feminino'
        ];
    }

    public function regimentoOptions(){
        return [
            'Antigo',
            'Novo'
        ];
    }

    public function nivelOptions(){
        return [
            'Mestrado',
            'Doutorado'
        ];
    }
    
    public function programaOptions(){
        $programas = array(
            array("id" => '4',"programa" => "Filosofia"),
            array("id" => '5',"programa" => "Teoria Literária e Literatura Comparada"),
            array("id" => '6',"programa" => "Língua Espanhola e Literaturas Espanhola e Hispano-Americana"),
            array("id" => '7',"programa" => "Estudos Linguísticos, Literários e Tradutológicos em Francês"),
            array("id" => '8',"programa" => "Estudos Linguísticos e Literários em Inglês"),
            array("id" => '9',"programa" => "Literatura e Cultura Russa"),
            array("id" => '10',"programa" => "Língua, Literatura e Cultura Japonesa"),
            array("id" => '11',"programa" => "Língua, Literatura e Cultura Italianas"),
            array("id" => '12',"programa" => "Semiótica e Linguística Geral"),
            array("id" => '13',"programa" => "Filologia e Língua Portuguesa"),
            array("id" => '14',"programa" => "Literatura Brasileira"),
            array("id" => '15',"programa" => "Língua e Literatura Alemã"),
            array("id" => '16',"programa" => "Estudos Comparados de Literaturas de Língua Portuguesa"),
            array("id" => '17',"programa" => "Letras Clássicas"),
            array("id" => '18',"programa" => "Literatura Portuguesa"),
            array("id" => '19',"programa" => "Estudos Judaicos e Árabes"),
            array("id" => '20',"programa" => "Sociologia"),
            array("id" => '21',"programa" => "Antropologia Social"),
            array("id" => '22',"programa" => "Geografia Humana"),
            array("id" => '23',"programa" => "Geografia Física"),
            array("id" => '24',"programa" => "História Social"),
            array("id" => '25',"programa" => "História Econômica"),
            array("id" => '26',"programa" => "Ciência Política"),
            array("id" => '27',"programa" => "Estudos da Tradução"),
            array("id" => '28',"programa" => "Humanidades, Direitos e Outras Legitimidades"),
            array("id" => '29',"programa" => "Profissional em Letras em Rede Nacional"),
            array("id" => '30',"programa" => "Estudos Judaicos"),
            array("id" => '31',"programa" => "Estudos Árabes"),
            array("id" => '32',"programa" => "Letras Estrangeiras e Tradução (LETRA)"),
        );
        return($programas);
    }

    public function orientadorvotanteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    
    public function salaOptions(){
        $salas = array(
            array("id" => '4',"nome_sala" => "Sala de Defesas (120)"),
            array("id" => '5',"nome_sala" => "Sala de Concursos (122)"),
            array("id" => '6',"nome_sala" => "Salão Nobre (145)"),
            array("id" => '7',"nome_sala" => "Sala de Eventos (124)"),
            array("id" => '8',"nome_sala" => "Sala de Reuniões (141)"),
            array("id" => '9',"nome_sala" => "Sala dos Professores (114)"),
            array("id" => '10',"nome_sala" => "Sala da Direção"),
            array("id" => '11',"nome_sala" => "Sala de Treinamento (116)"),
        );
        return($salas);
    }
}
