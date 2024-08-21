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
        o enviar_email não precisa ser 1, pois por default
        vem como 0. Ou seja, se um docente criar um agendamento
        sem sala virtual (por algum motivo), ele será automaticamente (às 0h) notificado
        após a criação do agendamento.
        */
        $docentes = Docente::select('docentes.*')->get();
        $agendamentos = Agendamento::select('agendamentos.*')
        ->where('tipo','like','%virtual%')
        ->where('sala_virtual',null)
        ->orWhere('tipo','like','%hibrido%')
        ->where('sala_virtual',null)
        ->get();

        foreach($agendamentos as $agendamento){
            $agendamento->enviar_email = TRUE;
            $agendamento->update();
            $email = Pessoa::retornarEmailUsp($agendamento->orientador); //codpes do orientador
            Mail::to("$email")->send(new MailSalaVirtual($agendamento, $docentes));
        }
        $this->info('Enviado com sucesso');
        
        
    }
}
