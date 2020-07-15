<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
        return [
            'codpes' => 'required',
            'regimento' => 'required',
            'orientador_votante' => 'required',
            'sexo' => 'required',
            'nivel' => 'required',
            'titulo' => 'required',
            'area_programa' => 'required',
            'sala' => 'required',
            'data_horario' => 'required',
            'orientador' => 'required',
        ];
    }

    public function validationData()
    {
        $dado = $this->all();
        if($dado['data'] != null && $dado['horario'] != null){
            $data = $dado['data'];
            $horario = $dado['horario'];
            $dado['data_horario'] = Carbon::CreatefromFormat('d/m/Y H:i', "$data $horario");
        }
        return $dado;
    }
}
