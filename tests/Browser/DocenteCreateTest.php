<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Docente;
use App\Models\Agendamento;

class DocenteCreateTest extends DuskTestCase
{
    public function testCreateDocente(): void
    {
        $user = User::select('users.*')->first();
        $this->browse(function (Browser $browser) {
            $browser->loginAs($user)
                    ->visit("/docentes/create")
                    ->type('nome','Aadson')
                    ->type('cpf','35423071062')
                    ->select('tipo','RG')
                    ->type('documento','391661632')
                    ->select('status','Brasileiro')
                    ->typeSlowly('endereco','teste')
                    ->typeSlowly('bairro','teste')
                    ->typeSlowly('cep','teste')
                    ->typeSlowly('cidade','teste')
                    ->typeSlowly('estado','teste')
                    ->typeSlowly('pais','teste')
                    ->typeSlowly('pis_pasep','teste')
                    ->typeSlowly('banco','teste')
                    ->typeSlowly('agencia','teste')
                    ->typeSlowly('c_corrente','123456')
                    ->typeSlowly('telefone','5559192')
                    ->typeSlowly('email','email@contato.com')
                    ->select('docente_usp','Sim')
                    ->type('lotado', "UNIVERSIDADE DE SÃO PAULO")   
                    ->type('n_usp',"362384")
                    ->pause(1500)
                    ->press('@enviar')
                    ->pause(1500);
                    
                    $docente = Docente::where('documento',"391661632")
                    ->orderBy('id','desc')
                    ->first();
                    
                    $browser->assertPathIs('/docentes/'. $docente->id);
                    
                    ;
                    
        });
    }

    public function testEditDocente(){
        $this->browse(function (Browser $browser){
            $browser->visit('/docentes')
            ->click('@nome_docente')
            ->pause(2000)
            ->click('.btn.btn-warning')
            ->typeSlowly("nome","Aadson da Silva")
            ->press("@enviar")
            ->pause(1000);
        });
    }


    public function testDeleteDocente(){
        $this->browse(function (Browser $browser){
            $browser->visit('/docentes')
            ->pause(500)
            ->click(".btn.btn-danger")
            ->pause(1000)
            ->acceptDialog()
            ->pause(1200);
        });
    }

    public function testCreateAgendamento(){
        $this->browse(function (Browser $browser){
            $browser->visit("/agendamentos/create")
            ->assertSee("Registrar Agendamento de Defesa")
            ->typeSlowly('titulo','TESTE')
            ->typeSlowly('title','teste')
            ->typeSlowly('nome','')
            ->typeSlowly('codpes',"14605185")
            ->select('regimento','Novo')
            ->select('nivel','Mestrado')
            ->select('area_programa',8131)
            ->select('orientador_votante','Sim')
            ->select('tipo','Presencial')
            ->typeSlowly('orientador',"66115")
            ->typeSlowly('data','31/12/2023')
            ->typeSlowly('horario','15:00')
            ->typeSlowly('sala','TESTE')
            ->typeSlowly('resumo','teste')
            ->select('approval_status','Aprovado')
            ->pause(500)
            ->press('@enviar_agendamento')
            ->pause(1000);
        });
    }
    
    public function testEditAgendamento(){
        $this->browse(function (Browser $browser){
            $agendamento = Agendamento::first();
            $browser->visit('/agendamentos/' . $agendamento->id)
            ->pause(600)
            ->click('@edit_defesa')
            ->pause(600)
            ->type('title','title')
            ->pause(300)
            ->typeSlowly('data','30/12/2023')
            ->pause(300)
            ->press("@enviar_agendamento")
            ->pause(500)
            ->typeSlowly('codpes','1979713')
            ->select('presidente',"Sim")
            ->select('tipo','Suplente')
            ->pause(500)
            ->press("@inserir_professor")
            ->pause(500)
            ->attach('input[type="file"','/home/raphael_feitosa/Downloads/Carlota_Rosa.pdf')
            ->pause(300)
            ->typeSlowly('@tipo','Carlota Rosa')
            ->pause(300)
            ->press('@enviar_arquivo')
            ->pause(300)
            ->typeSlowly('url','https://www.com.br')
            ->click('input[type="radio"][value="1"]')
            ->pause(300)
            ->press("@publicar")
            ->pause(1000);
        });
    }

    public function testVerPublicacao(){
        $this->browse(function (Browser $browser){
            $browser->visit('/teses/publicadas')
            ->pause(3000);
        });
    }

    public function testDeleteAgendamento(){
        $this->browse(function (Browser $browser){
            $agendamento = Agendamento::first();
            $browser->visit('/agendamentos/'. $agendamento->id)
            ->pause(1000)
            ->click("@delete_defesa")
            ->pause(1200)
            ->acceptDialog()
            ->pause(600);
        });
    }

}
