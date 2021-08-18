<?php
namespace Database\Factories;

use App\Models\Docente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Uspdev\Replicado\Pessoa;

class DocenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Docente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $docente = $this->faker->unique()->docente();
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
            'lotado' => '',
            'email' => $emails,
            'status' => 'B',
            'docente_usp' => 'sim',
            'last_user' => 5385361,
        ];
    }
}
