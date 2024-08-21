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
    private $aluno;
    private $orientador;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agendamento)
    {
    $this->agendamento = $agendamento;
    $this->codpesAluno = $this->agendamento->codpes;
    $this->aluno = Pessoa::retornarEmailUsp($this->agendamento->codpes);
    $this->orientador = Pessoa::retornarEmailUsp($this->agendamento->orientador);
    $this->nomeCompleto = Pessoa::retornarNome($this->agendamento->orientador);
    $this->nomeAluno = Pessoa::retornarNome($this->agendamento->nome);
    $this->codpes = $this->agendamento->orientador;
	// dump($this->aluno);
	// dd($this->orientador);

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = "Criação da Sala Virtual de ".$this->agendamento->nome;
        return $this->view('emails.virtual_class')
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'nomeAluno' => $this->nomeAluno,
            'aluno' => $this->aluno, //n usp do aluno
            'orientador' => $this->orientador, //email usp do orientador
            'nomeCompleto' => $this->nomeCompleto, //nome do orientador
            'codpes' => $this->codpes, //codpes do orientador
            'codpesAluno' => $this->codpesAluno
        ]); 
    }
}