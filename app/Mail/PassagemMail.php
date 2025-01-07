<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Models\Banca;

class PassagemMail extends Mailable
{
    use Queueable, SerializesModels;
    private $agendamento;
    private $docente;
    private $email;
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
        $subject = "Dados de passagem - Participação em Banca  - {$this->docente->nome}";
        return $this->view('emails.passagem')
        ->to($this->email)
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'docente' => $this->docente,
        ]);    
    }
}
