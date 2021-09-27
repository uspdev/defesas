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
            'footer' => 'required',
            'importante_oficio' => 'required',
            'regimento' => 'required',
            'important' => 'required',
            'regiment' => 'required',
            'oficio_suplente' => 'required',
            'declaracao' => 'required',
            'statement' => 'required',
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
            'mail_dados_prof_externo' => 'required',
            'mail_passagem' => 'required',
            'mail_pro_labore' => 'required',
            'mail_recibo_externo' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sitename.required' => 'É obrigatório o preenchimento do campo Nome do Sistema',
            'rodape_site.required' => 'É obrigatório o preenchimento do campo Rodapé do sistema',
            'rodape_oficios.required' => 'É obrigatório o preenchimento do campo Rodapé (ofício titular, suplente e declaração)',
            'footer.required' => 'É obrigatório o preenchimento do campo Footer (Invite and Statement)',
            'importante_oficio.required' => 'É obrigatório o preenchimento do campo Mensagem Importante no Ofício dos titulares',
            'regimento.required' => 'É obrigatório o preenchimento do campo Regimento - Artigo no Ofício dos titulares',
            'important.required' => "É obrigatório o preenchimento do campo Important Message for Invite",
            'regiment.required' => "É obrigatório o preenchimento do campo Article 97 of the USP Graduate's service",
            'oficio_suplente.required' => 'É obrigatório o preenchimento do campo Ofício Suplente ',
            'declaracao.required' => 'É obrigatório o preenchimento do campo Declaração de participação',
            'statement.required' => 'É obrigatório o preenchimento do campo Statement of Participation',
            'diaria_simples.required' => 'É obrigatório o preenchimento do campo Diária simples',
            'diaria_completa.required' => 'É obrigatório o preenchimento do campo Diária Completa',
            'duas_diarias.required' => 'É obrigatório o preenchimento do campo 2 diárias',
            'diaria_sem_pernoite.required' => 'É obrigatório o preenchimento do campo Diária sem pernoite',
            'diaria_com_pernoite.required' => 'É obrigatório o preenchimento do campo Diária com pernoite',
            'duas_diarias_proap.required' => 'É obrigatório o preenchimento do campo 2 diárias',
            'agencia_viagem.required' => 'É obrigatório o preenchimento do campo Agência de Viagens',
            'agencia_texto.required' => 'É obrigatório o preenchimento do campo Ofício Agência de Viagens',
            'faturar_para.required' => 'É obrigatório o preenchimento do campo Faturar para: Agência de Viagens',
            'mail_docente.required' => 'É obrigatório o preenchimento do campo E-mails para docente',
            'obs_passagem.required' => 'É obrigatório o preenchimento do campo Observação passagem',
            'header_auxilio.required' => 'É obrigatório o preenchimento do campo Cabeçalho da compra via auxílo',
            'capes_proap.required' => 'É obrigatório o preenchimento do campo CAPES/PROAP',
            'mail_dados_prof_externo.required' => 'É obrigatório o preenchimento do campo Mensagem de Email para Confirmação de Dados de Professor Externo',
            'mail_passagem.required' => 'É obrigatório o preenchimento do campo Mensagem de Email para Passagem',
            'mail_pro_labore.required' => 'É obrigatório o preenchimento do campo Mensagem de Email para Pró-Labore',
            'mail_recibo_externo.required' => 'É obrigatório o preenchimento do campo Mensagem de Email para Recibo Externo',
        ];
    }
}
