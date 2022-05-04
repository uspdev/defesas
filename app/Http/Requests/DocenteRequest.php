<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Docente;
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
            'n_usp' => ['required'],
            'cpf' => ['cpf'],
            'tipo' => Rule::in(Docente::documentoOptions()),
            'documento' => '',
            'endereco' => '',
            'bairro' => '',
            'cep' => '',
            'cidade' => '',
            'estado' => '',
            'pais' => '',
            'pis_pasep' => '',
            'banco' => '',
            'agencia' => '',
            'c_corrente' => '',
            'telefone' => '',
            'lotado' => 'required',
            'email' => '',
            'status' => ['required', Rule::in(Docente::statusOptions(true))],
            'docente_usp' => ['required', Rule::in(Docente::docenteUspOptions(true))]
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['cpf'], 'unique:docentes,cpf,'.$this->docente->id);
            array_push($rules['n_usp'], 'unique:docentes,n_usp,'.$this->docente->id);
        }
        else{
            array_push($rules['cpf'], 'unique:docentes');
            array_push($rules['n_usp'], 'unique:docentes');
        }
        return $rules;
    }
    
    public function validationData()
    {
        $data = $this->all();
        $data['cpf'] = preg_replace('/[^0-9]/', '', $data['cpf']);
        return $data;
    }

    public function messages(){
        return [
            'nome.required' => 'É obrigatório o preenchimento do Nome.',
            'n_usp.required' => 'É obrigatório o preenchimento do Número USP.',
            'lotado.required' => 'É obrigatório o preenchimento do  Nome e sigla da Universidade na qual tem vínculo profissional.',
            'status.required' => 'É obrigatório a seleção do Status do docente.',
            'docente_usp.required' => 'É obrigatório a indicação se o docente é da USP ou não.',
        ];
    }
}
