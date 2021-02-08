<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Config;
use App\Models\Docente;

class ReciboExternoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Config $configs, Docente $docente, $dados)
    {
        $this->agendamento = $agendamento;
        $this->configs = $configs;
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
        $subject = "Recibo de diária para docentes externos - {$this->docente}";

        return $this->view('emails.recibo_externo')
        ->to('tesouraria@fflch.usp.br')
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'configs' => $this->configs,
            'docente' => $this->docente,
            'dados' => $this->dados,
        ]);     
    }
}
