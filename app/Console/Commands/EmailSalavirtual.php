<?php
namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Mail\MailSalaVirtual;
use App\Models\Agendamento;
use App\Services\ReplicadoService;

class EmailSalavirtual extends Command
{
    protected $signature = 'send:email-salavirtual';

    protected $description = 'Envia emails diários para os docentes que não criaram o link para sala virtual';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        /*
        Deixar "enviar_email" como 0 para que, ao enviar o email à meia-noite,
        atualize na DB para mostrar que o e-mail foi enviado.
        Não será enviado email caso o professor mande o link da sala virtual
        antes da meia-noite.
        */

        $agendamentos = Agendamento::select(['id', 'codpes', 'codare', 'numseqpgm', 'nivpgm', 'tipo'])
            ->where('sala_virtual', null)
            ->whereDate('data_horario', '>=', now())
            ->where('tipo','=','Virtual')
            ->orderBy('data_horario')
            ->get();

        foreach($agendamentos as $agendamento){
            $docente = ReplicadoService::getOrientador($agendamento->codpes, $agendamento->codare, $agendamento->numseqpgm);
            $email = ReplicadoService::getEmail($docente['codpes']);
            if($email) {
                Mail::to($email)->queue(new MailSalaVirtual($agendamento));
                Agendamento::where('id', $agendamento->id)
                    ->update(['enviar_email' => TRUE]);
            }
        }
    }
}
