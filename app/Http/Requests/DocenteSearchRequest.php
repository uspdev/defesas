<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocenteSearchRequest extends FormRequest
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
            'search' => 'required',
        ];

    }

    public function messages(){
        return [
            'search.required' => 'É necessário preencher o campo de busca.',
        ];
    }
}
