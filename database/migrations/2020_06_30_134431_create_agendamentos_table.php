<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('codpes');
            $table->string('regimento');
            $table->string('orientador_votante');
            $table->string('sexo');
            $table->string('nivel');
            $table->string('titulo');
            $table->string('area_programa');
            $table->dateTime('data_horario');
            $table->string('sala');
            $table->string('orientador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
