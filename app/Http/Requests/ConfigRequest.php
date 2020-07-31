<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
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
            'sitename' => 'required',
            'rodape_site' => 'required',
            'rodape_oficios' => 'required',
            'importante_oficio' => 'required',
            'regimento' => 'required',
            'oficio_suplente' => 'required',
            'declaracao' => 'required',
            'diaria_simples' => 'required',
            'diaria_completa' => 'required',
            'duas_diarias' => 'required',
            'diaria_sem_pernoite' => 'required',
            'diaria_com_pernoite' => 'required',
            'duas_diarias_proap' => 'required',
            'agencia_viagem' => 'required',
            'agencia_texto' => 'required',
            'faturar_para' => 'required',
            'mail_docente' => 'required',
            'obs_passagem' => 'required',
            'header_auxilio' => 'required',
            'capes_proap' => 'required',
        ];
    }
}
