<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->integer('n_usp');
            $table->string('cpf');
            $table->string('tipo');
            $table->string('documento');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cep');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->string('pis_pasep')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('c_corrente')->nullable();
            $table->string('telefone');
            $table->string('lotado');
            $table->string('email');
            $table->string('status');
            $table->string('docente_usp');
            $table->integer('codultalt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
}
