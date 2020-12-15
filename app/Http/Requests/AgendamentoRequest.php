<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;
use App\Utils\ReplicadoUtils;

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
            'codpes' => 'required|integer',
            'nome' => '',
            'regimento' => ['required',Rule::in($agendamento->regimentoOptions())],
            'orientador_votante' => ['required',Rule::in($agendamento->orientadorvotanteOptions())],
            'sexo' => ['required',Rule::in($agendamento->sexoOptions())],
            'nivel' => ['required',Rule::in($agendamento->nivelOptions())],
            'titulo' => 'required',
            'area_programa' => ['required',Rule::in(ReplicadoUtils::codareasProgramas())],
            'sala' => 'required',
            'sala_virtual' => 'required_if:sala,Sala Virtual',
            'data_horario' => 'required',
            'orientador' => 'required|integer',
        ];
    }

    public function validationData()
    {
        $dado = $this->all();
        if($dado['data'] != null && $dado['horario'] != null){
            $data_validated = $this->validate([
                'data' => 'required|data'
            ]);
            $data = $dado['data'];
            $horario = $dado['horario'];
            $dado['data_horario'] = Carbon::CreatefromFormat('d/m/Y H:i', "$data $horario");
        }
        return $dado;
    }
}
