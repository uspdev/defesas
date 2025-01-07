<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Docente;

class ReciboExternoMail extends Mailable
{
    use Queueable, SerializesModels;
    private $agendamento;
    private $docente;
    private $dados;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Docente $docente, array $dados)
    {
        $this->agendamento = $agendamento;
        $this->docente = $docente;
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Recibo de diária para docentes externos - {$this->docente->nome}";

        return $this->view('emails.recibo_externo')
        ->to('tesouraria@fflch.usp.br')
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'docente' => $this->docente,
            'dados' => $this->dados,
        ]);     
    }
}
