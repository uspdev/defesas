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
        return $this->hasMany(Banca::class)->orderBy('presidente','desc')->orderBy('tipo', 'desc');
    }

    //Função para formatar horário do agendamento
    public function formatDataHorario($agendamento){
        $agendamento->data = Carbon::parse($agendamento->data_horario)->format('d/m/Y');
        $agendamento->horario = Carbon::parse($agendamento->data_horario)->format('H:i');
        return $agendamento;
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
    public static function presidenteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    //Função para devolver valores de select
    public static function tipoOptions(){
        return [
            'Titular',
            'Suplente'
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

    public static function dadosProfessor($codpes){
        $dados = Docente::dump($codpes);
        if($dados != null){
            return $dados;
        }
        return false;
    }
}
