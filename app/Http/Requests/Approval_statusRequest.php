<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Agendamento;
use Illuminate\Validation\Rule;

class Approval_statusRequest extends FormRequest
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
        return [
            'approval_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'approval_status.required' => 'Status de Defesa é obrigatório',
        ];
    }
}
