<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Agendamento;
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
            'codpes' => 'required|integer|codpes',
            'nome' => '',
            'regimento' => ['required',Rule::in($agendamento->regimentoOptions())],
            'orientador_votante' => ['required',Rule::in($agendamento->orientadorvotanteOptions())],
            'nivel' => ['required',Rule::in($agendamento->nivelOptions())],
            'titulo' => 'required',
            'title' => 'nullable',
            'area_programa' => ['required',Rule::in(Agendamento::devolverCodProgramas())],
            'sala' => 'required',
            'data_horario' => 'required',
            'orientador' => 'required|integer|codpes',
            'nome_orientador' => 'nullable',
            'tipo' => ['required',Rule::in($agendamento->tipodefesaOptions())],
            'co_orientador' => 'nullable|integer|codpes',
            'nome_co_orientador' => 'nullable',
            'approval_status' => [
                'nullable',
                Rule::in(Agendamento::statusApprovalOptions()),
            ],
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

    public function messages(){
        return[
            'codpes.required' => 'O preenchimento do Número USP é obrigatório.',
            'nome' => '',
            'regimento.required' => 'É necessário selecionar o regimento em que se enquadra.',
            'orientador_votante.required' => 'É necessário selecionar se o Orientador é um Orientador Votante.',
            'nivel.required' => 'É necessário a seleção do nível da defesa.',
            'titulo.required' => 'É obrigatório o preenchimento do título da defesa.',
            'area_programa.required' => 'É necessário a seleção do programa em que se enquadra a defesa.',
            'sala.required' => 'É necessário indicar a sala da defesa.',
            'data_horario.required' => 'É necessário indicar a data e o horário da defesa.',
            'orientador.required' => 'O preenchimento do Número USP do Orientador é obrigatório.',
            'tipo.required' => 'O preenchimento do Tipo da defesa é obrigatório.',
        ];
    }
}
