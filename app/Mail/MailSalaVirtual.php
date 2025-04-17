<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Services\ReplicadoService;

class MailSalaVirtual extends Mailable
{
    use Queueable, SerializesModels;

    private $aluno;
    private $agendamento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento)
    {
        $this->aluno = ReplicadoService::getNome($agendamento->codpes);
        $this->agendamento = $agendamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Criação da Sala Virtual de " . $this->aluno;
        return $this->view('emails.virtual_class')
            ->subject($subject)
            ->with([
                'agendamento' => $this->agendamento,
            ]);
    }
}
