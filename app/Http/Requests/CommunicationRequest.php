<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Agendamento;

class CommunicationRequest extends FormRequest
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
        $agendamento = new Agendamento;
        return [
            'agendamento_id' => 'integer|required',
            'nome' => 'required',
            'codpes' => 'integer|nullable'
        ];
    }

    public function messages(){
        return [
            'agendamento_id.integer' => 'numero do agendamento',
            'agendamento_id.required' => 'agendamento obrigatorio.',
            'nome.required' => 'Nome é obrigatorio',
            'codpes.integer' => 'codpes inteiro'
        ];
    }

}
