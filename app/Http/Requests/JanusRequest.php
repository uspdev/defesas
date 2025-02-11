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
        return [
            'codpes' => 'required|integer|codpes',
            'data' => 'required|date_format:d/m/Y',
            'horario' => 'required|date_format:H:i',
            'sala' => 'required',
            'regimento' => 'required',
            'orientador_votante' => 'required',
            'tipo_defesa' => 'required'
        ];
    }

    public function messages(){
        return [
            'codpes.required' => 'O Número USP é obrigatório',
            'codpes.integer' => 'O Número USP precisa ser um número inteiro',
            'codpes.codpes' => 'Insira um Número USP válido',
            'data.required' => 'Insira uma data',
            'data.date_format' => 'Insira uma data no padrão d/m/a',
            'horario.required' => 'Insira um horário',
            'horario.date_format' => 'Insira um horário válido no formato H:m',
            'sala.required' => 'Insira uma sala',
            'tipo_defesa.required' => 'Escolha o tipo da defesa',
            'regimento.required' => 'Escolha o regimento',
            'orientador.required' => 'Escolha se o orientador é votante'
        ];
    }
}
