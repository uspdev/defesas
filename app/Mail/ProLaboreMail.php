<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Docente;

class ProLaboreMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Docente $docente)
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
        $subject = "Pagamento de Pró-Labore para banca de Doutorado  - {$this->docente->nome}";

        return $this->view('emails.pro_labore')
        ->to('tesouraria@fflch.usp.br')
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'docente' => $this->docente,
        ]);    
    }
}
