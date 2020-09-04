<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Docente;
class DocenteRequest extends FormRequest
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
        $rules = [
            'nome' => 'required',
            'n_usp' => 'required',
            'cpf' => ['required','cpf'],
            'tipo' => ['required', Rule::in(Docente::documentoOptions())],
            'documento' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
            'cep' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'pais' => 'required',
            'pis_pasep' => '',
            'banco' => '',
            'agencia' => '',
            'c_corrente' => '',
            'telefone' => 'required',
            'lotado' => 'required',
            'email' => 'required',
            'status' => ['required', Rule::in(Docente::statusOptions())],
            'docente_usp' => ['required', Rule::in(Docente::docenteUspOptions())]
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['cpf'], 'unique:docentes,cpf,'.$this->docente->id);
        }
        else{
            array_push($rules['cpf'], 'unique:docentes');
        }
        return $rules;
    }
    
        public function validationData()
        {
            $data = $this->all();
            $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);
            return $data;
        }
}
