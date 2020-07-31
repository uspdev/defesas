<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sitename');
            $table->text('rodape_site');
            $table->text('rodape_oficios');
            $table->text('importante_oficio');
            $table->text('regimento');
            $table->text('oficio_suplente');
            $table->text('declaracao');
            $table->text('diaria_simples');
            $table->text('diaria_completa');
            $table->text('duas_diarias');
            $table->text('diaria_sem_pernoite');
            $table->text('diaria_com_pernoite');
            $table->text('duas_diarias_proap');
            $table->text('agencia_viagem');
            $table->text('agencia_texto');
            $table->text('faturar_para');
            $table->text('mail_docente');
            $table->text('obs_passagem');
            $table->text('header_auxilio');
            $table->text('capes_proap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
