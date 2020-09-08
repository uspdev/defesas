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
            $table->integer('n_usp')->nullable();
            $table->string('cpf')->nullable();
            $table->string('tipo')->nullable();
            $table->string('documento')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->string('pis_pasep')->nullable();
            $table->string('banco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('c_corrente')->nullable();
            $table->string('telefone')->nullable();
            $table->string('lotado')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->string('docente_usp')->nullable();
            $table->integer('last_user')->nullable();
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
