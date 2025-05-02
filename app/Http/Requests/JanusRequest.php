<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class JanusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data' => 'required|date_format:d/m/Y',
            'horario' => 'required|date_format:H:i',
            'sala' => 'required',
            'tipo_defesa' => 'required',
            'sala_virtual' => 'required_if:tipo_defesa,Virtual'
        ];

        if ($this->method() == 'POST') {
            $rules = array_merge($rules, [
                'codpes' => 'required|integer'
            ]);
        }

        return $rules;
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
            'tipo_defesa.required' => 'Escolha o tipo da defesa',
            'sala_virtual.required_if' => 'O link da sala virtual é obrigatório se o tipo da defesa for Virtual'
        ];
    }
}
