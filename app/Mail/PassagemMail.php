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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agendamento, $docente)
    {
        $this->agendamento = $agendamento;
        $this->docente = $docente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Dados de passagem - Participação em Banca  - {$this->docente['nompesttd']}";
        return $this->view('emails.passagem')
        ->to($this->docente['email'])
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'docente' => $this->docente,
        ]);
    }
}
