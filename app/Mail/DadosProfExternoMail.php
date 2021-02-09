<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Docente;

class DadosProfExternoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Docente $docente, $email)
    {
        $this->agendamento = $agendamento;
        $this->docente = $docente;
        $this->email = $email;    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Atualização e Confirmação de Dados Cadastrais de Professor Externo - {$this->docente->nome}";
        return $this->view('emails.dados_prof_externo')
        ->to($this->email)
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'docente' => $this->docente,
        ]);    
    }
}
