<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ReplicadoService;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;

class AnteriorRequest extends FormRequest
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
        $programas = collect(ReplicadoService::getProgramas());
        $niveis = Agendamento::nivelOptions();
        $areas = $programas->map(function ($item) {
            return $item['codare'];
        });

        return [
            'programa' => ['nullable', Rule::in($areas)],
            'nivel' => ['nullable', Rule::in($niveis)],
            'candidato' => 'nullable|string',
            'orientador' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'programa' => 'Programa inválido.',
            'nivel' => 'Nível inválido',
            'candidato' => 'Dever ser string',
            'orientador' => 'Dever ser string',
            'ano' => 'Deve ser inteiro'
        ];
    }

}
