<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Docente;

class DadosProfExternoMail extends Mailable
{
    use Queueable, SerializesModels;
    private $docente;
    private $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Docente $docente, $email)
    {
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
            'docente' => $this->docente,
        ]);    
    }
}
