<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendamentoSearchRequest extends FormRequest
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
            'filtro' => 'required', 'in:nome,data,codpes',
            'nome' => 'nullable|required_if:filtro,nome|max:255',
            'codpes' => 'nullable|required_if:filtro,codpes|integer',
            'data' => 'nullable|required_if:filtro,data|date_format:d/m/Y'
        ];
    }

    public function messages(){
        return [
            'filtro.required' => 'O campo filtro é obrigatório',
            'filtro.in' => 'O campo filtro deve ser por Data ou Nome ou Número USP',
            'data.required_if' => 'A data é obrigatório',
            'data.date_format' => 'A data precisa ser no padrão dia/mês/ano, sendo ano com quatro dígitos',
            'codpes.required_if' => 'O número USP é obrigatório',
            'nome.required_if' => 'O nome é obrigatório',
            'nome.max' => 'O nome pode conter no máximo de 255 caracteres',
            'codpes.integer' => 'O número USP deve ser inteiro'
        ];
    }
}
