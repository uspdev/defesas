<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

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
        $rules = [
            'data' => 'required|date_format:d/m/Y',
            'horario' => 'required|date_format:H:i',
            'sala' => 'required',
            'tipo' => [
                'required',
                Rule::in(Agendamento::tipos())
            ],
            'sala_virtual' => 'nullable'
        ];

        if ($this->method() == 'POST') {
            $rules = array_merge($rules, [
                'codpes' => 'required|integer'
            ]);
        }

        return $rules;
    }

    public function validated($key = null, $default = null) {
        return array_merge(parent::validated(), [
            'data_horario' => Carbon::createFromFormat('d/m/Y H:i', $this->data . $this->horario)->format('Y-m-d H:i')
        ]);
    }

    public function messages(){
        return [
            'codpes.required' => 'O Número USP é obrigatório',
            'codpes.integer' => 'O Número USP precisa ser um número inteiro',
            'data.required' => 'A data é obrigatório',
            'data.date_format' => 'Insira uma data no padrão d/m/a',
            'horario.required' => 'O horário é obrigatório',
            'horario.date_format' => 'Insira um horário válido no formato H:m',
            'sala.required' => 'A sala é obrigatório',
            'tipo.required' => 'Escolha o tipo da defesa',
        ];
    }
}
