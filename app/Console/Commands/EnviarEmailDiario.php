<?php
namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use App\Mail\MailSalaVirtual;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Models\Banca;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\AnnouncementCreated;
use Illuminate\Support\Facades\Notification;
// use App\Utils\ReplicadoUtils;
use Uspdev\Replicado\Pessoa;

class EnviarEmailDiario extends Command
{
    protected $signature = 'example:cron';

    protected $description = 'Envia emails diários para os docentes';

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
        $docentes = Docente::select('docentes.*')->get();
        $agendamentos = Agendamento::select('agendamentos.*')
        ->where('tipo','like','%virtual%')
        ->where('sala_virtual',null)
        ->orWhere('tipo','like','%hibrido%')
        ->where('sala_virtual',null)
        ->get();

        foreach($agendamentos as $agendamento){
            $agendamento->enviar_email = TRUE; //mostra que o e-mail já foi enviado
            $agendamento->update();
            $email = Pessoa::retornarEmailUsp($agendamento->orientador); //codpes do orientador
            Mail::to("$email")->send(new MailSalaVirtual($agendamento, $docentes));
        }
        $this->info('Enviado com sucesso');
        
        
    }
}
