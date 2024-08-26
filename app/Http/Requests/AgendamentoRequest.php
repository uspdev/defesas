<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        $rules = [
            'codpes' => 'required|integer|codpes',
            'nome' => '',
            'regimento' => ['required',Rule::in($agendamento->regimentoOptions())],
            'orientador_votante' => ['required',Rule::in($agendamento->orientadorvotanteOptions())],
            'nivel' => ['required',Rule::in($agendamento->nivelOptions())],
            'titulo' => 'required|max:2000',
            'title' => 'nullable|max:2000',
            'area_programa' => ['required',Rule::in(Agendamento::devolverCodProgramas())],
            'sala' => 'required',
            'data' => 'required|date_format:d/m/Y',
            'horario' => 'required|date_format:H:i',
            'orientador' => 'required|integer|codpes',
            'nome_orientador' => 'nullable',
            'tipo' => ['required',Rule::in($agendamento->tipodefesaOptions())],
            'co_orientador' => 'nullable|integer|codpes',
            'nome_co_orientador' => 'nullable',
            'resumo' => 'nullable',
            'enviar_email' => 'nullable',
            'sala_virtual' => 'nullable',
            'approval_status' => [
                'nullable',
                Rule::in(Agendamento::statusApprovalOptions()),
            ],
        ];
        return $rules;
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
            'data.required' => 'É necessário indicar da data da defesa',
            'data.date_format:d/m/Y' => 'Insira uma data válida',
            'horario.required' => 'É necessário indicar o horário da defesa',
            'horario.date_format:H:i' => 'Insira um horário válido',
            'orientador.required' => 'O preenchimento do Número USP do Orientador é obrigatório.',
            'tipo.required' => 'O preenchimento do Tipo da defesa é obrigatório.',
            'titulo.max' => 'Ultrapassou o número máximo de 2000 caracteres no título.',
            'title.max' => 'Ultrapassou o número máximo de 2000 caracteres no título em inglês.',
            'enviar_email.nullable' => 'Você terá que enviar aos responsáveis o link da sala virtual'
        ];
    }
}
