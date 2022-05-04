<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;

class BancaRequest extends FormRequest
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
            'presidente' => ['required',Rule::in($agendamento->presidenteOptions())],
            'tipo' => ['required',Rule::in($agendamento->tipoOptions())],
            'agendamento_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'codpes.required' => 'É obrigatório preencher o número USP do docente a ser inserido na banca.',
            'presidente.required' => 'É necessário indicar se o docente é Presidente da banca ou não.',
            'tipo.required' => 'É necessário indicar o tipo de presença do docente na banca.',
        ];
    }
}
