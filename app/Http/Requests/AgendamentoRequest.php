<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Agendamento;
use Illuminate\Validation\Rule;

class AgendamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $agendamento = new Agendamento;
        return [
            'codpes' => 'required',
            'nome' => '',
            'regimento' => ['required',Rule::in($agendamento->regimentoOptions())],
            'orientador_votante' => ['required',Rule::in($agendamento->orientadorvotanteOptions())],
            'sexo' => ['required',Rule::in($agendamento->sexoOptions())],
            'nivel' => ['required',Rule::in($agendamento->nivelOptions())],
            'titulo' => 'required',
            'area_programa' => ['required',Rule::in($agendamento->programaOptions())],
            'sala' => ['required',Rule::in($agendamento->salaOptions())],
            'data_horario' => 'required',
            'orientador' => 'required',
            'nome_orientador' => '',
        ];
    }

    public function validationData()
    {
        $dado = $this->all();
        if($dado['data'] != null && $dado['horario'] != null){
            $data = $dado['data'];
            $horario = $dado['horario'];
            $dado['data_horario'] = Carbon::CreatefromFormat('d/m/Y H:i', "$data $horario");
        }
        return $dado;
    }
}
