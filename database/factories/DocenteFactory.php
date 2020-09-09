<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Docente;
use Faker\Generator as Faker;
use Uspdev\Replicado\Pessoa;

$factory->define(Docente::class, function (Faker $faker) {
    $docente = $faker->docente();
    $telefones = '';
    $emails = '';
    foreach(Pessoa::telefones($docente) as $t){
        $telefones .= $t." /";
    }
    foreach(Pessoa::emails($docente) as $e){
        $emails .= $e." /";
    }
    return [
        'nome' => Pessoa::dump($docente)['nompes'],
        'n_usp' => $docente,
        'cpf' => Pessoa::dump($docente)['numcpf'],
        'tipo' => 'RG',
        'documento' => Pessoa::dump($docente)['numdocidf'],
        'endereco' => Pessoa::obterEndereco($docente)['nomtiplgr'].Pessoa::obterEndereco($docente)['epflgr'].Pessoa::obterEndereco($docente)['numlgr'].Pessoa::obterEndereco($docente)['cpllgr'],
        'bairro' => Pessoa::obterEndereco($docente)['nombro'],
        'cep' => Pessoa::obterEndereco($docente)['codendptl'],
        'cidade' => Pessoa::obterEndereco($docente)['cidloc'],
        'estado' => Pessoa::obterEndereco($docente)['sglest'],
        'pais' => 'Brasil',
        'pis_pasep' => '',
        'banco' => '',
        'agencia' => '',
        'c_corrente' => '',
        'telefone' => $telefones,
        'lotado' => Pessoa::cracha($docente)['nomorg'],
        'email' => $emails,
        'status' => 'B',
        'docente_usp' => 'sim',
        'last_user' => 1,
    ];
});
