<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Uspdev\Replicado\Posgraduacao;
use App\Utils\ReplicadoUtils;
use Uspdev\Replicado\DB;
use App\Models\Banca;
use App\Models\Docente;
use App\Models\Communication;
use Uspdev\Replicado\Pessoa;
use App\Models\User;
use Illuminate\Support\Facades\DB as QueryBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Agendamento extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    public static function tipos() {
        return [
            'Presencial',
            'Hibrido',
            'Virtual'
        ];
    }

    public function bancas()
    {
        return $this->hasMany(Banca::class)->orderBy('presidente','desc')->orderBy('tipo', 'desc');
    }

    public function files()
    {
        return $this->hasMany(File::class);
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
    public static function orientadorvotanteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    public static function dadosProfessor($codpes){
        $dados = Docente::where('n_usp', '=', $codpes)->first();
        if($dados != null){
            return $dados;
        }
        return new Docente;
    }
    public static function retornarDadosProfessor($codpes){
        return Pessoa::dump($codpes); //usado para retornar o CPF
    }

    public function nomeUsuario($id){
        return User::where('id',$id)->first();
    }

    public static function endereco($codpes){
        return Pessoa::obterEndereco($codpes); //método já retorna o endereço completo
    }

    //Função para devolver valores de select status
    public static function statusApprovalOptions(){
        return [
            'Aprovado',
            'Reprovado'
        ];
    }

    /* public static function retornarAnoPublicacao(){ */
    /*     $datas = QueryBuilder::select( */
    /*         "SELECT YEAR(data_publicacao) as data_publicacao FROM agendamentos */
    /*         GROUP BY YEAR(data_publicacao) */
    /*         ORDER BY YEAR(data_publicacao) DESC */
    /*         " */
    /*     ); */
    /*     return $datas; */
    /* } */

    public function docente() {
        return $this->hasOne(Docente::class, 'n_usp', 'orientador');
    }


    public function user(){
        return $this->hasOne(User::class,'id','user_id_biblioteca');
    }

    public function comunicacao(){
        return $this->hasOne(Communication::class,'agendamento_id','id');
    }

    protected function nivpgm(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => match($value) {
                'ME' => 'Mestrado',
                'DO' => 'Doutorado',
                'DD' => 'Doutorado'
            },
        );
    }
}
