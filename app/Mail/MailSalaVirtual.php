<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Utils\ReplicadoUtils;
use Uspdev\Replicado\Pessoa;

class MailSalaVirtual extends Mailable
{
    use Queueable, SerializesModels;

    private $agendamento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento)
    {
        $this->agendamento = $agendamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Criação da Sala Virtual de " . $this->agendamento->nome;
        return $this->view('emails.virtual_class')
            ->subject($subject)
            ->with([
                'agendamento' => $this->agendamento,
            ]);
    }
}
